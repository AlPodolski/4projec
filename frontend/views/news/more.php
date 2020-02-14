<?php
/* @var $newsList News[] */
/* @var $this View */

use common\models\News;
use yii\web\View;

?>

<?php foreach ($newsList as $news) : ?>

    <?php echo $this->renderFile('@app/views/news/item.php' , [
        'news' => $news
    ]) ?>

<?php endforeach; ?>
