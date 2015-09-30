http://www.bsourcecode.com/yiiframework2/select-query-sql-queries/

use yii\db\Query;

$connection = \Yii::$app->db;
$query = $connection->createCommand("SELECT * FROM categoria");;
// Ejecuta el commando
$rows = $query->queryAll();

echo "<pre>";
print_r($rows);