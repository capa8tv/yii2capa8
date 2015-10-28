<?php

$comentario = new Comentario();

if ($comentario->load(Yii::$app->request->post())) {

    $comentario->email = Security::mcrypt($comment->email);
    $comentario->fecha = new Expression('NOW()');
    $comentario->noticia_id = $noticia->id;
    $comentario->estado = 0;
    
    if ($comentario->save()) {
        $comentario = new Comment();
        Yii::$app->session->setFlash("success", "Gracias por su opinión. Su comentario será publicado una vez que sea moderado!");
    } else {
        Yii::$app->session->setFlash("error", "Su comentario no pudo ser registrado!");
    }
}