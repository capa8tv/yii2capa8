<?php
$form = ActiveForm::begin(
[
  'id'  => 'form-comment',
  'enableAjaxValidation' => true,
  'enableClientValidation' => false,
  ]
);

//----------------------------------------------------------------------------------------------------------------

public function rules()
{
    return [
      ...
      ['web', 'url', 'message' => 'Por favor introduzca la URL completa, ej: http://www.blonder413.com'],
      ...
    ];
}

//----------------------------------------------------------------------------------------------------------------

if (Yii::$app->request->isAjax && $comment->load(Yii::$app->request->post()) ) {

  if (!$comment->validate()) {
      Yii::$app->response->format = 'json';
      return \yii\widgets\ActiveForm::validate($comment);
  }

  if ($comment->save()) {
      Yii::$app->session->setFlash("success", "Todo excelente!");
  } else {
      Yii::$app->session->setFlash("error", "Todo mal!");
  }
}
