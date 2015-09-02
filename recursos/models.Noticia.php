<?php

class Noticia {
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['fecha_crea', 'fecha_modifica'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['fecha_modifica'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'usuario_crea',
                'updatedByAttribute' => 'usuario_modifica',
            ],
            [
                'class' => yii\behaviors\SluggableBehavior\SluggableBehavior::className(),
                'attribute' => 'titulo',
                'slugAttribute' => 'slug',
            ],
        ];
    }
    //-----------------------------------------------------------------------------------------------------------------
    public function getTotalComentarios()
    {
        return $this->hasMany(Comentario::className(), ['noticia_id' => 'id'])
                    ->where('estado = 1')
                    ->count('id');
    }
    //-----------------------------------------------------------------------------------------------------------------
    
}
?>