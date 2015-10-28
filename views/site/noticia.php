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