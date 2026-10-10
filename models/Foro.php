<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Foro extends ActiveRecord
{
    public static function tableName()
    {
        return 'foro';
    }

    public function rules()
    {
        return [
            [['usuario_id', 'titulo', 'contenido'], 'required'],

            [['usuario_id'], 'integer'],

            [['contenido'], 'string'],

            [['fecha_creacion'], 'safe'],

            [['titulo'], 'string', 'max' => 255],

            [
                ['usuario_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['usuario_id' => 'id']
            ],
        ];
    }

    public function getUsuario()
    {
        return $this->hasOne(
            User::class,
            ['id' => 'usuario_id']
        );
    }

    public function getRespuestas()
    {
        return $this->hasMany(
            ForoRespuesta::class,
            ['foro_id' => 'id']
        );
    }
}
