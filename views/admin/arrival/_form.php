<?php

use app\models\Good;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Arrival $model */
/** @var yii\widgets\ActiveForm $form */
/** @var [] $goods */
?>

<div class="arrival-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'good_id')->dropDownList($goods) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <input type="hidden" id="arrival-date" class="form-control" name="Arrival[date]" value="<?= \Yii::$app->session['date'] ?>">

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
