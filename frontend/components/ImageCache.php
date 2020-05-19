<?php


namespace frontend\components;
use iutbay\yii2imagecache\ImageCache as Cache;
use Yii;
use yii\helpers\ArrayHelper;

class ImageCache extends Cache
{


    /**
     * Output thumb to browser
     * @param string $path thumb path
     */
    public function output($path)
    {
        // test path
        $info = $this->getPathInfo($path);
        if (!is_array($info) || (!file_exists($info['dstPath']) && !$this->create($path)))
            return false;

        header('Content-type: image/' . $this->extensions[$info['extension']]);
        header('Content-Length: ' . filesize($info['dstPath']));
        readfile($info['dstPath']);
        exit();
    }
    /**
     * Get suffix from size
     * @param string $size
     * @return string suffix
     */
    private function getSufixFromSize($size)
    {
        return ArrayHelper::getValue($this->getSizeSuffixes(), $size);
    }
    /**
     * Get thumb src
     * @param string $path
     * @param string $size
     * @return string
     */
    public function thumbSrc($path, $size = self::SIZE_THUMB)
    {
        // check original image

        if ($size != self::SIZE_FULL && !isset($this->sizes[$size]))
            throw new \yii\base\InvalidParamException('Unkown size ' . $size);

        $realPath = str_replace($this->sourceUrl, $this->sourcePath, $path);
        if (!file_exists($realPath) || !preg_match('#^(.*)\.(' . $this->getExtensionsRegexp() . ')$#', $path, $matches))
            throw new \yii\base\InvalidParamException('Invalid path ' . $path);



        $suffix = $this->getSufixFromSize($size);
        $src = "{$matches[1]}{$suffix}.{$matches[2]}";
        $src = str_replace($this->sourceUrl, $this->thumbsUrl, $src);
        $src = str_replace('%', '%25', $src);

        if(strpos(Yii::$app->request->headers->get('Accept'), 'image/webp')){

                if (\strpos($src, '.jpg'))
                    $src = \str_replace('.webp', '.jpg', $src);
                if (\strpos($src, '.jpeg'))
                    $src = \str_replace('.webp', '.jpeg', $src);


        }

        return $src;
    }
    /**
     * Create thumb
     * @param string $path thumb path
     * @param boolean $overwrite
     * @return boolean
     */
    public function create($path, $overwrite = true)
    {

        // test path
        $info = $this->getPathInfo($path);

        if (!is_array($info))
            return false;
        // check original image

        $src = $info['srcPath'];

        if (\strpos($info['srcPath'], '.webp')){
            if (\strpos($info['srcPath'], '.jpg'))
            $src = \str_replace('.webp', '.jpg', $info['srcPath']);
            if (\strpos($info['srcPath'], '.jpeg'))
            $src = \str_replace('.webp', '.jpeg', $info['srcPath']);
        }

        if (!file_exists($src))
            return false;

        // check destination folder
        $folder = preg_replace('#/[^/]*$#', '', $info['dstPath']);
        if (!file_exists($folder))
            @mkdir($folder, 0777, true);


        // create thumb
        return $this->createThumb($src, $info['dstPath'], $info['size'], $this->resizeMode);
    }

    /**
     * Get info from path
     * @param string $path
     * @return null|array
     */
    private function getPathInfo($path)
    {
        $regexp = '#^(.*)(' . $this->getSizeSuffixesRegexp() . ')\.(' . $this->getExtensionsRegexp() . ')$#';
        if (preg_match($regexp, $path, $matches)) {
            return [
                'size' => $this->getSizeFromSuffix($matches[2]),
                'srcPath' => $this->sourcePath . '/' . $matches[1] . '.' . $matches[3],
                'dstPath' => $this->thumbsPath . '/' . $path,
                'extension' => $matches[3],
            ];
        } else if (preg_match('#^(.*)\.(' . $this->getExtensionsRegexp() . ')$#', $path, $matches)) {
            return [
                'size' => self::SIZE_FULL,
                'srcPath' => $this->sourcePath . '/' . $matches[1] . '.' . $matches[2],
                'dstPath' => $this->thumbsPath . '/' . $path,
                'extension' => $matches[2],
            ];
        }
    }

    /**
     * Get size suffixes regexp
     * @return string regexp
     */
    private function getSizeSuffixesRegexp()
    {
        return join('|', $this->getSizeSuffixes());
    }

    /**
     * Get size from suffix
     * @param string $suffix
     * @return string size
     */
    private function getSizeFromSuffix($suffix)
    {
        return array_search($suffix, $this->getSizeSuffixes());
    }

    private function getSizeSuffixes()
    {
        $suffixes = [];
        foreach ($this->sizes as $size => $sizeConf) {
            $suffixes[$size] = ArrayHelper::getValue($this->sizeSuffixes, $size, $this->defaultSizeSuffix . $size);
        }
        return $suffixes;
    }


}