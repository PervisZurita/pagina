<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Responder debate';

$this->registerCss(<<<'CSS'

.respuesta-create {
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

.btn-publicar {
    background: #2563eb;
    color: white;
    border: none;
    padding: 13px 22px;
    border-radius: 10px;
    font-weight: 700;
    cursor: pointer;
}

.btn-publicar:hover {
    background: #1d4ed8;
}

CSS);
?>

<div class="respuesta-create">

    <div class="respuesta-box">

        <h1>
            <i class="fa-solid fa-reply"></i>
            Responder al debate
        </h1>

        <?php $form = ActiveForm::begin([
            'action' => [
                '/foro-respuesta/create',
                'foro_id' => $foro->id
            ],
            'method' => 'post',
        ]); ?>

        <?= $form->field(
            $model,
            'contenido'
        )->textarea([
            'placeholder' => 'Escribe tu respuesta...'
        ])->label('Tu respuesta') ?>

        <?= Html::submitButton(
            '<i class="fa-solid fa-paper-plane"></i> Publicar respuesta',
            [
                'class' => 'btn-publicar'
            ]
        ) ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
