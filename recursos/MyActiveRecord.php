<?php
namespace app\models;
use \yii\db\Expression;
use \yii\behaviors\BlameableBehavior;

class MyActiveRecord extends \yii\db\ActiveRecord{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'fecha_crea',
                'updatedAtAttribute' => 'fecha_modifica',
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'usuario_crea',
                'updatedByAttribute' => 'usuario_modifica',
            ],
        ];
    }
}