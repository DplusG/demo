<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 12.09.2019
 * Time: 23:59
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Bonus;
use app\models\OrderForm;

class BonusController extends Controller
{
    public $defaultAction = 'create';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'get-bonus'],
                'rules' => [
                    [
                        'actions' => ['logout', 'get-bonus'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if(parent::beforeAction($action)) {
            $session = Yii::$app->session;
            if (!$session->isActive) {
                $session->open();
            }

            return true;
        } else {
            return false;
        }
    }

    public function actionCreate()
    {
        $session = Yii::$app->session;
        //new
        $model = Bonus::createRandom();
        $session->set('bonus', $model);
        return $this->redirect(['view']);
    }

    public function actionView()
    {
        $model = Bonus::getCurrent();
        if(!$model) {
            return $this->redirect(['create']);
        }

        return $this->render('view', compact('model'));
    }

    public function actionConvert()
    {
        $session = Yii::$app->session;
        $model = Bonus::getCurrent();
        if(!empty($model->convertable)) {
            $newModel = $model->convert();
            $session->set('bonus', $newModel);
            return $this->redirect(['view']);
        } else {
            // log
            return $this->redirect(['/site/index']);
        }
    }

    public function actionEnroll()
    {
        $session = Yii::$app->session;
        $model = Bonus::getCurrent();
        if(!empty($model->enrollable)) {
            $session->set('bonus', null);
            /* примерно
            $user = new User;
            $user->points += $model->amount;
            $user->save();
            */
        } else {
            // log
        }

        return $this->redirect(['/site/index']);
    }

    public function actionOrder()
    {
        $model = new OrderForm();
        if ($model->load(Yii::$app->request->post()) && $model->order()) {
            $message = 'Товар отправлен';
        } else {
            $message = Yii::$app->params['errMessage'];
        }

        return $this->redirect(['/site/index', 'message' => $message]);
    }

    public function actionWithdraw()
    {
        $session = Yii::$app->session;
        $model = Bonus::getCurrent();
        if($model->withdraw()) {
            $session->set('bonus', NULL);
            $message = "Заявка на вывод отправлена";
        } else {
            $message = Yii::$app->params['errMessage'];
        }

        return $this->redirect(['/site/index', 'message' => $message]);
    }
}