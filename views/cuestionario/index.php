<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var array $preguntas */

use yii\helpers\Html;

$this->title = 'Cuestionario de autoevaluación';

?>

<div class="container py-5">
    <div class="card border-0 shadow-sm p-4 text-center mx-auto" style="max-width: 700px; border-radius: 18px;">

        <div class="mb-3">
            <i class="fas fa-clipboard-check fa-4x text-success"></i>
        </div>

        <h1 class="fw-bold">Cuestionario de autoevaluación</h1>

        <?php if (empty($preguntas)): ?>

            <p class="text-muted mt-3">
                Actualmente no hay preguntas disponibles.
                Vuelve a intentarlo más tarde.
            </p>

        <?php else: ?>

            <p class="text-muted mt-3">
                Pon a prueba tus conocimientos sobre la ética en la investigación científica.
                Responde las preguntas y recibe tu calificación al finalizar.
            </p>

            <?= Html::a(
                '<i class="fas fa-play-circle"></i> Comenzar cuestionario',
                ['realizar'],
                ['class' => 'btn btn-success btn-lg mt-3']
            ) ?>

        <?php endif; ?>

    </div>
</div>