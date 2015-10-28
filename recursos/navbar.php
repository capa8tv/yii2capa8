<?php
[
    'label' => 'Admin',
    'items' => [
        ['label' => 'Noticia', 'url' => ['/noticia/index']],
        ['label' => 'Categoria', 'url' => ['/categoria/index']],
        [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ],
    ]
]