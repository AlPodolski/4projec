<?php

/* @var $data array */

 if ($data['email'] == 'adminadultero@mail.com' or $data['last_visit_time'] > time() - 3600) : ?>

     <div class="online-single"></div>

 <?php endif; ?>
