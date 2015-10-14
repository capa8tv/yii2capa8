<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'nombre',
        [
            'attribute' => 'correo',
            'value'     => function ($searchModel) {
                return Security::decrypt($searchModel->email);
            }
        ],
        'comentario:ntext',
        // 'noticia_id',
        // 'created_by',
        // 'created_at',
        // 'updated_by',
        // 'updated_at',
        [
            'attribute' => 'noticia_id',
            'format'    => 'raw',
            'value'     => function ($searchModel) {
                return Html::a($searchModel->noticia->titulo, "@web/articulo/" . $searchModel->noticia->seo_slug);
            },
        ],
        //'status',
        [
            'attribute' => 'estado',
            'format'    => 'raw',
            'value'     => function($searchModel) {
                if ($searchModel->estado === 0) {
                    return "<span class='glyphicon glyphicon-remove'></span>";
                } else {
                    return "<span class='glyphicon glyphicon-ok'></span>";
                }
            }
        ],

        //[
        //    'class' => 'yii\grid\ActionColumn',
        //    'template' => '{view} {update} {delete}'
        //],

        [
          'class' => 'yii\grid\ActionColumn',
          'template' => '{update} {delete} {aprobar}',
          'buttons' => [
                'aprobar' => function ($url, $model) {
                    if ($model->estado === 0) {
                        return Html::a('<span class="glyphicon glyphicon-thumbs-up"></span>', $url,
                        [
                            'title' => Yii::t('app', 'Aprobar comentario'),
                        ]);
                    }
                },
                'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                        [
                            'title' => Yii::t('app', 'Actualizar'),
                        ]);
                }
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
              if ($action === 'approve') {
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
