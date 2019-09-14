<?php
/**
 * Created by PhpStorm.
 * User: �������
 * Date: 14.09.2019
 * Time: 15:21
 */

namespace tests\models;

use app\models\BonusMoney;
use app\models\BonusPoints;

/** ���� ������������ � ���� ��� ������ ������ ��� �� �����������, ��� ��� ��������� �� ����� */
class BonusMoneyTest extends \Codeception\TestCase\Test
{
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testConvertRate()
    {
        $bonusPoints = BonusPoints::create(10 * MONEY_TO_POINTS_RATE);

        $convertBonus = BonusMoney::create(10);
        $convertBonus = $convertBonus->convert();

        $this->assertEquals($convertBonus->amount, $bonusPoints->amount, "Error, convert method is not correct");
    }
}