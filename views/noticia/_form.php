<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Noticia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticia-form">

    <?php $form = ActiveForm::begin(
        [
            'id'  => 'form-noticia',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
        ]
    ); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detalle')->textArea(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'categoria_id')->textInput() ?>
    
    <?= $form->field($model, 'categoria_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->all(), 'id', 'categoria'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
