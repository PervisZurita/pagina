function toggleCapitulo(button) {

    const contenido = button.nextElementSibling;

    const estaAbierto =
        contenido.classList.contains('activo');


    // Cerrar todos los capítulos
    document
        .querySelectorAll('.capitulo-contenido')
        .forEach(function(elemento) {

            elemento.classList.remove('activo');

        });


    document
        .querySelectorAll('.capitulo-btn')
        .forEach(function(elemento) {

            elemento.classList.remove('activo');

            elemento.querySelector('.flecha').textContent = '+';

        });


    // Abrir el seleccionado
    if (!estaAbierto) {

        contenido.classList.add('activo');

        button.classList.add('activo');

        button.querySelector('.flecha').textContent = '−';

    }

}```php
<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $content */

use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

/*
 * CSS principal
 */
$this->registerCssFile('@web/css/abaut.css');

/*
 * Font Awesome
 * Se registra UNA sola vez.
 */
$this->registerCssFile(
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'
);

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>

<html
    lang="<?= Yii::$app->language ?>"
    class="h-100"
    data-bs-theme="light"
>

<head>

    <meta charset="<?= Yii::$app->charset ?>">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <?php $this->head() ?>

    <title>
        <?= Html::encode($this->title ?: 'Código de Ética') ?>
    </title>

</head>

<body class="d-flex flex-column h-100">

<?php $this->beginBody() ?>


<!-- =====================================================
     NAVBAR
     SOLO APARECE CUANDO EL USUARIO ESTÁ LOGUEADO
===================================================== -->

<?php if (!Yii::$app->user->isGuest): ?>

    <?= $this->render('_header') ?>

<?php endif; ?>


<!-- =====================================================
     CONTENIDO PRINCIPAL
===================================================== -->

<main
    id="main"
    class="flex-grow-1"
    role="main"
>

    <div class="container-fluid">

        <?php if (!empty($this->params['breadcrumbs'])): ?>

            <?= Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'],
            ]) ?>

        <?php endif; ?>


        <!-- Mensajes del sistema -->

        <?= Alert::widget() ?>


        <!-- =================================================
             CONTENIDO DE LA VISTA
        ================================================== -->

        <?= $content ?>

    </div>

</main>


<!-- =====================================================
     CHATBOT IA
     SOLO PARA USUARIOS LOGUEADOS
===================================================== -->

<?php if (!Yii::$app->user->isGuest): ?>

    <?= $this->render('../chat/index') ?>

<?php endif; ?>


<!-- =====================================================
     FOOTER
     SOLO PARA USUARIOS LOGUEADOS
===================================================== -->

<?php if (!Yii::$app->user->isGuest): ?>

    <?= $this->render('_footer') ?>

<?php endif; ?>


<?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>
```
