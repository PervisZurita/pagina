<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class CuestionarioRespuestas extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'cuestionario_respuestas';
    }

    public function rules(): array
    {
        return [
            [['resultado_id', 'pregunta_id'], 'required'],
            [
                ['resultado_id', 'pregunta_id', 'opcion_id', 'es_correcta'],
                'integer',
            ],
            [['es_correcta'], 'default', 'value' => 0],
            [
                ['resultado_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => CuestionarioResultados::class,
                'targetAttribute' => ['resultado_id' => 'id'],
            ],
            [
                ['pregunta_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => CuestionarioPreguntas::class,
                'targetAttribute' => ['pregunta_id' => 'id'],
            ],
            [
                ['opcion_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => CuestionarioOpciones::class,
                'targetAttribute' => ['opcion_id' => 'id'],
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'resultado_id' => 'Resultado',
            'pregunta_id' => 'Pregunta',
            'opcion_id' => 'Opción seleccionada',
            'es_correcta' => 'Respuesta correcta',
        ];
    }

    public function getResultado()
    {
        return $this->hasOne(
            CuestionarioResultados::class,
            ['id' => 'resultado_id']
        );
    }

    public function getPregunta()
    {
        return $this->hasOne(
            CuestionarioPreguntas::class,
            ['id' => 'pregunta_id']
        );
    }

    public function getOpcion()
    {
        return $this->hasOne(
            CuestionarioOpciones::class,
            ['id' => 'opcion_id']
        );
    }
}