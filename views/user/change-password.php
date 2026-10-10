<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ChangePasswordForm $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Cambiar contraseña';

$this->registerCss(<<<'CSS'

/* =========================================================
   CONTENEDOR PRINCIPAL
========================================================= */

.change-password-page {
    width: 100%;
    padding: 30px 10px 50px;
}


/* =========================================================
   ENCABEZADO
========================================================= */

.change-password-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;

    margin-bottom: 30px;
    padding: 30px;

    background: linear-gradient(
        135deg,
        #0f172a,
        #1e3a8a
    );

    border-radius: 18px;
    color: white;

    box-shadow:
        0 12px 35px rgba(15, 23, 42, .18);
}

.change-password-header-content {
    display: flex;
    align-items: center;
    gap: 18px;
}

.change-password-header-icon {
    width: 65px;
    height: 65px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 16px;

    background: rgba(255, 255, 255, .15);

    font-size: 28px;
}

.change-password-header h1 {
    margin: 0 0 5px;

    font-size: 28px;
    font-weight: 700;
}

.change-password-header p {
    margin: 0;

    color: rgba(255, 255, 255, .75);

    font-size: 14px;
}


/* =========================================================
   BOTÓN VOLVER
========================================================= */

.btn-back-password {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 9px;

    padding: 11px 17px;

    border-radius: 10px;

    background: rgba(255, 255, 255, .12);

    border: 1px solid rgba(255, 255, 255, .2);

    color: white;

    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    transition: all .25s ease;
}

.btn-back-password:hover {
    background: white;
    color: #1e3a8a;

    transform: translateY(-2px);

    text-decoration: none;
}


/* =========================================================
   TARJETA
========================================================= */

.change-password-card {
    width: 100%;
    max-width: 1050px;

    margin: 0 auto;

    background: #ffffff;

    border: 1px solid #e5e7eb;

    border-radius: 18px;

    box-shadow:
        0 8px 30px rgba(15, 23, 42, .07);

    overflow: hidden;
}


/* =========================================================
   CABECERA TARJETA
========================================================= */

.change-password-card-header {
    display: flex;
    align-items: center;

    gap: 10px;

    padding: 20px 30px;

    background: #f8fafc;

    border-bottom: 1px solid #e5e7eb;
}

.change-password-card-header i {
    color: #2563eb;
    font-size: 18px;
}

.change-password-card-header h2 {
    margin: 0;

    color: #0f172a;

    font-size: 17px;

    font-weight: 700;
}


/* =========================================================
   CUERPO
========================================================= */

.change-password-body {
    padding: 40px 50px;
}


/* =========================================================
   CAMPOS
========================================================= */

.change-password-body .form-group {
    width: 100%;
    margin-bottom: 25px;
}

.change-password-body label {
    display: block;

    margin-bottom: 9px;

    color: #334155;

    font-size: 13px;

    font-weight: 700;
}


/* =========================================================
   ICONOS DE LOS LABELS
========================================================= */

.change-password-body label i {
    margin-right: 6px;
    color: #2563eb;
}


/* =========================================================
   CONTENEDOR DEL INPUT
========================================================= */

.password-input-wrapper {
    position: relative;

    width: 100%;
}


/* =========================================================
   INPUTS GRANDES
========================================================= */

.password-input-wrapper .form-control {

    display: block;

    width: 100%;

    height: 56px;

    padding: 12px 18px;

    border: 1px solid #dbe2ea;

    border-radius: 11px;

    background: #ffffff;

    color: #334155;

    font-size: 15px;

    line-height: 1.5;

    box-sizing: border-box;

    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        background .2s ease;
}


/* =========================================================
   PLACEHOLDER
========================================================= */

.password-input-wrapper .form-control::placeholder {
    color: #94a3b8;
    font-size: 14px;
}


/* =========================================================
   INPUT AL HACER CLICK
========================================================= */

.password-input-wrapper .form-control:focus {

    border-color: #2563eb;

    background: #ffffff;

    box-shadow:
        0 0 0 4px rgba(37, 99, 235, .10);

    outline: none;
}


/* =========================================================
   INPUT CON ERROR
========================================================= */

.password-input-wrapper .has-error .form-control,
.has-error .password-input-wrapper .form-control {
    border-color: #ef4444;
}


/* =========================================================
   MENSAJES DE ERROR
========================================================= */

.change-password-body .help-block {

    margin-top: 7px;

    color: #ef4444;

    font-size: 12px;
}


/* =========================================================
   INFORMACIÓN DE SEGURIDAD
========================================================= */

.password-security-info {

    display: flex;

    align-items: flex-start;

    gap: 12px;

    margin-top: 5px;

    margin-bottom: 25px;

    padding: 16px 18px;

    border-radius: 11px;

    background: #f8fafc;

    border: 1px solid #e5e7eb;

    color: #64748b;

    font-size: 13px;

    line-height: 1.6;
}

.password-security-info i {

    margin-top: 3px;

    color: #7c3aed;

    font-size: 15px;
}


/* =========================================================
   BOTONES
========================================================= */

.change-password-actions {

    display: flex;

    justify-content: flex-end;

    align-items: center;

    gap: 12px;

    margin-top: 30px;

    padding-top: 25px;

    border-top: 1px solid #e5e7eb;
}


/* =========================================================
   BOTÓN CANCELAR
========================================================= */

.btn-cancel-password {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    min-width: 125px;

    height: 46px;

    padding: 0 20px;

    border-radius: 9px;

    background: #f1f5f9;

    color: #475569;

    text-decoration: none;

    font-size: 14px;

    font-weight: 600;

    transition: all .2s ease;
}

.btn-cancel-password:hover {

    background: #e2e8f0;

    color: #334155;

    text-decoration: none;
}


/* =========================================================
   BOTÓN ACTUALIZAR
========================================================= */

.btn-save-password {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    min-width: 190px;

    height: 46px;

    padding: 0 22px;

    border: none;

    border-radius: 9px;

    background: #2563eb;

    color: white;

    font-size: 14px;

    font-weight: 600;

    cursor: pointer;

    transition: all .2s ease;
}

.btn-save-password:hover {

    background: #1d4ed8;

    color: white;

    transform: translateY(-2px);

    box-shadow:
        0 7px 18px rgba(37, 99, 235, .25);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 900px) {

    .change-password-card {
        max-width: 100%;
    }

    .change-password-body {
        padding: 30px;
    }
}


@media (max-width: 768px) {

    .change-password-page {
        padding: 20px 5px 40px;
    }

    .change-password-header {

        flex-direction: column;

        align-items: flex-start;

        padding: 22px;
    }

    .change-password-header-content {
        width: 100%;
    }

    .change-password-header h1 {
        font-size: 23px;
    }

    .btn-back-password {
        width: 100%;
    }

    .change-password-body {
        padding: 25px 20px;
    }

    .password-input-wrapper .form-control {
        height: 54px;
    }

    .change-password-actions {

        flex-direction: column-reverse;

        align-items: stretch;
    }

    .btn-save-password,
    .btn-cancel-password {
        width: 100%;
    }
}


@media (max-width: 480px) {

    .change-password-header-content {
        align-items: flex-start;
    }

    .change-password-header-icon {
        width: 55px;
        height: 55px;

        font-size: 22px;
    }

    .change-password-header h1 {
        font-size: 20px;
    }

    .change-password-header p {
        font-size: 13px;
    }

    .change-password-card-header {
        padding: 18px 20px;
    }

    .change-password-body {
        padding: 20px 15px;
    }

    .password-input-wrapper .form-control {
        height: 52px;
    }
}

CSS);
?>


<div class="change-password-page">


    <!-- =====================================================
         ENCABEZADO
    ====================================================== -->

    <div class="change-password-header">

        <div class="change-password-header-content">

            <div class="change-password-header-icon">

                <i class="fa-solid fa-key"></i>

            </div>

            <div>

                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>

                <p>
                    Actualiza la contraseña de tu cuenta de forma segura.
                </p>

            </div>

        </div>


        <?= Html::a(
            '<i class="fa-solid fa-arrow-left"></i> Volver',
            ['site/index'],
            [
                'class' => 'btn-back-password'
            ]
        ) ?>

    </div>


    <!-- =====================================================
         TARJETA
    ====================================================== -->

    <div class="change-password-card">


        <!-- =================================================
             CABECERA
        ================================================== -->

        <div class="change-password-card-header">

            <i class="fa-solid fa-shield-halved"></i>

            <h2>
                Seguridad de la cuenta
            </h2>

        </div>


        <!-- =================================================
             CUERPO
        ================================================== -->

        <div class="change-password-body">


            <?php $form = ActiveForm::begin([
                'options' => [
                    'autocomplete' => 'off'
                ]
            ]); ?>


            <!-- =================================================
                 CONTRASEÑA ACTUAL
            ================================================== -->

            <div class="password-input-wrapper">

                <?= $form->field(
                    $model,
                    'currentPassword'
                )->passwordInput([
                    'placeholder' => 'Ingrese su contraseña actual',
                    'autocomplete' => 'current-password'
                ])->label(
                    '<i class="fa-solid fa-lock"></i> Contraseña actual',
                    [
                        'encode' => false
                    ]
                ) ?>

            </div>


            <!-- =================================================
                 NUEVA CONTRASEÑA
            ================================================== -->

            <div class="password-input-wrapper">

                <?= $form->field(
                    $model,
                    'newPassword'
                )->passwordInput([
                    'placeholder' => 'Ingrese una nueva contraseña',
                    'autocomplete' => 'new-password'
                ])->label(
                    '<i class="fa-solid fa-key"></i> Nueva contraseña',
                    [
                        'encode' => false
                    ]
                ) ?>

            </div>


            <!-- =================================================
                 CONFIRMAR CONTRASEÑA
            ================================================== -->

            <div class="password-input-wrapper">

                <?= $form->field(
                    $model,
                    'confirmPassword'
                )->passwordInput([
                    'placeholder' => 'Confirme su nueva contraseña',
                    'autocomplete' => 'new-password'
                ])->label(
                    '<i class="fa-solid fa-check-double"></i> Confirmar contraseña',
                    [
                        'encode' => false
                    ]
                ) ?>

            </div>


            <!-- =================================================
                 INFORMACIÓN DE SEGURIDAD
            ================================================== -->

            <div class="password-security-info">

                <i class="fa-solid fa-shield-halved"></i>

                <span>
                    Utiliza una contraseña segura y evita compartirla
                    con otras personas. Se recomienda combinar letras,
                    números y caracteres especiales.
                </span>

            </div>


            <!-- =================================================
                 BOTONES
            ================================================== -->

            <div class="change-password-actions">


                <?= Html::a(
                    '<i class="fa-solid fa-xmark"></i> Cancelar',
                    ['site/index'],
                    [
                        'class' => 'btn-cancel-password'
                    ]
                ) ?>


                <?= Html::submitButton(
                    '<i class="fa-solid fa-floppy-disk"></i> Actualizar contraseña',
                    [
                        'class' => 'btn-save-password'
                    ]
                ) ?>


            </div>


            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>
