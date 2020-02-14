<?php /* @var $news News */

use common\models\News;

?>
<div class="row advert-item">
    <div class="col-12">
        <div class="name">
            <?php echo $news->title; ?>
        </div>
        <div class="text-ab">
            <?php echo $news->text; ?>
        </div>
    </div>
</div>
