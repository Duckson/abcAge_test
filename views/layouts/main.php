<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

AppAsset::register($this);
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title>
        <?= Html::encode($this->title) ?>
    </title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => 'Тестовое задание',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top w100']
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => [
                ['label' => 'Ценник', 'url' => ['/site/index']],
                [
                    'label' => 'Админка',
                    'items' => [
                        ['label' => 'Виды товаров', 'url' => ['/admin/good']],
                        ['label' => 'Поставки', 'url' => ['/admin/arrival']],
                        ['label' => 'Заказы', 'url' => ['/admin/order']],
                    ],
                ],
            ]
        ]); ?>
        <div class='collapse navbar-collapse justify-content-end w100'>
            <?= Html::beginForm(['/site/change-date'], 'POST', ['class' => 'd-inline']); ?>

            <div class="d-inline">
                <span class='text-white'>Дата:</span> <?= MaskedInput::widget(['name' => 'date', 'mask' => '9999-99-99', 'value' => \Yii::$app->session['date'],
                 'options' => ['class' => 'd-inline']]); ?>
            </div>

            <div class="d-inline">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?= Html::endForm(); ?>
        </div>
        <?php NavBar::end(); ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i>Ошибка!</h4>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>