<?php

class Noticia {
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
                'class' => yii\behaviors\SluggableBehavior\SluggableBehavior::className(),
                'attribute' => 'titulo',
                'slugAttribute' => 'seo_slug',
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