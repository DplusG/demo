<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 11.09.2019
 * Time: 16:29
 */

namespace app\models;

use app\common\Request;
use app\common\APIGateway;

class BonusMoney extends Bonus
{
    public $amount;
    public $convertable = true;

    public function init()
    {
        $this->amount = rand(1, BONUS_MONEY_MAX);
    }

    public function withdraw()
    {
        $model = static::getCurrent();
        $request = new Request('POST', 'https://mybank.ru', [], $model->amount);
        try {
            $res = APIGateway::send($request);
        } catch(\Exception $e) {
            // log $e->getMessage()
            $res = false;
        }

        return $res;
    }

    public function convert()
    {
        return $this->convertToPoints();
    }

    public function convertToPoints()
    {
        $bonus = new BonusPoints();
        $bonus->amount = $this->amount * MONEY_TO_POINTS_RATE;
        return $bonus;
    }

    public static function create($amount)
    {
        $model = new static;
        $model->amount = $amount;
        return $model;
    }
}