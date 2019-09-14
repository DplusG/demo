<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 11.09.2019
 * Time: 16:31
 */

namespace app\models;


class BonusThing extends Bonus
{
    public $name;
    public $orderable = true;

    public function init()
    {
        $things = [
            'Диван',
            'Кровать',
            'Стул',
            'Ручка',
            'Ластик',
            'Телефон',
            'Колечко от бублика',
        ];
        $maxIndex = count($things) - 1;
        $index = rand(0, $maxIndex);
        $this->name = $things[$index];
    }
}