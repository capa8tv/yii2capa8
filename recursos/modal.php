http://www.yiiframework.com/extension/yii2-prettyphoto/

--------------------------------------------------------------------------------

<?php

use yii\bootstrap\Modal;

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