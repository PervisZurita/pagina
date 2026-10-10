<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class PreguntasFrecuentes extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'preguntasfrecuentes';
    }

    public function rules(): array
    {
        return [
            [['categoria_id', 'pregunta', 'respuestas'], 'required'],
            [['categoria_id'], 'integer'],
            [['respuestas'], 'string'],
            [['pregunta'], 'string', 'max' => 500],
            [
                ['categoria_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => CategoriasFaq::class,
                'targetAttribute' => ['categoria_id' => 'id'],
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'categoria_id' => 'Categoría',
            'pregunta' => 'Pregunta',
            'respuestas' => 'Respuesta',
        ];
    }

    public function getCategoria()
    {
        return $this->hasOne(
            CategoriasFaq::class,
            ['id' => 'categoria_id']
        );
    }
}
