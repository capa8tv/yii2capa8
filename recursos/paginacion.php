$query = Noticia::find();

$pagination = new Pagination([
    'defaultPageSize'   => 15,
    'totalCount'        => $query->count(),
]);

$noticias = $query->orderBy('id desc')
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
                    

                    
--------------------------------------------------------------------



use yii\widgets\LinkPager;


<section class="posts col-md-9">
    foreach...
    
    <div class="row text-center"><?php echo LinkPager::widget(['pagination'=>$pagination]); ?></div>
    
</section>

<aside class="hidden-xs hidden-sm col-md-3">
    <?= $this->render(
        '/site/_sidebar'
    ) ?>
</aside>



--------------------------------------------------------------------

<div class="list-group">
    <h4>Categorías</h4>
    <a href="#" class="list-group-item">Categoría 1</a>
    <a href="#" class="list-group-item">Categoría 2</a>
    <a href="#" class="list-group-item">Categoría 3</a>
    <a href="#" class="list-group-item">Categoría 4</a>
    <a href="#" class="list-group-item">Categoría 5</a>
  </div>