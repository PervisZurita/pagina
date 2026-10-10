<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class CuestionarioOpciones extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'cuestionario_opciones';
    }

    public function rules(): array
    {
        return [
            [['pregunta_id', 'opcion'], 'required'],
            [['pregunta_id', 'es_correcta'], 'integer'],
            [['opcion'], 'string'],
            [['es_correcta'], 'default', 'value' => 0],
            [
                ['pregunta_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => CuestionarioPreguntas::class,
                'targetAttribute' => ['pregunta_id' => 'id'],
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'pregunta_id' => 'Pregunta',
            'opcion' => 'Opción de respuesta',
            'es_correcta' => 'Es correcta',
        ];
    }

    public function getPregunta()
    {
        return $this->hasOne(
            CuestionarioPreguntas::class,
            ['id' => 'pregunta_id']
        );
    }
}