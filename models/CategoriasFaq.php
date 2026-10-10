<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class CategoriasFaq extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'categorias_faq';
    }

    public function rules(): array
    {
        return [
            [['categoria'], 'required'],
            [['categoria'], 'string', 'max' => 100],
            [['categoria'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'categoria' => 'Categoría',
        ];
    }

    public function getPreguntasFrecuentes()
    {
        return $this->hasMany(
            PreguntasFrecuentes::class,
            ['categoria_id' => 'id']
        );
    }
}
