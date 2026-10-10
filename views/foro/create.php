<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Nuevo debate';

$this->registerCss(<<<'CSS'

.foro-create-page {
    width: 100%;
    min-height: 100vh;
    background: #f8fafc;
    padding: 50px 30px 80px;
}

.foro-create-container {
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
}

/* CABECERA */

.create-header {
    background: linear-gradient(135deg, #0f172a, #1e3a8a);
    color: white;

    border-radius: 20px 20px 0 0;

    padding: 35px 45px;

    display: flex;
    align-items: center;
    gap: 20px;
}

.create-header-icon {
    width: 65px;
    height: 65px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 16px;

    background: rgba(255,255,255,.12);

    font-size: 28px;
}

.create-header h1 {
    margin: 0 0 5px;
    font-size: 30px;
    font-weight: 800;
}

.create-header p {
    margin: 0;
    color: #dbeafe;
}

/* FORMULARIO */

.create-body {
    background: white;

    border-radius: 0 0 20px 20px;

    padding: 45px;

    border: 1px solid #e2e8f0;
    border-top: none;

    box-shadow: 0 15px 35px rgba(15, 23, 42, .08);
}

.form-group {
    margin-bottom: 25px;
}

.control-label {
    display: block;

    margin-bottom: 9px;

    color: #0f172a;

    font-size: 15px;
    font-weight: 700;
}

.control-label i {
    color: #2563eb;
    margin-right: 7px;
}

.form-control {
    width: 100% !important;

    min-height: 58px;

    border: 1px solid #cbd5e1;

    border-radius: 11px;

    padding: 15px 18px;

    font-size: 16px;

    color: #0f172a;

    background: #fff;

    box-shadow: none;

    transition: .2s ease;
}

.form-control:focus {
    border-color: #2563eb;

    box-shadow: 0 0 0 4px rgba(37, 99, 235, .10);
}

textarea.form-control {
    min-height: 220px;
    resize: vertical;
}

/* INFORMACIÓN */

.create-info {
    display: flex;
    align-items: flex-start;
    gap: 13px;

    background: #eff6ff;

    border: 1px solid #bfdbfe;

    border-radius: 12px;

    padding: 17px;

    margin-bottom: 30px;

    color: #1e40af;
}

.create-info i {
    font-size: 20px;
    margin-top: 2px;
}

.create-info strong {
    display: block;
    margin-bottom: 4px;
}

.create-info p {
    margin: 0;
    font-size: 14px;
}

/* BOTONES */

.form-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 12px;

    margin-top: 30px;
}

.btn-cancelar {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    padding: 13px 20px;

    border-radius: 10px;

    background: #f1f5f9;
    color: #475569;

    text-decoration: none;

    font-weight: 700;
}

.btn-cancelar:hover {
    background: #e2e8f0;
    color: #334155;
}

.btn-publicar {
    border: none;

    display: inline-flex;
    align-items: center;
    gap: 8px;

    padding: 13px 23px;

    border-radius: 10px;

    background: #2563eb;
    color: white;

    font-weight: 700;

    cursor: pointer;

    transition: .2s ease;
}

.btn-publicar:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
}

/* ERRORES */

.help-block {
    color: #dc2626;
    font-size: 13px;
    margin-top: 6px;
}

/* RESPONSIVE */

@media (max-width: 768px) {

    .foro-create-page {
        padding: 25px 15px 50px;
    }

    .create-header {
        padding: 30px 25px;
        flex-direction: column;
        text-align: center;
    }

    .create-header h1 {
        font-size: 25px;
    }

    .create-body {
        padding: 30px 22px;
    }

    .form-buttons {
        flex-direction: column-reverse;
    }

    .btn-cancelar,
    .btn-publicar {
        justify-content: center;
        width: 100%;
    }

}

CSS);
?>

<div class="foro-create-page">

    <div class="foro-create-container">

        <!-- CABECERA -->

        <div class="create-header">

            <div class="create-header-icon">
                <i class="fa-solid fa-comments"></i>
            </div>

            <div>

                <h1>
                    Crear nuevo debate
                </h1>

                <p>
                    Comparte una idea, pregunta o reflexión
                    con la comunidad.
                </p>

            </div>

        </div>


        <!-- FORMULARIO -->

        <div class="create-body">

            <div class="create-info">

                <i class="fa-solid fa-circle-info"></i>

                <div>

                    <strong>
                        Participación responsable
                    </strong>

                    <p>
                        Publica contenido relacionado con la ética
                        de la investigación científica y respeta
                        las opiniones de los demás participantes.
                    </p>

                </div>

            </div>


            <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'foro-form'
                ]
            ]); ?>


            <?= $form->field(
                $foro,
                'titulo'
            )->textInput([
                'maxlength' => true,
                'placeholder' => 'Escribe el título de tu debate'
            ])->label(
                '<i class="fa-solid fa-heading"></i> Título del debate',
                [
                    'encode' => false
                ]
            ) ?>


            <?= $form->field(
                $foro,
                'contenido'
            )->textarea([
                'rows' => 8,
                'placeholder' => 'Escribe aquí tu pregunta, opinión o reflexión...'
            ])->label(
                '<i class="fa-solid fa-align-left"></i> Contenido',
                [
                    'encode' => false
                ]
            ) ?>


            <div class="form-buttons">

                <?= Html::a(
                    '<i class="fa-solid fa-arrow-left"></i> Cancelar',
                    ['index'],
                    [
                        'class' => 'btn-cancelar'
                    ]
                ) ?>

                <?= Html::submitButton(
                    '<i class="fa-solid fa-paper-plane"></i> Publicar debate',
                    [
                        'class' => 'btn-publicar'
                    ]
                ) ?>

            </div>


            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>
