<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 14.09.2019
 * Time: 12:20
 */

use yii\helpers\Html;

$label = $label ? $label : 'Получить приз';

?>

<div class="jumbotron">
    <?php if(\Yii::$app->user->isGuest): ?>
        <h1>Для проверки тестового вам нужно <?=Html::a('авторизоваться', ['/site/login'])?></h1>
    <?php else: ?>
        <?=Html::a($label, ['/bonus/create'], ["class" => "btn btn-primary"])?>
        <br>
        <br>
    <?php endif; ?>
</div>
