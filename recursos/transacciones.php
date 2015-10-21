<?php

$transaction = Noticia::getDb()->beginTransaction();

try {
    $model->detalle = html_entity_decode($model->detalle);

    $model->save();
    $transaction->commit();
    return $this->redirect(['view', 'id' => $model->id]);
} catch (\Exception $e) {
    $transaction->rollBack();
    throw $e;
}

// --------------------------------------------------------------------------------

use yii\db\Exception;

$transaction = \Yii::$app->db->beginTransaction();

try {

    $model->detalle = html_entity_decode($model->detalle);

    if ($model->save()) {
        $transaction->commit();
        Yii::$app->session->setFlash("success", "Noticia creada correctamente");
    } else {
        throw new Exception("La noticia no pudo ser creada");
    }
} catch (Exception $ex) {
    $transaction->rollBack();

    Yii::$app->session->setFlash("error", $ex->getMessage());
}

return $this->redirect(['view', 'id' => $model->id]);
