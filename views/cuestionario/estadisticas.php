<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var array $resumen */
/** @var array $estadisticasPreguntas */
/** @var array $historial */

use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;

$this->title = 'Estadísticas por pregunta';

$this->registerJsFile(
    'https://cdn.jsdelivr.net/npm/chart.js',
    ['position' => View::POS_END]
);

$this->registerCss("
.estadisticas-container {
    padding: 25px;
    background: #f5f7fb;
    border-radius: 18px;
}
.estadisticas-container h1 {
    color: #172554;
    font-weight: 800;
    margin-bottom: 8px;
}
.estadisticas-descripcion {
    color: #64748b;
    margin-bottom: 25px;
}
.resumen-tarjetas {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
    gap: 18px;
    margin-bottom: 30px;
}
.resumen-tarjeta {
    background: #fff;
    padding: 22px;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 14px rgba(15, 23, 42, .05);
}
.resumen-tarjeta span {
    display: block;
    color: #64748b;
    font-size: 14px;
    margin-bottom: 9px;
}
.resumen-tarjeta strong {
    color: #172554;
    font-size: 29px;
}
.preguntas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
    gap: 22px;
}
.pregunta-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 23px;
    box-shadow: 0 5px 18px rgba(15, 23, 42, .06);
}
.pregunta-card h2 {
    font-size: 18px;
    font-weight: 750;
    color: #1e293b;
    margin-bottom: 8px;
}
.pregunta-subtitulo {
    color: #64748b;
    font-size: 13px;
    margin-bottom: 15px;
}
.grafico-pastel {
    position: relative;
    height: 235px;
    max-width: 290px;
    margin: 0 auto 18px;
}
.pregunta-porcentaje {
    text-align: center;
    font-size: 30px;
    font-weight: 800;
    color: #172554;
    margin-bottom: 15px;
}
.pregunta-porcentaje small {
    display: block;
    font-size: 12px;
    font-weight: 500;
    color: #64748b;
}
.pregunta-detalles {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.detalle-item {
    padding: 13px;
    border-radius: 10px;
    background: #f8fafc;
}
.detalle-item span {
    display: block;
    color: #64748b;
    font-size: 12px;
    margin-bottom: 5px;
}
.detalle-item strong {
    font-size: 20px;
    color: #1e293b;
}
.sin-datos {
    background: #fff;
    padding: 25px;
    border-radius: 14px;
    color: #64748b;
}
@media (max-width: 600px) {
    .estadisticas-container { padding: 14px; }
    .preguntas-grid { grid-template-columns: 1fr; }
}
");
?>

<div class="estadisticas-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="estadisticas-descripcion">
        Análisis individual de las respuestas de cada pregunta del cuestionario.
    </p>

    <div class="resumen-tarjetas">

        <div class="resumen-tarjeta">
            <span>Total de intentos</span>
            <strong><?= (int) ($resumen['total_intentos'] ?? 0) ?></strong>
        </div>

        <div class="resumen-tarjeta">
            <span>Usuarios participantes</span>
            <strong><?= (int) ($resumen['total_usuarios'] ?? 0) ?></strong>
        </div>

        <div class="resumen-tarjeta">
            <span>Promedio de puntuación</span>
            <strong>
                <?= number_format((float) ($resumen['promedio_puntuacion'] ?? 0), 2) ?>%
            </strong>
        </div>

        <div class="resumen-tarjeta">
            <span>Promedio de aciertos</span>
            <strong>
                <?= number_format((float) ($resumen['promedio_correctas'] ?? 0), 2) ?>
            </strong>
        </div>

    </div>

    <div class="preguntas-grid">

        <?php foreach ($estadisticasPreguntas as $indice => $pregunta): ?>

            <?php
            $total = (int) $pregunta['total_respuestas'];
            $correctas = (int) $pregunta['correctas'];
            $incorrectas = (int) $pregunta['incorrectas'];

            $porcentaje = $total > 0
                ? round(($correctas / $total) * 100, 2)
                : 0;

            $idGrafico = 'graficoPregunta' . (int) $pregunta['pregunta_id'];
            ?>

            <div class="pregunta-card">

                <h2>
                    Pregunta <?= (int) $pregunta['pregunta_id'] ?>
                </h2>

                <p class="pregunta-subtitulo">
                    Distribución de respuestas registradas
                </p>

                <div class="grafico-pastel">
                    <canvas
                        id="<?= Html::encode($idGrafico) ?>"
                    ></canvas>
                </div>

                <div class="pregunta-porcentaje">
                    <?= number_format($porcentaje, 1) ?>%
                    <small>Porcentaje de aciertos</small>
                </div>

                <div class="pregunta-detalles">

                    <div class="detalle-item">
                        <span>Correctas</span>
                        <strong><?= $correctas ?></strong>
                    </div>

                    <div class="detalle-item">
                        <span>Incorrectas</span>
                        <strong><?= $incorrectas ?></strong>
                    </div>

                    <div class="detalle-item">
                        <span>Total respondidas</span>
                        <strong><?= $total ?></strong>
                    </div>

                    <div class="detalle-item">
                        <span>Porcentaje de errores</span>
                        <strong>
                            <?= number_format(100 - $porcentaje, 1) ?>%
                        </strong>
                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <?php if (empty($estadisticasPreguntas)): ?>
        <div class="sin-datos">
            Todavía no existen respuestas registradas para mostrar estadísticas.
        </div>
    <?php endif; ?>

</div>

<?php

$graficos = [];

foreach ($estadisticasPreguntas as $pregunta) {
    $graficos[] = [
        'id' => 'graficoPregunta' . (int) $pregunta['pregunta_id'],
        'correctas' => (int) $pregunta['correctas'],
        'incorrectas' => (int) $pregunta['incorrectas'],
    ];
}

$js = 'const datosGraficos = ' . Json::htmlEncode($graficos) . ';

datosGraficos.forEach(function (dato) {
    const canvas = document.getElementById(dato.id);

    if (!canvas) {
        return;
    }

    new Chart(canvas, {
        type: "pie",
        data: {
            labels: ["Correctas", "Incorrectas"],
            datasets: [{
                data: [dato.correctas, dato.incorrectas],
                backgroundColor: ["#16a34a", "#ef4444"],
                borderColor: ["#ffffff", "#ffffff"],
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "bottom"
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const total = context.dataset.data.reduce(
                                (a, b) => a + b, 0
                            );
                            const valor = context.raw;
                            const porcentaje = total > 0
                                ? ((valor / total) * 100).toFixed(1)
                                : "0.0";

                            return context.label + ": " + valor
                                + " (" + porcentaje + "%)";
                        }
                    }
                }
            }
        }
    });
});';

$this->registerJs($js, View::POS_END);
?>
