<?php

declare(strict_types=1);

use yii\helpers\Html;

$this->title = 'Buenas Prácticas';

$this->registerCssFile('@web/css/contenido-etica.css');
?>

<section class="ethics-page">

    <div class="ethics-container">

        <header class="ethics-header">

            <span class="ethics-label">
                <i class="fa-solid fa-graduation-cap"></i>
                BUENAS PRÁCTICAS
            </span>

            <h1>
                Buenas prácticas de
                <span>investigación</span>
            </h1>

            <p>
                Las buenas prácticas permiten desarrollar investigaciones
                responsables, transparentes y respetuosas de los principios
                de la ética científica.
            </p>

        </header>


        <div class="ethics-grid">

            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-ban"></i>
                </div>

                <h2>Prevención del plagio</h2>

                <p>
                    Reconoce correctamente las ideas, palabras,
                    datos y aportaciones de otros autores.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-handshake"></i>
                </div>

                <h2>Colaboración responsable</h2>

                <p>
                    Promueve relaciones profesionales basadas en el
                    respeto, reconocimiento y responsabilidad compartida.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>

                <h2>Conflictos de interés</h2>

                <p>
                    Identifica y comunica situaciones que puedan
                    afectar la objetividad de una investigación.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-database"></i>
                </div>

                <h2>Manejo de datos</h2>

                <p>
                    Los datos deben ser recopilados, almacenados,
                    analizados y comunicados de manera responsable.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>

                <h2>Revisión responsable</h2>

                <p>
                    Las evaluaciones científicas deben realizarse
                    de manera objetiva, respetuosa y confidencial.
                </p>

            </article>


            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-comments"></i>
                </div>

                <h2>Comunicación científica</h2>

                <p>
                    Los resultados deben comunicarse con claridad,
                    precisión y sin presentar conclusiones engañosas.
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