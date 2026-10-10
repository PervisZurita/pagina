<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var array $preguntas */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Cuestionario de autoevaluación';

$this->registerCss(<<<CSS
.cuestionario-wrapper {
    max-width: 1000px;
    margin: 35px auto;
    padding: 20px;
}
.cuestionario-hero {
    padding: 35px;
    border-radius: 20px;
    background: linear-gradient(135deg, #123c69, #16856b);
    color: #fff;
    margin-bottom: 25px;
}
.cuestionario-hero h1 { font-weight: 800; margin-bottom: 12px; }
.cuestionario-hero p { margin: 0; opacity: .9; }
.cuestionario-progreso {
    height: 8px;
    background: #e5e7eb;
    border-radius: 20px;
    overflow: hidden;
    margin: 15px 0 25px;
}
.cuestionario-progreso-barra {
    height: 100%;
    width: 0;
    background: #16856b;
    transition: width .2s;
}
.pregunta-card {
    padding: 25px;
    margin-bottom: 20px;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 5px 18px rgba(0,0,0,.04);
}
.pregunta-categoria {
    display: inline-block;
    background: #e8f5ef;
    color: #116149;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 14px;
}
.pregunta-titulo { font-size: 19px; font-weight: 700; margin-bottom: 20px; color: #172b4d; }
.opcion-respuesta {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px;
    border: 1px solid #dfe5eb;
    border-radius: 10px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: .2s;
}
.opcion-respuesta:hover { background: #f0f8f5; border-color: #16856b; }
.opcion-respuesta input { margin-top: 5px; accent-color: #16856b; }
.btn-cuestionario {
    border: 0;
    border-radius: 10px;
    padding: 14px 25px;
    background: #16856b;
    color: white;
    font-weight: 700;
}
.btn-cuestionario:hover { background: #116149; color: white; }
@media(max-width:600px) {
    .cuestionario-wrapper { padding: 10px; }
    .cuestionario-hero { padding: 24px; }
    .pregunta-card { padding: 18px; }
}
CSS);

?>

<div class="cuestionario-wrapper">

    <div class="cuestionario-hero">
        <h1>
            <i class="fas fa-clipboard-check"></i>
            Autoevaluación de ética científica
        </h1>
        <p>
            Evalúa tus conocimientos sobre los principios éticos,
            la integridad científica y la responsabilidad investigadora.
        </p>
    </div>

    <?php if (empty($preguntas)): ?>

        <div class="alert alert-info">
            No hay preguntas disponibles en este momento.
        </div>

    <?php else: ?>

        <div class="d-flex justify-content-between align-items-center">
            <strong>Tu progreso</strong>
            <span id="contador-respuestas">
                0 de <?= count($preguntas) ?> respondidas
            </span>
        </div>

        <div class="cuestionario-progreso">
            <div
                class="cuestionario-progreso-barra"
                id="barra-progreso"
            ></div>
        </div>

        <?= Html::beginForm(
            ['realizar'],
            'post',
            ['id' => 'form-cuestionario']
        ) ?>

        <?php foreach ($preguntas as $indice => $pregunta): ?>

            <div class="pregunta-card">

                <span class="pregunta-categoria">
                    <?= Html::encode($pregunta['categoria']) ?>
                </span>

                <h2 class="pregunta-titulo">
                    <?= ($indice + 1) ?>.
                    <?= Html::encode($pregunta['pregunta']) ?>
                </h2>

                <?php if (empty($pregunta['opciones'])): ?>
                    <div class="alert alert-warning">
                        Esta pregunta no tiene opciones registradas.
                    </div>
                <?php else: ?>

                    <?php foreach ($pregunta['opciones'] as $opcion): ?>

                        <label class="opcion-respuesta">
                            <?= Html::radio(
                                'respuestas[' . (int) $pregunta['id'] . ']',
                                false,
                                [
                                    'value' => (int) $opcion['id'],
                                    'required' => true,
                                ]
                            ) ?>

                            <span>
                                <?= Html::encode($opcion['opcion']) ?>
                            </span>
                        </label>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

        <?php endforeach; ?>

        <div class="text-center mt-4 mb-5">
            <?= Html::submitButton(
                '<i class="fas fa-check-circle"></i> Finalizar autoevaluación',
                [
                    'class' => 'btn-cuestionario',
                    'data-confirm' => '¿Deseas enviar tus respuestas y calcular tu calificación?',
                ]
            ) ?>
        </div>

        <?= Html::endForm() ?>

        <?php
        $this->registerJs(<<<JS
        (function () {
            const formulario = document.getElementById('form-cuestionario');
            const radios = formulario.querySelectorAll('input[type="radio"]');
            const contador = document.getElementById('contador-respuestas');
            const barra = document.getElementById('barra-progreso');
           

            function actualizarProgreso() {
                const grupos = new Set(
                    Array.from(radios).map(radio => radio.name)
                );
                let respondidas = 0;

                grupos.forEach(nombre => {
                    if (formulario.querySelector('input[name="' + nombre + '"]:checked')) {
                        respondidas++;
                    }
                });

                const cantidad = grupos.size;
                contador.textContent = respondidas + ' de ' + cantidad + ' respondidas';
                barra.style.width = (cantidad ? respondidas / cantidad * 100 : 0) + '%';
            }

            radios.forEach(radio => {
                radio.addEventListener('change', actualizarProgreso);
            });

            actualizarProgreso();
        })();
        JS);
        ?>

    <?php endif; ?>

</div>