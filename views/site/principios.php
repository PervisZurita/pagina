<?php

declare(strict_types=1);

use yii\helpers\Html;

$this->title = 'Principios Éticos';

$this->registerCssFile('@web/css/contenido-etica.css');
?>

<section class="ethics-page">

    <div class="ethics-container">

        <header class="ethics-header">

            <span class="ethics-label">
                <i class="fa-solid fa-scale-balanced"></i>
                PRINCIPIOS ÉTICOS
            </span>

            <h1>
                Principios de la
                <span>Investigación Científica</span>
            </h1>

            <p>
                Los principios éticos orientan las decisiones y
                responsabilidades de quienes participan en procesos
                de investigación científica.
            </p>

        </header>


        <div class="ethics-grid">

            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>

                <h2>Respeto</h2>

                <p>
                    Toda investigación debe respetar la dignidad,
                    los derechos y la autonomía de las personas
                    involucradas.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>

                <h2>Justicia</h2>

                <p>
                    Los beneficios y las cargas de una investigación
                    deben distribuirse de manera justa.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <h2>Responsabilidad</h2>

                <p>
                    El investigador debe asumir las consecuencias
                    de sus decisiones y actuar de manera responsable.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-check-double"></i>
                </div>

                <h2>Honestidad</h2>

                <p>
                    Los datos, resultados y conclusiones deben ser
                    presentados de forma honesta y transparente.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-fingerprint"></i>
                </div>

                <h2>Integridad</h2>

                <p>
                    La investigación debe desarrollarse con rigor,
                    coherencia y compromiso con la verdad científica.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <h2>Respeto a la sociedad</h2>

                <p>
                    El conocimiento científico debe desarrollarse
                    considerando su impacto en la sociedad y el entorno.
                </p>

            </article>

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