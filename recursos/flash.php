<?php

if (!$model->save()) {
    Yii::$app->session->setFlash("success","no se pudo");
    return $this->redirect(['update', 'id' => $model->id]);
}

//https://github.com/kartik-v/yii2-widget-alert

use kartik\alert\AlertBlock;

echo AlertBlock::widget([
    'type' => AlertBlock::TYPE_ALERT,
    'useSessionFlash' => true,
    'delay' => 20000,
]);
?>

