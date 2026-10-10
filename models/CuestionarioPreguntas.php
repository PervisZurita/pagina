<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class CuestionarioPreguntas extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'cuestionario_preguntas';
    }

    public function rules(): array
    {
        return [
            [['pregunta', 'categoria'], 'required'],
            [['pregunta', 'explicacion'], 'string'],
            [['estado'], 'integer'],
            [['fecha_creacion'], 'safe'],
            [['categoria'], 'string', 'max' => 100],
            [['estado'], 'default', 'value' => 1],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'pregunta' => 'Pregunta',
            'categoria' => 'Categoría',
            'explicacion' => 'Explicación',
            'estado' => 'Estado',
            'fecha_creacion' => 'Fecha de creación',
        ];
    }

    public function getOpciones()
    {
        return $this->hasMany(
            CuestionarioOpciones::class,
            ['pregunta_id' => 'id']
        );
    }
}