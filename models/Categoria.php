<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property integer $id
 * @property string $categoria
 * @property string $seo_slug
 * @property string $imagen
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Noticia[] $noticias
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoria', 'created_by', 'updated_by'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['categoria', 'imagen'], 'string', 'max' => 45],
            [['seo_slug'], 'string', 'max' => 100],
//            ['categoria', function ($attribute, $params) {
//                if ($this->$attribute != "mysql") {
//                    $this->addError($attribute, 'Esta categoría no está permitida.');
//                }
//            }],
            ['categoria', 'categoriapermitida'],
            ['seo_slug', 'categoriapermitida'],
        ];
    }
    
    /*
    public function categoriapermitida()
    {
        if ($this->categoria != "php") {
            $this->addError('categoria', 'Esa categoría no está permitida.');
        }
    }
     */
    
    
    public function categoriapermitida($attribute, $params)
    {
        if ($this->$attribute != "php") {
            $this->addError($attribute, 'Esa categoría no está permitida.');
        }
    }
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoria' => 'Categoria',
            'seo_slug' => 'Seo Slug',
            'imagen' => 'Imagen',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
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
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticia::className(), ['categoria_id' => 'id']);
    }
}

