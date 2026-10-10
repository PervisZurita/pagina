<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class CodigoEtica2 extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%codigo_etica2}}';
    }

    public function rules(): array
    {
        return [
            [['titulo', 'contenido', 'categoria_id'], 'required'],
            [['contenido'], 'string'],
            [['categoria_id'], 'integer'],
            [['titulo'], 'string', 'max' => 255],
            [['articulo'], 'string', 'max' => 50],
            [
                ['categoria_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Categorias2::class,
                'targetAttribute' => ['categoria_id' => 'id'],
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'titulo' => 'Título',
            'articulo' => 'Artículo',
            'contenido' => 'Contenido',
            'categoria_id' => 'Categoría',
        ];
    }

    public function getCategoria()
    {
        return $this->hasOne(Categorias2::class, [
            'id' => 'categoria_id',
        ]);
    }
}