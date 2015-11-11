<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $correo
 * @property string $comentario
 * @property string $estado
 * @property integer $noticia_id
 * @property string $fecha
 *
 * @property Noticia $noticia
 */
class Comentario extends \yii\db\ActiveRecord
{
    public $verifyCode;
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['noticia_id', 'nombre', 'correo', 'comentario'], 'required'],
            [['noticia_id'], 'integer'],
            [['fecha'], 'safe'],
            [['nombre', 'correo', 'comentario', 'estado'], 'string', 'max' => 45],
//            ['correo', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha', "on" => "comentario"],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'correo' => 'Correo',
            'comentario' => 'Comentario',
            'estado' => 'Estado',
            'noticia_id' => 'Noticia ID',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticia()
    {
        return $this->hasOne(Noticia::className(), ['id' => 'noticia_id']);
    }
}
