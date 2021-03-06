http://www.bsourcecode.com/yiiframework2/select-query-sql-queries/

$connection = \Yii::$app->db;
$query = $connection->createCommand("SELECT * FROM categoria");
$rows = $query->queryAll();


$connection = \Yii::$app->db;
$query = $connection->createCommand("SELECT * FROM categoria");
$rows = $query->queryOne();

$connection = \Yii::$app->db;
$query = $connection->createCommand("SELECT categoria FROM categoria");
$rows = $query->queryColumn();

$connection = \Yii::$app->db;
$query = $connection->createCommand("SELECT COUNT(*) FROM categoria");
$rows = $query->queryScalar();

$connection = \Yii::$app->db;
$rows = $connection->createCommand('SELECT * FROM categoria WHERE id=:id')
     ->bindValue(':id', 3)
     ->queryOne();

$connection = \Yii::$app->db;
$params = [":id" => 3, ":created_by" => 2];
$rows = $connection->createCommand('SELECT * FROM categoria WHERE id = :id AND created_by = :created_by')
        ->bindValues($params)
        ->queryOne();


echo "<pre>";
print_r($rows);

-----------------------------------------------------------------------------------------------------------------------

http://www.yiiframework.com/doc-2.0/yii-data-arraydataprovider.html

use yii\data\ArrayDataProvider;

$connection = \Yii::$app->db;
$query = $connection->createCommand("SELECT * FROM categoria");;
$searchModel = $query->queryAll();

$dataProvider = new ArrayDataProvider([
  'allModels' => $searchModel,
  'sort' => [
      'attributes' => ['categoria'],
  ],
  'pagination' => [
      'pageSize' => 10,
  ],
]);

-----------------------------------------------------------------------------------------------------------------------

http://www.yiiframework.com/doc-2.0/yii-db-query.html

use yii\data\ArrayDataProvider;
use yii\db\Query;

$searchModel = new Query;
$dataProvider = new ArrayDataProvider([
    'allModels' => $searchModel->from('categoria')->all(),
    'sort' => [
        'attributes' => ['categoria'],
    ],
    'pagination' => [
        'pageSize' => 10,
    ],
]);
