<?php

declare(strict_types=1);

use yii\helpers\Html;

$this->title = 'Integridad Científica';

$this->registerCssFile('@web/css/contenido-etica.css');
?>

<section class="ethics-page">

    <div class="ethics-container">

        <header class="ethics-header">

            <span class="ethics-label">
                <i class="fa-solid fa-flask"></i>
                INTEGRIDAD CIENTÍFICA
            </span>

            <h1>
                Integridad en la
                <span>Investigación Científica</span>
            </h1>

            <p>
                La integridad científica implica actuar con honestidad,
                transparencia, responsabilidad y rigor durante todas
                las etapas de una investigación.
            </p>

        </header>


        <div class="ethics-grid">

            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-file-circle-check"></i>
                </div>

                <h2>Honestidad académica</h2>

                <p>
                    Presentar información, datos y resultados de forma
                    auténtica, evitando falsificaciones o manipulaciones.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>

                <h2>Rigor científico</h2>

                <p>
                    Aplicar métodos adecuados y procedimientos rigurosos
                    para obtener resultados confiables.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-eye"></i>
                </div>

                <h2>Transparencia</h2>

                <p>
                    Comunicar de manera clara los procedimientos,
                    limitaciones y resultados de una investigación.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-pen-nib"></i>
                </div>

                <h2>Autoría responsable</h2>

                <p>
                    Reconocer adecuadamente las contribuciones de las
                    personas que participan en un trabajo científico.
                </p>

            </article>

        </div>


        <div class="ethics-warning">

            <i class="fa-solid fa-triangle-exclamation"></i>

            <div>

                <h3>
                    Prácticas que deben evitarse
                </h3>

                <p>
                    Fabricación de datos, falsificación de resultados,
                    plagio, apropiación indebida de ideas y otras
                    conductas que comprometan la integridad científica.
                </p>

            </div>

        </div>


        <div class="ethics-back">

            <?= Html::a(
                '<i class="fa-solid fa-arrow-left"></i> Volver a servicios',
                ['site/servicios'],
                [
                    'class' => 'back-button',
                    'encode' => false
                ]
            ) ?>

        </div>

    </div>

</section>