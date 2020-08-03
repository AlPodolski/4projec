<?php

/* @var $subscribers array */

foreach ($subscribers as $subscriber) : ?>

    <?php

        echo $this->renderFile(Yii::getAlias('@app/modules/group/views/group/subscriber-item.php'), [
            'subscriber' => $subscriber,
    ]);

    ?>

<?php endforeach; ?>