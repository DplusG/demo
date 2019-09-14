<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\helpers\Console;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    public function beforeAction($action)
    {
        $this->app_path = \Yii::getAlias('@app');

        if (Console::isRunningOnWindows()) {
            shell_exec('chcp 65001');
        }

        return parent::beforeAction($action);
    }

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        /**
         * Тут выборка всех призов, где date is NULL
         * условие N штук - в конфиг, использовать в LIMIT
         * foreach(все_неотправленные as одна_неотправленная)
         *     Отправить();
         */

        echo $message . "\n";
    }
}
