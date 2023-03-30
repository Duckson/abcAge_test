<?php

namespace app\controllers;

use app\models\Good;
use app\models\Order;
use Yii;

class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Страницца ценников
     *
     * @return string
     */
    public function actionIndex()
    {
        $goods = [];
        foreach (Good::find()->all() as $i => $good){
            $goods[$good->id]['name'] = $good->name;
            $goods[$good->id]['count'] = $good->count;
            $goods[$good->id]['orders'] = 0;
            $today_orders = Order::find()->andWhere(['date' => \Yii::$app->session['date']])->andWhere(['good_id' => $good->id])->all();
            if ($today_orders != []) foreach ($today_orders as $order_i => $order) {
                $goods[$good->id]['orders'] += $order->count;
            }
            $goods[$good->id]['price'] = $good->price;
        }

        return $this->render('index', [
            'goods' => $goods,
        ]);
    }

    /**
     * Изменение даты
     *
     */
    public function actionChangeDate()
    {
        if($this->request->post()){
            $date = $this->request->post()['date'];
            if(\DateTime::createFromFormat('Y-m-d', $date)->format('Y-m-d') == $date){
                Yii::$app->session['date'] = $date;
            } else {
                Yii::$app->session->setFlash('error', "Неверный формат даты");
            }
            
        }

        $this->redirect('index');
    }
}
