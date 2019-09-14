<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 11.09.2019
 * Time: 16:26
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\OrderForm;

?>

<h1>Поздравляем!</h1>
<pre>
    <?var_dump($model);?>
</pre>
<?=$this->render('/common/_get-bonus', ['label'=>'Отказаться от этого приза и получить новый'])?>

<?php
    if(!empty($model->convertable)) {
        echo Html::a('Конвертировать в баллы', ['bonus/convert'], [
            'data' => [
                'confirm' => 'Уверены?',
                'method' => 'post',
            ],
            'class' => 'btn btn-warning'
        ]);
    }
?>

<?php
    if(!empty($model->convertable)) {
        echo Html::a('Перечислить на счет в банке', ['bonus/withdraw'], [
            'data' => [
                'confirm' => 'Уверены?',
                'method' => 'post',
            ],
            'class' => 'btn btn-success'
        ]);
    }
?>

<?php
if(!empty($model->enrollable)) {
    echo Html::a('Зачислить баллы', ['bonus/enroll'], [
        'data' => [
            'confirm' => 'Уверены?',
            'method' => 'post',
        ],
        'class' => 'btn btn-danger'
    ]);
}
?>

<?php
    if(!empty($model->orderable)) {
        $modelForm = new OrderForm;
        $form = ActiveForm::begin(['id' => 'order-form']);
            echo $form->field($modelForm, 'name')->textInput(['autofocus' => true]);
            echo $form->field($modelForm, 'address')->textarea(['rows' => 6]);
            echo Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']);
        ActiveForm::end();
    }
?>