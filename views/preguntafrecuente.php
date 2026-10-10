<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PreguntasFrecuentes $model */

$this->title = 'Detalle de pregunta frecuente';

$this->registerCss(<<<CSS
.faq-detail {
    max-width: 950px;
    margin: 35px auto;
}
.faq-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 8px 30px rgba(0,0,0,.08);
    overflow: hidden;
    border: 1px solid #e8edf3;
}
.faq-card-header {
    background: linear-gradient(135deg, #123b64, #1976a8);
    color: #fff;
    padding: 28px;
}
.faq-card-body {
    padding: 30px;
}
.faq-label {
    color: #68778a;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .7px;
    margin-bottom: 10px;
}
.faq-value {
    color: #263445;
    font-size: 17px;
    line-height: 1.8;
    overflow-wrap: anywhere;
}
.faq-category {
    display: inline-block;
    background: #e7f2ff;
    color: #155b91;
    padding: 8px 14px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
}
.faq-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 28px;
}
CSS);
?>

<div class="faq-detail">

    <div class="faq-card">

        <div class="faq-card-header">
            <h2 class="mb-2">
                <i class="fa-solid fa-circle-question"></i>
                Detalle de la pregunta
            </h2>
            <p class="mb-0">
                Consulta la información registrada en las preguntas frecuentes.
            </p>
        </div>

        <div class="faq-card-body">

            <div class="mb-4">
                <div class="faq-label">Categoría</div>
                <div>
                    <span class="faq-category">
                        <?= Html::encode(
                            $model->categoria->categoria ?? 'Sin categoría'
                        ) ?>
                    </span>
                </div>
            </div>

            <div class="mb-4">
                <div class="faq-label">Pregunta</div>
                <div class="faq-value">
                    <?= Html::encode($model->pregunta) ?>
                </div>
            </div>

            <div>
                <div class="faq-label">Respuesta</div>
                <div class="faq-value">
                    <?= nl2br(Html::encode($model->respuestas)) ?>
                </div>
            </div>

            <div class="faq-actions">

                <?= Html::a(
                    '<i class="fa-solid fa-pen"></i> Actualizar',
                    ['update', 'id' => $model->id],
                    ['class' => 'btn btn-primary']
                ) ?>

                <?= Html::a(
                    '<i class="fa-solid fa-arrow-left"></i> Volver',
                    ['index'],
                    ['class' => 'btn btn-outline-secondary']
                ) ?>

            </div>

        </div>
    </div>
</div>
