<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\alert\AlertBlock;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NoticiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Noticias';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
echo AlertBlock::widget([
    'type' => AlertBlock::TYPE_ALERT,
    'useSessionFlash' => true,
    //'delay' => 10000,
]);
?>

<div class="noticia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Noticia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo',
            'detalle',
            //'categoria_id',
//            [
//                'attribute' => 'categoria_id',
//                'value'     => 'categoria.categoria',
//            ],
            [
                'attribute' => 'categoria_id',
                'value'     => 'categoria.categoria',
                'format'    => 'raw',
                'filter'    => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'categoria_id',
                                'data' => \yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->all(), 'id', 'categoria'),
                                'options' => ['placeholder' => 'Seleccione...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),
            ],
            'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
