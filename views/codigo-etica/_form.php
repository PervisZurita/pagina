<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\CodigoEtica2 $model */
/** @var app\models\Categorias2[] $categorias */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<div class="formulario-codigo">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'categoria_id')->dropDownList(
        ArrayHelper::map($categorias, 'id', 'nombre'),
        [
            'prompt' => 'Selecciona un capítulo',
            'class' => 'form-select',
        ]
    ) ?>

    <?= $form->field($model, 'articulo')->textInput([
        'maxlength' => true,
        'placeholder' => 'Ejemplo: Artículo 1',
    ]) ?>

    <?= $form->field($model, 'titulo')->textInput([
        'maxlength' => true,
        'placeholder' => 'Escribe el título del artículo',
    ]) ?>

    <?= $form->field($model, 'contenido')->textarea([
        'rows' => 12,
        'placeholder' => 'Escribe aquí el contenido del artículo...',
    ]) ?>

    <div class="formulario-acciones">

        <?= Html::submitButton(
            '<i class="fa-solid fa-floppy-disk"></i> Guardar artículo',
            ['class' => 'btn-guardar-articulo']
        ) ?>

        <?= Html::a(
            'Cancelar',
            ['/site/index'],
            ['class' => 'btn-cancelar-articulo']
        ) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
