<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Crear usuario';

$this->registerCss(<<<'CSS'

/* =========================================================
   CONTENEDOR
========================================================= */

.user-create {
    width: 100%;
    padding: 30px 10px 50px;
}


/* =========================================================
   ENCABEZADO
========================================================= */

.user-form-header {
    width: 100%;

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

    box-shadow: 0 12px 35px rgba(15, 23, 42, .18);

    box-sizing: border-box;
}

.user-form-header-content {
    display: flex;
    align-items: center;
    gap: 18px;
}

.user-form-header-icon {
    width: 65px;
    height: 65px;

    flex: 0 0 65px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 16px;

    background: rgba(255,255,255,.15);

    font-size: 28px;
}

.user-form-header h1 {
    margin: 0 0 5px;

    font-size: 28px;
    font-weight: 700;
}

.user-form-header p {
    margin: 0;

    color: rgba(255,255,255,.75);

    font-size: 14px;
}


/* =========================================================
   BOTÓN VOLVER
========================================================= */

.btn-back-users {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 9px;

    padding: 11px 17px;

    border-radius: 10px;

    background: rgba(255,255,255,.12);

    border: 1px solid rgba(255,255,255,.2);

    color: white;

    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    transition: all .25s ease;
}

.btn-back-users:hover {
    background: white;
    color: #1e3a8a;

    transform: translateY(-2px);

    text-decoration: none;
}


/* =========================================================
   TARJETA
========================================================= */

.user-form-card {

    width: 100% !important;

    max-width: 1100px !important;

    margin-left: auto !important;
    margin-right: auto !important;

    background: #ffffff;

    border: 1px solid #e5e7eb;

    border-radius: 18px;

    box-shadow:
        0 8px 30px rgba(15,23,42,.07);

    overflow: hidden;

    box-sizing: border-box;
}


/* =========================================================
   CABECERA
========================================================= */

.user-form-card-header {

    display: flex;

    align-items: center;

    gap: 10px;

    padding: 20px 30px;

    background: #f8fafc;

    border-bottom: 1px solid #e5e7eb;
}

.user-form-card-header i {
    color: #2563eb;

    font-size: 18px;
}

.user-form-card-header h2 {
    margin: 0;

    color: #0f172a;

    font-size: 17px;

    font-weight: 700;
}


/* =========================================================
   CUERPO
========================================================= */

.user-form-body {

    width: 100% !important;

    padding: 45px 55px !important;

    box-sizing: border-box;
}


/* =========================================================
   FORMULARIO
========================================================= */

.user-form-body form {
    width: 100% !important;
}


/* =========================================================
   GRUPOS
========================================================= */

.user-form-body .form-group {

    width: 100% !important;

    display: block !important;

    margin-bottom: 26px !important;

    box-sizing: border-box;
}


/* =========================================================
   LABEL
========================================================= */

.user-form-body label {

    display: block !important;

    width: 100%;

    margin-bottom: 9px !important;

    color: #334155;

    font-size: 13px;

    font-weight: 700;
}

.user-form-body label i {

    margin-right: 6px;

    color: #2563eb;
}


/* =========================================================
   INPUTS
========================================================= */

.user-form-body input.form-control {

    display: block !important;

    width: 100% !important;

    max-width: none !important;

    min-width: 0 !important;

    height: 58px !important;

    padding: 0 18px !important;

    border: 1px solid #dbe2ea !important;

    border-radius: 11px !important;

    background: #ffffff !important;

    color: #334155 !important;

    font-size: 15px !important;

    box-sizing: border-box !important;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}


/* =========================================================
   PLACEHOLDER
========================================================= */

.user-form-body input.form-control::placeholder {

    color: #94a3b8;

    font-size: 14px;
}


/* =========================================================
   FOCUS
========================================================= */

.user-form-body input.form-control:focus {

    border-color: #2563eb !important;

    box-shadow:
        0 0 0 4px rgba(37,99,235,.10) !important;

    outline: none !important;
}


/* =========================================================
   SELECT
========================================================= */

.user-form-body select.form-select,
.user-form-body select.form-control {

    display: block !important;

    width: 100% !important;

    max-width: none !important;

    height: 58px !important;

    padding: 0 18px !important;

    border: 1px solid #dbe2ea !important;

    border-radius: 11px !important;

    background-color: #ffffff !important;

    color: #334155 !important;

    font-size: 15px !important;

    box-sizing: border-box !important;

    cursor: pointer;
}

.user-form-body select.form-select:focus,
.user-form-body select.form-control:focus {

    border-color: #2563eb !important;

    box-shadow:
        0 0 0 4px rgba(37,99,235,.10) !important;

    outline: none !important;
}


/* =========================================================
   ERRORES
========================================================= */

.user-form-body .help-block {

    margin-top: 7px;

    color: #ef4444;

    font-size: 12px;
}


/* =========================================================
   INFORMACIÓN CONTRASEÑA
========================================================= */

.password-info {

    width: 100%;

    display: flex;

    align-items: center;

    gap: 12px;

    margin-top: -5px;

    margin-bottom: 28px;

    padding: 16px 18px;

    border-radius: 11px;

    background: #f8fafc;

    border: 1px solid #e5e7eb;

    color: #64748b;

    font-size: 13px;

    line-height: 1.5;

    box-sizing: border-box;
}

.password-info i {

    color: #7c3aed;

    font-size: 15px;
}


/* =========================================================
   BOTONES
========================================================= */

.user-form-actions {

    width: 100%;

    display: flex;

    justify-content: flex-end;

    align-items: center;

    gap: 12px;

    margin-top: 30px;

    padding-top: 25px;

    border-top: 1px solid #e5e7eb;
}


/* =========================================================
   CANCELAR
========================================================= */

.btn-cancel-user {

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

.btn-cancel-user:hover {

    background: #e2e8f0;

    color: #334155;

    text-decoration: none;
}


/* =========================================================
   GUARDAR
========================================================= */

.btn-save-user {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    min-width: 180px;

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

.btn-save-user:hover {

    background: #1d4ed8;

    color: white;

    transform: translateY(-2px);

    box-shadow:
        0 7px 18px rgba(37,99,235,.25);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .user-create {
        padding: 20px 5px 40px;
    }

    .user-form-header {

        flex-direction: column;

        align-items: flex-start;

        padding: 22px;
    }

    .user-form-header-content {
        width: 100%;
    }

    .user-form-header h1 {
        font-size: 23px;
    }

    .btn-back-users {
        width: 100%;
    }

    .user-form-body {
        padding: 30px 20px !important;
    }

    .user-form-actions {

        flex-direction: column-reverse;

        align-items: stretch;
    }

    .btn-save-user,
    .btn-cancel-user {

        width: 100%;
    }
}


@media (max-width: 480px) {

    .user-form-header-content {
        gap: 12px;
    }

    .user-form-header-icon {

        width: 55px;
        height: 55px;

        flex-basis: 55px;

        font-size: 22px;
    }

    .user-form-header h1 {
        font-size: 20px;
    }

    .user-form-body {
        padding: 25px 15px !important;
    }

    .user-form-body input.form-control,
    .user-form-body select.form-select,
    .user-form-body select.form-control {

        height: 54px !important;
    }
}

CSS);
?>


<div class="user-create">


    <!-- =====================================================
         ENCABEZADO
    ====================================================== -->

    <div class="user-form-header">

        <div class="user-form-header-content">

            <div class="user-form-header-icon">

                <i class="fa-solid fa-user-plus"></i>

            </div>

            <div>

                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>

                <p>
                    Registra un nuevo usuario en el sistema.
                </p>

            </div>

        </div>


        <?= Html::a(
            '<i class="fa-solid fa-arrow-left"></i> Volver a usuarios',
            ['index'],
            [
                'class' => 'btn-back-users'
            ]
        ) ?>

    </div>


    <!-- =====================================================
         TARJETA
    ====================================================== -->

    <div class="user-form-card">


        <div class="user-form-card-header">

            <i class="fa-solid fa-address-card"></i>

            <h2>
                Información del usuario
            </h2>

        </div>


        <div class="user-form-body">


            <?php $form = ActiveForm::begin([
                'options' => [
                    'autocomplete' => 'off'
                ]
            ]); ?>


            <!-- USUARIO -->

            <div class="input-icon-wrapper">

                <?= $form->field(
                    $model,
                    'username'
                )->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Ingrese el nombre de usuario',
                    'autocomplete' => 'off'
                ])->label(
                    '<i class="fa-solid fa-user"></i> Nombre de usuario',
                    [
                        'encode' => false
                    ]
                ) ?>

            </div>


            <!-- NOMBRE -->

            <div class="input-icon-wrapper">

                <?= $form->field(
                    $model,
                    'nombre'
                )->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Ingrese el nombre'
                ])->label(
                    '<i class="fa-solid fa-id-card"></i> Nombre',
                    [
                        'encode' => false
                    ]
                ) ?>

            </div>


            <!-- APELLIDO -->

            <div class="input-icon-wrapper">

                <?= $form->field(
                    $model,
                    'apellido'
                )->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Ingrese el apellido'
                ])->label(
                    '<i class="fa-solid fa-id-card"></i> Apellido',
                    [
                        'encode' => false
                    ]
                ) ?>

            </div>


            <!-- CONTRASEÑA -->

            <div class="input-icon-wrapper">

                <?= $form->field(
                    $model,
                    'password'
                )->passwordInput([
                    'maxlength' => true,
                    'placeholder' => 'Ingrese una contraseña',
                    'autocomplete' => 'new-password'
                ])->label(
                    '<i class="fa-solid fa-lock"></i> Contraseña',
                    [
                        'encode' => false
                    ]
                ) ?>

            </div>


            <!-- INFORMACIÓN -->

            <div class="password-info">

                <i class="fa-solid fa-shield-halved"></i>

                <span>
                    Utiliza una contraseña segura para proteger la cuenta.
                </span>

            </div>


            <!-- ROL -->

            <?php if (
                !Yii::$app->user->isGuest &&
                Yii::$app->user->identity->role === 'admin'
            ): ?>

                <div class="input-icon-wrapper">

                    <?= $form->field(
                        $model,
                        'role'
                    )->dropDownList(
                        [
                            'user' => 'Usuario',
                            'admin' => 'Administrador',
                        ],
                        [
                            'prompt' => 'Seleccione un rol',
                            'class' => 'form-select',
                        ]
                    )->label(
                        '<i class="fa-solid fa-user-shield"></i> Rol',
                        [
                            'encode' => false
                        ]
                    ) ?>

                </div>

            <?php else: ?>

                <?= Html::hiddenInput(
                    'User[role]',
                    'user'
                ) ?>

            <?php endif; ?>


            <!-- BOTONES -->

            <div class="user-form-actions">

                <?= Html::a(
                    '<i class="fa-solid fa-xmark"></i> Cancelar',
                    ['index'],
                    [
                        'class' => 'btn-cancel-user'
                    ]
                ) ?>


                <?= Html::submitButton(
                    '<i class="fa-solid fa-floppy-disk"></i> Guardar usuario',
                    [
                        'class' => 'btn-save-user'
                    ]
                ) ?>

            </div>


            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>
