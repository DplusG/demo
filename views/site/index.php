<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?=$this->render('/common/_get-bonus')?>
    <?php
    if($message) {
        ?>
        <div class="alert alert-info alert-dismissible">
            <?=$message?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?
    }
    ?>
</div>
