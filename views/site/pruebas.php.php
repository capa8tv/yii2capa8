<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<br><br><br><br>

<h1>Aprendiendo el trabajo con vistas en Yii2</h1>

<?= Html::a(
    'Ir a acerca de',
    ['/site/about'],
    [
        'class' => 'btn btn-primary',
        'title' => 'más sobre el sitio',
    ]
) ?>

<?= Html::img(
    '@web/web/img/logo.png',
    [
        'width' => '200'
    ]
) ?>

<?= Html::a(
    Html::img(
        '@web/web/img/logo.png',
        [
            'width' => '200'
        ]
    ),
    ['/site/about'],
    [
        'title' => 'más sobre el sitio',
    ]
) ?>

<br><br>

<?php
Modal::begin([
    'header' => '<h2>Hello world</h2>',
    'toggleButton' => ['label' => 'click me'],
]);

echo 'Say hello...';

Modal::end();
?>

<br><br>

<?php
Modal::begin([
    'header' => Html::img(
        '@web/web/img/logo.png', 
        [
            'alt' => 'Capa8 tv',
            'title' => 'Capa8 tv',
        ]
    ),
    'toggleButton' => ['label' =>
        Html::img(
            '@web/web/img/logo.png',
            [
                'alt' => 'Capa8 tv',
                'title' => 'Capa8 tv',
                'width' => '300',
            ]
        ),
    ],
]);

echo '<p>Jonathan Morales Salazar</p>';
echo '<p>Ingeniero de Sistemas</p>';
echo '<p>Curso de YiiFramework 2</p>';

Modal::end();
?>