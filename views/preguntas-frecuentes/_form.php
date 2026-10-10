<?php

declare(strict_types=1);

/** @var app\models\PreguntasFrecuentes $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\CategoriasFaq;

$categorias = ArrayHelper::map(
    CategoriasFaq::find()->orderBy(['categoria' => SORT_ASC])->all(),
    'id',
    'categoria'
);

?>

<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'faq-form',
    ],
]); ?>

<div class="faq-form-group">

    <?= $form->field($model, 'categoria_id')->dropDownList(
        $categorias,
        [
            'prompt' => 'Selecciona una categoría',
            'class' => 'faq-select',
        ]
    ) ?>

</div>

<div class="faq-form-group">

    <?= $form->field($model, 'pregunta')->textInput([
        'maxlength' => true,
        'placeholder' => 'Escribe la pregunta frecuente',
        'class' => 'form-control faq-input',
    ]) ?>

</div>

<div class="faq-form-group">

    <?= $form->field($model, 'respuestas')->textarea([
        'rows' => 7,
        'placeholder' => 'Escribe una respuesta clara y completa...',
        'class' => 'form-control faq-textarea',
    ]) ?>

</div>

<div class="faq-form-actions">

    <?= Html::submitButton(
        '<i class="fas fa-floppy-disk"></i> Guardar pregunta',
        [
            'class' => 'btn-faq-primary',
            'encode' => false,
        ]
    ) ?>

    <?= Html::a(
        '<i class="fas fa-arrow-left"></i> Volver al listado',
        ['index'],
        [
            'class' => 'btn-faq-secondary',
        ]
    ) ?>

</div>

<?php ActiveForm::end(); ?>
