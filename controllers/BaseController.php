<?php

namespace app\controllers;

use yii\web\Controller;

class BaseController extends Controller
{
    public function beforeAction($event)
    {
        if (!\Yii::$app->session['date']) \Yii::$app->session['date'] = date('Y-m-d');

        return parent::beforeAction($event);
    }
}
