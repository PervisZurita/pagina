<?php

namespace app\models;

use yii\db\ActiveRecord;

class ForoRespuesta extends ActiveRecord
{
    public static function tableName()
    {
        return 'fororespuestas';
    }

    public function rules()
    {
        return [
            [['foro_id', 'usuario_id', 'contenido'], 'required'],

            [['foro_id', 'usuario_id'], 'integer'],

            [['contenido'], 'string'],

            [['fecha_creacion'], 'safe'],

            [
                ['foro_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Foro::class,
                'targetAttribute' => ['foro_id' => 'id'],
            ],

            [
                ['usuario_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['usuario_id' => 'id'],
            ],
        ];
    }

    public function getForo()
    {
        return $this->hasOne(
            Foro::class,
            ['id' => 'foro_id']
        );
    }

    public function getUsuario()
    {
        return $this->hasOne(
            User::class,
            ['id' => 'usuario_id']
        );
    }
}
