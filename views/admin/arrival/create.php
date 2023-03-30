<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Arrival $model */

$this->title = 'Создать поставку';
$this->params['breadcrumbs'][] = ['label' => 'Поставки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arrival-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'goods' => $goods,
    ]) ?>

</div>
