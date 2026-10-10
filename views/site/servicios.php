<?php

declare(strict_types=1);

use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'Servicios | Código de Ética de la Investigación Científica';

$this->registerCssFile('@web/css/servicios.css');

$this->registerCssFile(
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'
);
?>

<section id="servicios" class="content-section">

    <div class="section-container">

        <!-- ENCABEZADO -->
        <header class="section-header">

            <span class="section-label">
                <i class="fa-solid fa-book-open" aria-hidden="true"></i>
                RECURSOS ACADÉMICOS
            </span>

            <h1>
                Código de Ética de la
                <span>Investigación Científica</span>
            </h1>

            <p>
                Explora recursos diseñados para conocer, comprender
                y aplicar los principios éticos que orientan una
                investigación científica responsable.
            </p>

        </header>


        <!-- SERVICIOS -->
        <div class="services-grid">


            <!-- PRINCIPIOS ÉTICOS -->
            <article class="service-card">

                <div class="service-icon">
                    <i
                        class="fa-solid fa-scale-balanced"
                        aria-hidden="true"
                    ></i>
                </div>

                <div class="service-content">

                    <span class="service-number">
                        01
                    </span>

                    <h2>
                        Principios éticos
                    </h2>

                    <p>
                        Conoce los principios fundamentales que
                        orientan una investigación científica,
                        como respeto, responsabilidad, honestidad,
                        justicia e integridad.
                    </p>

                    <?= Html::a(
                        'Conocer principios <i class="fa-solid fa-arrow-right"></i>',
                        ['site/principios'],
                        [
                            'class' => 'service-link',
                            'encode' => false,
                            'aria-label' => 'Conocer los principios éticos'
                        ]
                    ) ?>

                </div>

            </article>


            <!-- INTEGRIDAD CIENTÍFICA -->
            <article class="service-card">

                <div class="service-icon">
                    <i
                        class="fa-solid fa-flask"
                        aria-hidden="true"
                    ></i>
                </div>

                <div class="service-content">

                    <span class="service-number">
                        02
                    </span>

                    <h2>
                        Integridad científica
                    </h2>

                    <p>
                        Aprende sobre honestidad académica,
                        transparencia, rigor científico y
                        responsabilidad en la generación y
                        comunicación de conocimientos.
                    </p>

                    <?= Html::a(
                        'Explorar integridad <i class="fa-solid fa-arrow-right"></i>',
                        ['site/integridad'],
                        [
                            'class' => 'service-link',
                            'encode' => false,
                            'aria-label' => 'Explorar integridad científica'
                        ]
                    ) ?>

                </div>

            </article>


            <!-- PARTICIPANTES -->
            <article class="service-card">

                <div class="service-icon">
                    <i
                        class="fa-solid fa-user-shield"
                        aria-hidden="true"
                    ></i>
                </div>

                <div class="service-content">

                    <span class="service-number">
                        03
                    </span>

                    <h2>
                        Protección de participantes
                    </h2>

                    <p>
                        Comprende la importancia del consentimiento
                        informado, la confidencialidad, la privacidad
                        y el respeto de los derechos de las personas
                        que participan en una investigación.
                    </p>

                    <?= Html::a(
                        'Conocer más <i class="fa-solid fa-arrow-right"></i>',
                        ['site/participantes'],
                        [
                            'class' => 'service-link',
                            'encode' => false,
                            'aria-label' => 'Conocer protección de participantes'
                        ]
                    ) ?>

                </div>

            </article>


            <!-- BUENAS PRÁCTICAS -->
            <article class="service-card">

                <div class="service-icon">
                    <i
                        class="fa-solid fa-graduation-cap"
                        aria-hidden="true"
                    ></i>
                </div>

                <div class="service-content">

                    <span class="service-number">
                        04
                    </span>

                    <h2>
                        Buenas prácticas
                    </h2>

                    <p>
                        Fortalece tus conocimientos sobre buenas
                        prácticas de investigación, prevención del
                        plagio, conflictos de interés y comunicación
                        responsable de resultados.
                    </p>

                    <?= Html::a(
                        'Aprender más <i class="fa-solid fa-arrow-right"></i>',
                        ['site/buenas-practicas'],
                        [
                            'class' => 'service-link',
                            'encode' => false,
                            'aria-label' => 'Aprender sobre buenas prácticas'
                        ]
                    ) ?>

                </div>

            </article>

        </div>


        <!-- RECURSOS ADICIONALES -->
        <div class="resources-panel">

            <div class="resources-icon">
                <i
                    class="fa-solid fa-lightbulb"
                    aria-hidden="true"
                ></i>
            </div>

            <div class="resources-content">

                <span>
                    APRENDE Y REFLEXIONA
                </span>

                <h2>
                    Recursos para tu formación científica
                </h2>

                <p>
                    Consulta preguntas frecuentes, videos educativos
                    y otros recursos para fortalecer tus conocimientos
                    sobre ética e integridad en la investigación.
                </p>

            </div>

            <div class="resources-actions">

                <?= Html::a(
                    '<i class="fa-solid fa-circle-play"></i> Videos',
                    ['site/videos'],
                    [
                        'class' => 'resource-button primary',
                        'encode' => false
                    ]
                ) ?>

                <?= Html::a(
                    '<i class="fa-solid fa-comments"></i> Preguntas frecuentes',
                    ['preguntas-frecuentes/index'],
                    [
                        'class' => 'resource-button',
                        'encode' => false
                    ]
                ) ?>

            </div>

        </div>

    </div>

</section>