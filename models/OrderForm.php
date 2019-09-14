<?php

namespace app\models;

use Yii;
use yii\base\Model;

class OrderForm extends Model
{
    public $name;
    public $address;

    public function order()
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo(Yii::$app->params['adminEmail'])
                ->setFrom(Yii::$app->params['noreplyEmail'])
                ->setSubject("Бонусный товар")
                ->setTextBody($this->name . '. ' . $this->address)
                ->send();

            return true;
        }
        return false;
    }
}
