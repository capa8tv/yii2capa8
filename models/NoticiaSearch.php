<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Noticia;

/**
 * NoticiaSearch represents the model behind the search form about `app\models\Noticia`.
 */
class NoticiaSearch extends Noticia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'categoria_id', 'created_by', 'udated_by'], 'integer'],
            [['titulo', 'detalle', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Noticia::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'categoria_id' => $this->categoria_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'udated_by' => $this->udated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'detalle', $this->detalle]);

        return $dataProvider;
    }
}
