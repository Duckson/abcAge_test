<?php
use yii\data\ArrayDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
$provider = new ArrayDataProvider([
    'allModels' => $goods,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'attributes' => ['name', 'count', 'orders'],
    ],
]);

$this->title = 'Ценники';
?>
<?=GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        [
            'attribute' => 'name',
            'label' => 'Товар'
        ],
        [
            'attribute' => 'count',
            'label' => 'Остаток'
        ],
        [
            'attribute' => 'orders',
            'label' => 'Заказов сегодня'
        ],
        [
            'attribute' => 'price',
            'label' => 'Стоимость',
            'value' => function($data) {
                return $data['price'] * 1.3;
            },
        ],
    ],
])?>
