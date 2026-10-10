<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\Documento $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="documento-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'titulo')->textInput([
        'maxlength' => true,
        'placeholder' => 'Nombre del documento',
    ]) ?>

    <?= $form->field($model, 'descripcion')->textarea([
        'rows' => 4,
        'placeholder' => 'Descripción del documento',
    ]) ?>

    <?= $form->field($model, 'archivo')->fileInput([
        'accept' => '.pdf,application/pdf',
    ])->label(
        $model->isNewRecord
            ? 'Seleccionar documento PDF'
            : 'Reemplazar PDF (opcional)'
    ) ?>

    <?php if (!$model->isNewRecord && $model->archivo): ?>
        <p>
            Archivo actual:
            <?= Html::a(
                Html::encode($model->archivo),
                '@web/documentos/' . rawurlencode($model->archivo),
                ['target' => '_blank', 'rel' => 'noopener']
            ) ?>
        </p>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton(
            '<i class="fa-solid fa-floppy-disk"></i> Guardar documento',
            ['class' => 'btn-documento-guardar']
        ) ?>

        <?= Html::a(
            'Cancelar',
            ['index'],
            ['class' => 'btn-documento-cancelar']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
