https://github.com/2amigos/yii2-ckeditor-widget

composer require 2amigos/yii2-ckeditor-widget:~1.0

use dosamigos\ckeditor\CKEditor;

<?= $form->field($model, 'detalle')->widget(CKEditor::className(), [
    'options' => ['rows' => 6],
//    'preset' => 'basic',
    'preset' => 'complete',
]); ?>

$model->detalle = html_entity_decode($model->detalle);