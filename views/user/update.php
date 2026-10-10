<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\User $model */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Editar usuario';

$esAdmin = !Yii::$app->user->isGuest
    && Yii::$app->user->identity->role === 'admin';

$esPropietario = !Yii::$app->user->isGuest
    && (int) Yii::$app->user->id === (int) $model->id;

$urlVolver = $esAdmin
    ? ['/user/index']
    : ['/site/index'];

$this->registerCss(<<<'CSS'
.user-update-page {
    width: 100%;
    padding: 30px 10px 50px;
}

.user-update-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
    padding: 30px;
    background: linear-gradient(135deg, #0f172a, #1e3a8a);
    border-radius: 18px;
    color: white;
    box-shadow: 0 12px 35px rgba(15, 23, 42, .18);
}

.user-update-header-content {
    display: flex;
    align-items: center;
    gap: 18px;
}

.user-update-header-icon {
    width: 65px;
    height: 65px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    background: rgba(255, 255, 255, .15);
    font-size: 28px;
}

.user-update-header h1 {
    margin: 0 0 5px;
    font-size: 28px;
    font-weight: 700;
}

.user-update-header p {
    margin: 0;
    color: rgba(255, 255, 255, .75);
    font-size: 14px;
}

.btn-back-user {
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

.btn-back-user:hover {
    background: white;
    color: #1e3a8a;
    transform: translateY(-2px);
    text-decoration: none;
}

.user-update-card {
    width: 100%;
    max-width: 1050px;
    margin: 0 auto;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    box-shadow: 0 8px 30px rgba(15, 23, 42, .07);
    overflow: hidden;
}

.user-update-card-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 20px 30px;
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
}

.user-update-card-header i {
    color: #2563eb;
    font-size: 18px;
}

.user-update-card-header h2 {
    margin: 0;
    color: #0f172a;
    font-size: 17px;
    font-weight: 700;
}

.user-update-body {
    padding: 40px 50px;
}

.user-update-body .form-group {
    width: 100%;
    margin-bottom: 25px;
}

.user-update-body label {
    display: block;
    margin-bottom: 9px;
    color: #334155;
    font-size: 13px;
    font-weight: 700;
}

.user-update-body label i {
    margin-right: 6px;
    color: #2563eb;
}

.user-update-body .form-control {
    display: block;
    width: 100%;
    min-height: 56px;
    padding: 12px 18px;
    border: 1px solid #dbe2ea;
    border-radius: 11px;
    background: #fff;
    color: #334155;
    font-size: 15px;
    box-sizing: border-box;
    transition: border-color .2s ease, box-shadow .2s ease;
}

.user-update-body .form-control::placeholder {
    color: #94a3b8;
    font-size: 14px;
}

.user-update-body .form-control:focus {
    border-color: #2563eb;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, .10);
    outline: none;
}

.user-update-body .help-block {
    margin-top: 7px;
    color: #ef4444;
    font-size: 12px;
}

.user-update-security-info {
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

.user-update-security-info i {
    margin-top: 3px;
    color: #7c3aed;
    font-size: 15px;
}

.user-update-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 12px;
    margin-top: 30px;
    padding-top: 25px;
    border-top: 1px solid #e5e7eb;
}

.btn-cancel-user {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-width: 125px;
    min-height: 46px;
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

.btn-save-user {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-width: 190px;
    min-height: 46px;
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
    box-shadow: 0 7px 18px rgba(37, 99, 235, .25);
}

@media (max-width: 900px) {
    .user-update-card {
        max-width: 100%;
    }

    .user-update-body {
        padding: 30px;
    }
}

@media (max-width: 768px) {
    .user-update-page {
        padding: 20px 5px 40px;
    }

    .user-update-header {
        flex-direction: column;
        align-items: flex-start;
        padding: 22px;
    }

    .user-update-header-content {
        width: 100%;
    }

    .user-update-header h1 {
        font-size: 23px;
    }

    .btn-back-user {
        width: 100%;
        box-sizing: border-box;
    }

    .user-update-body {
        padding: 25px 20px;
    }

    .user-update-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .btn-save-user,
    .btn-cancel-user {
        width: 100%;
        box-sizing: border-box;
    }
}

@media (max-width: 480px) {
    .user-update-header-icon {
        width: 55px;
        height: 55px;
        font-size: 22px;
    }

    .user-update-header h1 {
        font-size: 20px;
    }

    .user-update-header p {
        font-size: 13px;
    }

    .user-update-card-header {
        padding: 18px 20px;
    }

    .user-update-body {
        padding: 20px 15px;
    }
}
CSS);
?>

<div class="user-update-page">

    <div class="user-update-header">

        <div class="user-update-header-content">
            <div class="user-update-header-icon">
                <i class="fa-solid fa-user-pen"></i>
            </div>

            <div>
                <h1><?= Html::encode($this->title) ?></h1>
                <p>Actualiza la información de tu cuenta de forma segura.</p>
            </div>
        </div>

        <?= Html::a(
            '<i class="fa-solid fa-arrow-left"></i> Volver',
            $urlVolver,
            [
                'class' => 'btn-back-user',
                'encode' => false,
            ]
        ) ?>

    </div>

    <div class="user-update-card">

        <div class="user-update-card-header">
            <i class="fa-solid fa-user-shield"></i>
            <h2>Información de la cuenta</h2>
        </div>

        <div class="user-update-body">

            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'options' => [
                    'autocomplete' => 'off',
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput([
                'maxlength' => true,
                'placeholder' => 'Ingrese el nombre de usuario',
                'autocomplete' => 'username',
            ])->label(
                '<i class="fa-solid fa-user"></i> Nombre de usuario',
                ['encode' => false]
            ) ?>

            <?= $form->field($model, 'nombre')->textInput([
                'maxlength' => true,
                'placeholder' => 'Ingrese los nombres',
            ])->label(
                '<i class="fa-solid fa-id-card"></i> Nombres',
                ['encode' => false]
            ) ?>

            <?= $form->field($model, 'apellido')->textInput([
                'maxlength' => true,
                'placeholder' => 'Ingrese los apellidos',
            ])->label(
                '<i class="fa-solid fa-address-card"></i> Apellidos',
                ['encode' => false]
            ) ?>

            <?php if ($esAdmin): ?>

                <?= $form->field($model, 'role')->dropDownList([
                    'user' => 'Usuario',
                    'admin' => 'Administrador',
                ], [
                    'prompt' => 'Seleccione un rol',
                ])->label(
                    '<i class="fa-solid fa-user-shield"></i> Rol del usuario',
                    ['encode' => false]
                ) ?>

            <?php else: ?>

                <div class="user-update-security-info">
                    <i class="fa-solid fa-lock"></i>
                    <span>
                        Tu rol está protegido. Solo un administrador
                        puede modificar los roles de las cuentas.
                    </span>
                </div>

            <?php endif; ?>

            <?= $form->field($model, 'password')->passwordInput([
                'maxlength' => true,
                'placeholder' => 'Deje vacío si no desea cambiarla',
                'autocomplete' => 'new-password',
                'value' => '',
            ])->label(
                '<i class="fa-solid fa-key"></i> Nueva contraseña (opcional)',
                ['encode' => false]
            ) ?>

            <div class="user-update-security-info">
                <i class="fa-solid fa-shield-halved"></i>
                <span>
                    Si no deseas cambiar la contraseña, deja el campo vacío.
                    Los usuarios normales solo pueden modificar sus propios
                    datos. Los cambios de rol están reservados al administrador.
                </span>
            </div>

            <div class="user-update-actions">

                <?= Html::a(
                    '<i class="fa-solid fa-xmark"></i> Cancelar',
                    $urlVolver,
                    [
                        'class' => 'btn-cancel-user',
                        'encode' => false,
                    ]
                ) ?>

                <?= Html::submitButton(
                    '<i class="fa-solid fa-floppy-disk"></i> Guardar cambios',
                    [
                        'class' => 'btn-save-user',
                        'encode' => false,
                    ]
                ) ?>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
