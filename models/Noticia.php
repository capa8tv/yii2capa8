<?php

namespace app\models;

use \yii\db\ActiveRecord;
use yii\db\Expression;
use \yii\behaviors\BlameableBehavior;
use \yii\behaviors\SluggableBehavior;
use Yii;

/**
 * This is the model class for table "noticia".
 *
 * @property integer $id
 * @property string $titulo
 * @property string $seo_slug
 * @property string $detalle
 * @property integer $categoria_id
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property Categoria $categoria
 * @property User $createdBy
 * @property User $udatedBy
 */
class Noticia extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'noticia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'detalle', 'categoria_id'], 'required'],
            [['categoria_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['titulo', 'seo_slug'], 'string', 'max' => 100],
            [['detalle'], 'string', 'max' => 45],
            [['titulo', 'seo_slug'], 'unique'],
        ];
    }

    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'titulo',
                'slugAttribute' => 'seo_slug',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'seo_slug' => 'Seo Slug',
            'detalle' => 'Detalle',
            'categoria_id' => 'Categoria',
            'created_by' => 'Creado por',
            'created_at' => 'Created At',
            'updated_by' => 'Actualizado por',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'udated_by']);
    }
    
//    public function getTituloMejorado() {
//        return "el título es $this->titulo";
//    }
    
    public function getTotalComentarios()
    {
        return $this->hasMany(Comentario::className(), ['noticia_id' => 'id'])
                    ->where('estado = 1')
                    ->count('id');
    }
}
