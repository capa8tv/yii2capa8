<?php
use kartik\alert\AlertBlock;
?>
<section class="col-md-9">
    <br><br><br><br>
    
    
<?php
echo AlertBlock::widget([
    'type' => AlertBlock::TYPE_ALERT,
    'useSessionFlash' => true,
    //'delay' => 10000,
]);
?>
    
    <?= \yii\helpers\Html::img("@web/web/img/mi-nueva-categoria.png", ["alt" => "imagen"]); ?>
    
    <h1><?= $noticia->titulo ?></h1>
    Categoría: <?= $noticia->categoria->categoria ?><br>
    Publicado por <?= $noticia->createdBy->name ?><br>
    
    <?= $noticia->detalle ?>
    
    <?= $this->render(
        '/comentario/_form',
        [
            'model' => $comentario,
        ]
    ) ?>
    
    
    <h2>Comentarios</h2>
    
    <ul>
    <?php foreach ($noticia->comentarios as $key => $value): ?>
        <li>
            <?= $value->nombre; ?> - <?= $value->fecha; ?><br>
            <?= $value->comentario; ?>
            <hr>
        </li>
    <?php endforeach; ?>
    </ul>
    
</section>

<aside class="hidden-xs hidden-sm col-md-3">
    <br><br><br><br>
    <?= $this->render(
        '/site/sidebar',
        [
            'categorias' => $categorias,
        ]
    ) ?>
</aside>