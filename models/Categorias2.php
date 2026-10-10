<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class Categorias2 extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%categorias2}}';
    }

    public function rules(): array
    {
        return [
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
            [['nombre'], 'string', 'max' => 150],
            [
                ['nombre'],
                'unique',
                'message' => 'Esta categoría ya existe.',
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre de la categoría',
            'descripcion' => 'Descripción',
        ];
    }

    public function getCodigoEticas()
    {
        return $this->hasMany(CodigoEtica2::class, [
            'categoria_id' => 'id',
        ]);
    }
}
