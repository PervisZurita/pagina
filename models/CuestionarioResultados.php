<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class CuestionarioResultados extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'cuestionario_resultados';
    }

    public function rules(): array
    {
        return [
            [['total_preguntas'], 'required'],
            [
                ['usuario_id', 'total_preguntas', 'respuestas_correctas'],
                'integer',
            ],
            [['puntuacion'], 'number', 'min' => 0, 'max' => 100],
            [['fecha_realizacion'], 'safe'],
            [['puntuacion'], 'default', 'value' => 0],
            [['respuestas_correctas'], 'default', 'value' => 0],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario',
            'puntuacion' => 'Calificación',
            'total_preguntas' => 'Total de preguntas',
            'respuestas_correctas' => 'Respuestas correctas',
            'fecha_realizacion' => 'Fecha de realización',
        ];
    }

    public function getRespuestas()
    {
        return $this->hasMany(
            CuestionarioRespuestas::class,
            ['resultado_id' => 'id']
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