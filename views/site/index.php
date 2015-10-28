<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;
?>

<section class="col-md-9">
    <br><br><br><br>
    
    <?php foreach ($noticias as $key => $value): ?>
        <h2>
            <?= Html::a($value->titulo, ['noticia/' . $value->seo_slug]) ?>
        </h2>
        <p>Pubicado por: <?= $value->createdBy->name ?></p>
    <?php endforeach; ?>
    
    <div class="row text-center"><?php echo LinkPager::widget(['pagination'=>$pagination]); ?></div>
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