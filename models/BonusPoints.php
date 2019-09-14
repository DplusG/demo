<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 11.09.2019
 * Time: 16:30
 */

namespace app\models;


class BonusPoints extends Bonus
{
    public $amount;
    public $enrollable = true;

    public function init()
    {
        $this->amount = rand(1, BONUS_POINTS_MAX);
    }

    public static function create($amount)
    {
        $model = new static;
        $model->amount = $amount;
        return $model;
    }
}