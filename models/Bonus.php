<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 11.09.2019
 * Time: 16:27
 */

namespace app\models;

use yii\base\Model;
use Yii;

abstract class Bonus extends Model
{
    public static $types;

    public static function beforeCreateRandom()
    {
        $types = ['Points'];
        if(BONUS_MONEY_AMOUNT) {
            $types[] = 'Money';
        }
        if(BONUS_THING_AMOUNT) {
            $types[] = 'Thing';
        }

        static::$types = $types;
    }

    public static function createRandom()
    {
        static::beforeCreateRandom();
        $types = static::$types;
        $count = count($types);
        $index = rand(0, $count-1);
        $bonusType = $types[$index];

        return static::create($bonusType);
    }

    public static function create($bonusType)
    {
        $className = __CLASS__ . $bonusType;

        try {
            if(class_exists($className) && $bonusType) {
                return new $className;
            } else {
                throw new \Exception('Такого приза нет');
            }
        } catch(\Exception $e) {
            echo $e->getMessage();
            // log
            exit;
        }
    }

    public static function getCurrent()
    {
        $session = Yii::$app->session;
        $model = $session->get('bonus');
        return $model;
    }
}