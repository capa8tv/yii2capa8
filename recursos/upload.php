
VISTA
---------------------------------------

<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

<?= $form->field($model, 'file')->fileInput() ?>

=======================================================================================================================

MODELO
---------------------------------------

public $file;

public function rules()
{
        return [
            .....
            [['file'], 'file'],
            .....
        ];
}

public function attributeLabels()
    {
        return [
            .....
            'file'          => 'Imagen',
            .....
        ];
    }

=======================================================================================================================

CONTROLLER
---------------------------------------

use yii\web\UploadedFile;
use app\models\Helper;

public function actionCreate()
{
    $model->file = UploadedFile::getInstance($model, 'file');
            
    $model->imagen = Helper::limpiaUrl($model->categoria . '.' . $model->file->extension);
    $model->file->saveAs( 'web/img/' . $model->imagen);
}