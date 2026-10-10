<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $content */

use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

$this->registerCssFile('@web/css/abaut.css');
$this->registerCssFile('@web/css/xxx.css');

$this->registerCssFile(
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'
);

$this->registerCss(<<<CSS
/* =========================
   PIE DE PÁGINA COMPACTO
========================= */

.site-footer {
    width: 100%;
    margin-top: auto;
    padding: 9px 20px;
    color: #333333;
    background: #ffffff;
    border-top: 2px solid #2563eb;
    text-align: center;
    font-size: 12px;
    line-height: 1.4;
    box-sizing: border-box;
}

.site-footer-content {
    max-width: 1200px;
    margin: 0 auto;
}

.site-footer-title {
    margin: 0 0 3px;
    color: #111827;
    font-size: 13px;
    font-weight: 700;
    line-height: 1.4;
}

.site-footer-description {
    margin: 0 0 5px;
    color: #4b5563;
    font-size: 11px;
    line-height: 1.4;
}

.site-footer-divider {
    width: 40px;
    height: 2px;
    margin: 5px auto;
    background: #2563eb;
    border-radius: 5px;
}

.site-footer-credits {
    margin: 2px 0 0;
    color: #4b5563;
    font-size: 10px;
    line-height: 1.4;
}

.site-footer-credits strong {
    color: #111827;
    font-weight: 700;
}

.site-footer-icon {
    margin-right: 4px;
    color: #2563eb;
}

.site-footer a {
    color: #1d4ed8;
    text-decoration: none;
}

.site-footer a:hover {
    color: #1e40af;
    text-decoration: underline;
}

@media (max-width: 576px) {
    .site-footer {
        padding: 8px 12px;
    }

    .site-footer-title {
        font-size: 12px;
    }

    .site-footer-description {
        font-size: 10px;
    }

    .site-footer-credits {
        font-size: 9px;
    }
}
CSS);

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
        <?= Html::encode(
            $this->title ?: 'Código de Ética en la Investigación Científica'
        ) ?>
    </title>
</head>

<body class="d-flex flex-column min-vh-100">

<?php $this->beginBody() ?>

<?php if (!Yii::$app->user->isGuest): ?>
    <?= $this->render('_header') ?>
<?php endif; ?>

<?php if (!Yii::$app->user->isGuest): ?>
    <?= $this->render('_sidebar') ?>
<?php endif; ?>

<main
    id="main"
    class="flex-grow-1"
    role="main"
>
    <div class="content-full">

        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'],
            ]) ?>
        <?php endif; ?>

        <?= Alert::widget() ?>

        <?= $content ?>

    </div>
</main>

<?php if (!Yii::$app->user->isGuest): ?>
    <?= $this->render('../chatbot/index') ?>
<?php endif; ?>

<footer class="site-footer">
    <div class="site-footer-content">

        <div class="site-footer-title">
            <i class="fa-solid fa-scale-balanced site-footer-icon"></i>
            Código de Ética en la Investigación Científica
        </div>

        <p class="site-footer-description">
            Universidad Técnica Luis Vargas Torres de Esmeraldas
        </p>

        <div class="site-footer-divider"></div>

        <p class="site-footer-credits">
            &copy; <?= date('Y') ?>
            <strong>UTLVTE</strong>.
            Todos los derechos reservados.
        </p>

        <p class="site-footer-credits">
            <i class="fa-solid fa-code site-footer-icon"></i>
            Sistema desarrollado con fines académicos.
        </p>

    </div>
</footer>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
