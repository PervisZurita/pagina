<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var array $revision */
/** @var int $correctas */
/** @var int $totalPreguntas */
/** @var float|null $puntuacion */

use yii\helpers\Html;

$this->title = 'Resultado de la autoevaluación';

// Evitar el error si el controlador no envía $puntuacion.
$correctas = (int) ($correctas ?? 0);
$totalPreguntas = (int) ($totalPreguntas ?? 0);

$puntuacion = isset($puntuacion)
    ? (float) $puntuacion
    : ($totalPreguntas > 0
        ? ($correctas / $totalPreguntas) * 100
        : 0);

$revision = $revision ?? [];

$this->registerCss(<<<CSS
.resultado-wrapper {
    max-width: 1000px;
    margin: 35px auto;
    padding: 20px;
}

.resultado-hero {
    padding: 35px;
    border-radius: 20px;
    background: linear-gradient(135deg, #123c69, #16856b);
    color: white;
    text-align: center;
    margin-bottom: 25px;
}

.resultado-hero h1 {
    font-weight: 800;
}

.resultado-puntuacion {
    font-size: 52px;
    font-weight: 800;
    margin: 15px 0;
}

.resultado-card {
    padding: 24px;
    margin-bottom: 18px;
    border: 1px solid #e5e7eb;
    border-radius: 15px;
    background: white;
}

.resultado-correcto {
    border-left: 5px solid #16856b;
}

.resultado-incorrecto {
    border-left: 5px solid #dc3545;
}

.resultado-respuesta {
    margin-top: 12px;
    padding: 12px;
    border-radius: 9px;
    background: #f5f7fa;
}

.resultado-ayuda {
    color: #536273;
    margin-top: 12px;
}

.btn-resultado {
    display: inline-block;
    background: #16856b;
    color: white;
    padding: 13px 22px;
    border-radius: 9px;
    text-decoration: none;
    font-weight: 700;
}

.btn-resultado:hover {
    background: #116149;
    color: white;
}

@media (max-width: 600px) {
    .resultado-wrapper {
        padding: 12px;
        margin: 15px auto;
    }

    .resultado-hero {
        padding: 25px 15px;
    }

    .resultado-puntuacion {
        font-size: 40px;
    }

    .resultado-card {
        padding: 17px;
    }
}
CSS);

?>

<div class="resultado-wrapper">

    <div class="resultado-hero">

        <i class="fas fa-award fa-3x"></i>

        <h1>Resultado de tu autoevaluación</h1>

        <div class="resultado-puntuacion">
            <?= Html::encode(number_format($puntuacion, 2)) ?>%
        </div>

        <p>
            Respondiste correctamente
            <strong><?= $correctas ?></strong>
            de <?= $totalPreguntas ?> preguntas.
        </p>

        <?php if ($puntuacion >= 90): ?>

            <h3>¡Excelente trabajo!</h3>
            <p>Demuestras un gran conocimiento de los principios éticos.</p>

        <?php elseif ($puntuacion >= 70): ?>

            <h3>¡Buen trabajo!</h3>
            <p>Has comprendido varios principios importantes. Sigue repasando.</p>

        <?php else: ?>

            <h3>Sigue aprendiendo</h3>
            <p>Revisa las explicaciones y vuelve a intentarlo.</p>

        <?php endif; ?>

    </div>

    <h2 class="mb-4">Revisión de tus respuestas</h2>

    <?php if (empty($revision)): ?>

        <div class="alert alert-info">
            No hay respuestas disponibles para revisar.
        </div>

    <?php else: ?>

        <?php foreach ($revision as $indice => $item): ?>

            <?php $esCorrecta = !empty($item['es_correcta']); ?>

            <div class="resultado-card <?= $esCorrecta ? 'resultado-correcto' : 'resultado-incorrecto' ?>">

                <h3>
                    <?= (int) $indice + 1 ?>.
                    <?= Html::encode($item['pregunta'] ?? 'Pregunta no disponible') ?>
                </h3>

                <p>
                    <strong>Tu respuesta:</strong>
                    <?= Html::encode($item['seleccionada'] ?? 'Sin respuesta') ?>
                </p>

                <?php if (!$esCorrecta): ?>

                    <div class="resultado-respuesta">
                        <strong>Respuesta correcta:</strong>
                        <?= Html::encode($item['correcta'] ?? 'No disponible') ?>
                    </div>

                <?php else: ?>

                    <p class="text-success">
                        <i class="fas fa-check-circle"></i>
                        ¡Respuesta correcta!
                    </p>

                <?php endif; ?>

                <?php if (!empty($item['explicacion'])): ?>

                    <div class="resultado-ayuda">
                        <strong>Aprende:</strong>
                        <?= Html::encode($item['explicacion']) ?>
                    </div>

                <?php endif; ?>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

    <div class="text-center mt-4 mb-5">

        <?= Html::a(
            '<i class="fas fa-redo"></i> Intentar nuevamente',
            ['realizar'],
            [
                'class' => 'btn-resultado',
                'encode' => false,
            ]
        ) ?>

    </div>

</div>
