<?php /* @var $news News */

use common\models\News;

?>
<div class="row advert-item">
    <div class="col-12">
        <div class="name">
            <h5><?php echo $news->title; ?></h5>
        </div>
        <div class="text-ab">
            <?php echo $news->text; ?>
        </div>
    </div>
</div>
