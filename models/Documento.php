<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class Documento extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%documentos}}';
    }

    public function rules(): array
    {
        return [
            [['titulo', 'archivo'], 'required'],
            [['descripcion'], 'string'],
            [['titulo'], 'string', 'max' => 200],
            [['archivo'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'titulo' => 'Título del documento',
            'descripcion' => 'Descripción',
            'archivo' => 'Archivo PDF',
            'fecha_creacion' => 'Fecha de publicación',
        ];
    }
}
