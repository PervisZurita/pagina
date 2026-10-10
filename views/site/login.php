<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/* Bootstrap Icons */
$this->registerCssFile(
    'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'
);

/* Font Awesome */
$this->registerCssFile(
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'
);

/* CSS del login */
$this->registerCssFile('@web/css/login.css');

$this->title = 'Iniciar sesión';

?>

<div class="login-page">

    <!-- Fondos decorativos -->
    <div class="background-shape shape-one"></div>
    <div class="background-shape shape-two"></div>
    <div class="background-shape shape-three"></div>


    <!-- =====================================================
         LOGIN CENTRADO
    ====================================================== -->

    <div class="login-container">

        <div class="login-card">


            <!-- =================================================
                 ENCABEZADO
            ================================================== -->

            <div class="login-header">

                <div class="login-logo">

                   <?= Html::img('@web/images/iconoEtica.jpg', [
    'alt' => 'Icono de investigación científica',
    'class' => 'mi-icono',
]) ?>

                </div>

                <p>
                    Ciencia con ética
                </p>

                <h1>
                    ¡Bienvenido!
                </h1>

                <p>
                    Ingresa para conocer el codigo de etica de investigación científica.
                </p>

            </div>


            <!-- =================================================
                 FORMULARIO
            ================================================== -->

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',

                'options' => [
                    'class' => 'modern-login-form',
                    'autocomplete' => 'off',
                ]
            ]); ?>


            <!-- USUARIO -->
            <div class="input-group-modern">

                <label for="loginform-username">
                    Nombre de usuario
                </label>

                <div class="input-wrapper">

                    <i class="bi bi-person input-icon"></i>

                    <?= $form->field($model, 'username', [
                        'template' => '{input}{error}',

                        'options' => [
                            'class' => 'field-container'
                        ],

                    ])->textInput([

                        'class' => 'modern-input',

                        'id' => 'loginform-username',

                        'placeholder' =>
                            'Ingresa tu nombre de usuario',

                        'autocomplete' => 'username',

                        'autofocus' => true,

                    ]) ?>

                </div>

            </div>


            <!-- CONTRASEÑA -->
            <div class="input-group-modern">

                <label for="loginform-password">
                    Contraseña
                </label>

                <div class="input-wrapper">

                    <i class="bi bi-lock input-icon"></i>

                    <?= $form->field($model, 'password', [

                        'template' => '{input}{error}',

                        'options' => [
                            'class' => 'field-container'
                        ],

                    ])->passwordInput([

                        'class' =>
                            'modern-input password-field',

                        'id' =>
                            'loginform-password',

                        'placeholder' =>
                            'Ingresa tu contraseña',

                        'autocomplete' =>
                            'current-password',

                    ]) ?>


                    <!-- Mostrar contraseña -->
                    <button
                        type="button"
                        class="show-password"
                        onclick="togglePassword()"
                        aria-label="Mostrar contraseña"
                    >

                        <i
                            class="bi bi-eye"
                            id="passwordIcon"
                        ></i>

                    </button>

                </div>

            </div>


            <!-- =================================================
                 OPCIONES
            ================================================== -->

            <div class="login-options">

                <label class="remember-container">

                    <?= $form->field(
                        $model,
                        'rememberMe',
                        [
                            'template' => '{input}',

                            'options' => [
                                'class' => 'remember-field'
                            ]
                        ]
                    )->checkbox([
                        'label' => false,
                    ]) ?>

                    <span>
                        Recordarme
                    </span>

                </label>


                <a
                    href="#"
                    class="forgot-password"
                >
                    ¿Olvidaste tu contraseña?
                </a>

            </div>


            <!-- =================================================
                 BOTÓN LOGIN
            ================================================== -->

            <div class="login-submit">

                <?= Html::submitButton(

                    '<span>Iniciar sesión</span>
                     <i class="bi bi-arrow-right"></i>',

                    [
                        'class' =>
                            'login-button',

                        'name' =>
                            'login-button',
                    ]

                ) ?>

            </div>


            <?php ActiveForm::end(); ?>


            <!-- =================================================
                 REGISTRO
            ================================================== -->

            <div class="register-section">

                <p>
                    ¿No tienes una cuenta?
                </p>

                <?= Html::a(

                    '<i class="fa-solid fa-user-plus"></i>
                     Crear una cuenta',

                    ['/user/create'],

                    [
                        'class' =>
                            'register-button'
                    ]

                ) ?>

            </div>


            <!-- =================================================
                 SEPARADOR
            ================================================== -->

            <div class="login-divider">

                <span>
                    Acceso seguro
                </span>

            </div>


            <!-- =================================================
                 SEGURIDAD
            ================================================== -->

            <div class="security-message">

                <i class="bi bi-shield-check"></i>

                <span>
                    "Investigar con ciencia, actuar con ética"
                </span>

            </div>


            <!-- =================================================
                 COPYRIGHT
            ================================================== -->

            <div class="login-copyright">

                © <?= date('Y') ?> Mi Plataforma

            </div>

        </div>

    </div>

</div>


<script>

function togglePassword() {

    const password =
        document.querySelector('.password-field');

    const icon =
        document.getElementById('passwordIcon');

    if (!password || !icon) {
        return;
    }

    if (password.type === 'password') {

        password.type = 'text';

        icon.classList.remove('bi-eye');

        icon.classList.add('bi-eye-slash');

    } else {

        password.type = 'password';

        icon.classList.remove('bi-eye-slash');

        icon.classList.add('bi-eye');

    }

}

</script>