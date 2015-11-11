https://github.com/kartik-v/yii2-widget-select2

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'titulo',
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
        [
            'attribute' => 'created_by',
            'value'     => 'createdBy.name',
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>


---------------------------------------------------------------------------------------------------------------------------

public function rules()
{
    return [
        [['created_by', 'updated_by'], 'safe'],
    ];
}

...validate()...

$query->joinWith('createdBy');

->andFilterWhere(['like', 'user.name', $this->created_by])
