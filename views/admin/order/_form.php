<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerJs('
    var counts=JSON.parse(\'' . json_encode($counts) . '\')
    var orderCount = document.getElementById("order-count")
    
    orderCount.onkeyup = function(){
        console.log(this)
        if(this.value != ""){
          if(parseInt(this.value) < parseInt(this.min)){
            this.value = this.min;
          }
          if(parseInt(this.value) > parseInt(this.max)){
            this.value = this.max;
          }
        }
    }

    document.getElementById("order-good_id").onchange = changeGood
    changeGood()

    function changeGood() {
        var count = counts[document.getElementById("order-good_id").value]
        document.getElementById("remainder").innerText = \'Остаток выбранного товара: \' + count
        orderCount.setAttribute("max", count)
    }
');
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'good_id')->dropDownList($goods) ?>
    <div id='remainder' class="alert alert-secondary">Остаток выбранного товара: <?= array_values($counts)[0] ?></div>

    <?= $form->field($model, 'count')->textInput(['type' => 'number']) ?>
    
    <input type="hidden" id="order-date" class="form-control" name="Order[date]" value="<?= \Yii::$app->session['date'] ?>">

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
