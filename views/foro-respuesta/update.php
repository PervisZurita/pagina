<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Editar respuesta';

$this->registerCss(<<<'CSS'

.respuesta-update {
    max-width: 850px;
    margin: 50px auto;
    padding: 0 20px;
}

.respuesta-box {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 40px;
    box-shadow: 0 12px 30px rgba(15,23,42,.08);
}

.respuesta-box h1 {
    color: #0f172a;
    margin-bottom: 25px;
}

.form-control {
    width: 100% !important;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    padding: 15px;
}

textarea.form-control {
    min-height: 200px;
}

.botones {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.btn-guardar {
    background: #2563eb;
    color: white;
    border: none;
    padding: 13px 22px;
    border-radius: 10px;
    font-weight: 700;
}

.btn-cancelar {
    background: #f1f5f9;
    color: #475569;
    padding: 13px 22px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 700;
}

CSS);
?>

<div class="respuesta-update">

    <div class="respuesta-box">

        <h1>
            <i class="fa-solid fa-pen"></i>
            Editar respuesta
        </h1>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field(
            $model,
            'contenido'
        )->textarea([
            'placeholder' => 'Modifica tu respuesta...'
        ])->label('Respuesta') ?>

        <div class="botones">

            <?= Html::a(
                '<i class="fa-solid fa-arrow-left"></i> Cancelar',
                [
                    '/foro/view',
                    'id' => $model->foro_id
                ],
                [
                    'class' => 'btn-cancelar'
                ]
            ) ?>

            <?= Html::submitButton(
                '<i class="fa-solid fa-floppy-disk"></i> Guardar cambios',
                [
                    'class' => 'btn-guardar'
                ]
            ) ?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
