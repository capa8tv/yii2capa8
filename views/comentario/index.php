<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Security;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComentarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comentarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Comentario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
//            'correo',
            [
                'attribute' => 'correo',
                'value'     => function ($searchModel) {
                    return Security::decrypt($searchModel->correo);
                }
            ],
            'comentario',
            'estado',
            // 'noticia_id',
            // 'created_by',
            // 'created_at',


            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{update} {delete} {aprobar}',
              'buttons' => [
                    'aprobar' => function ($url, $model) {
                        if ($model->estado == 0) {
                            return Html::a('<span class="glyphicon glyphicon-thumbs-up"></span>', $url,
                            [
                                'title' => 'aprobar',
                            ]);
                        }
                    },
                    'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                            [
                                'title' => 'Actualizar',
                            ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'aprobar') {
                    return yii\helpers\Url::to(['comentario/aprobar', 'id' => $key]);
                  } elseif ($action == 'update') {
                    return yii\helpers\Url::to(['comentario/update/', 'id' => $key]);
                  } elseif ($action === 'delete') {
                    return yii\helpers\Url::to(['comentario/delete/', 'id' => $key]);
                  }
                }
            ],
        ],
    ]); ?>

</div>
