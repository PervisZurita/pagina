<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\PreguntasFrecuentes $model */

use yii\helpers\Html;

$this->title = 'Detalle de pregunta frecuente';

$this->registerCssFile('@web/css/paginacion.css');

$categoria = $model->categoria
    ? $model->categoria->categoria
    : 'Sin categoría';

$esAdmin = !\Yii::$app->user->isGuest
    && \Yii::$app->user->identity->role === 'admin';

?>

<div class="faq-container">

    <div class="faq-header">
        <div class="faq-header-icon">
            <i class="fas fa-circle-question"></i>
        </div>

        <h1>Detalle de pregunta frecuente</h1>

        <p>
            Consulta la información completa de esta pregunta frecuente.
        </p>
    </div>

    <div class="faq-table-card faq-detail-card">

        <div class="faq-table-heading">
            <div>
                <h2>
                    <i class="fas fa-file-lines"></i>
                    Información registrada
                </h2>

                <p>
                    Detalles de la pregunta seleccionada.
                </p>
            </div>

            <span class="faq-detail-id">
                ID: <?= Html::encode($model->id) ?>
            </span>
        </div>

        <div class="faq-detail-content">

            <div class="faq-detail-item">
                <span class="faq-detail-label">
                    <i class="fas fa-layer-group"></i>
                    Categoría
                </span>

                <div class="faq-detail-category">
                    <?= Html::encode($categoria) ?>
                </div>
            </div>

            <div class="faq-detail-item">
                <span class="faq-detail-label">
                    <i class="fas fa-circle-question"></i>
                    Pregunta
                </span>

                <h3 class="faq-detail-question">
                    <?= Html::encode($model->pregunta) ?>
                </h3>
            </div>

            <div class="faq-detail-item">
                <span class="faq-detail-label">
                    <i class="fas fa-comment-dots"></i>
                    Respuesta
                </span>

                <div class="faq-detail-answer">
                    <?= nl2br(Html::encode($model->respuestas)) ?>
                </div>
            </div>

        </div>

        <div class="faq-form-actions">

            <?php if ($esAdmin): ?>
                <?= Html::a(
                    '<i class="fas fa-pen-to-square"></i> Actualizar',
                    ['update', 'id' => $model->id],
                    ['class' => 'btn-faq-primary']
                ) ?>
            <?php endif; ?>

            <?= Html::a(
                '<i class="fas fa-arrow-left"></i> Volver al listado',
                ['index'],
                ['class' => 'btn-faq-secondary']
            ) ?>

        </div>

    </div>

</div>
