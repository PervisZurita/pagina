<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Protección de Participantes';

$this->registerCssFile('@web/css/contenido-etica.css');
?>

<section class="ethics-page">

    <div class="ethics-container">

        <!-- ENCABEZADO -->
        <header class="ethics-header">

            <span class="ethics-label">
                <i class="fa-solid fa-user-shield"></i>
                PROTECCIÓN DE PARTICIPANTES
            </span>

            <h1>
                Protección de las personas
                <span>en la Investigación Científica</span>
            </h1>

            <p>
                Toda investigación científica que involucre personas
                debe respetar su dignidad, autonomía, privacidad y
                derechos fundamentales, procurando proteger su
                bienestar durante todo el proceso investigativo.
            </p>

        </header>

        <!-- TARJETAS INFORMATIVAS -->
        <div class="ethics-grid">

            <!-- CONSENTIMIENTO INFORMADO -->
            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-file-signature"></i>
                </div>

                <h2>Consentimiento informado</h2>

                <p>
                    Los participantes deben recibir información clara
                    y suficiente sobre los objetivos, procedimientos,
                    posibles riesgos y beneficios de la investigación
                    antes de decidir si desean participar.
                </p>

            </article>

            <!-- CONFIDENCIALIDAD -->
            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-lock"></i>
                </div>

                <h2>Confidencialidad</h2>

                <p>
                    La información personal recopilada debe protegerse
                    contra el acceso, uso o divulgación no autorizados,
                    respetando los compromisos de confidencialidad
                    establecidos con los participantes.
                </p>

            </article>

            <!-- PRIVACIDAD -->
            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-user-secret"></i>
                </div>

                <h2>Privacidad y datos personales</h2>

                <p>
                    Los datos personales deben recopilarse y utilizarse
                    únicamente para los fines autorizados, aplicando
                    medidas de seguridad que eviten su exposición
                    o utilización indebida.
                </p>

            </article>

            <!-- BIENESTAR -->
            <article class="ethics-card">

                <div class="ethics-icon">
                    <i class="fa-solid fa-heart-pulse"></i>
                </div>

                <h2>Bienestar de los participantes</h2>

                <p>
                    Los investigadores deben identificar y reducir
                    los riesgos previsibles, procurando que la
                    investigación respete la seguridad, la dignidad
                    y el bienestar de las personas involucradas.
                </p>

            </article>

        </div>

        <!-- INFORMACIÓN DESTACADA -->
        <div class="ethics-warning">

            <i class="fa-solid fa-triangle-exclamation"></i>

            <div>

                <h3>
                    Derechos de las personas participantes
                </h3>

                <p>
                    La participación debe ser voluntaria y basarse
                    en información suficiente. Se debe respetar la
                    decisión de cada persona, evitar la coerción
                    y proteger especialmente a quienes puedan
                    encontrarse en situaciones de vulnerabilidad.
                    La investigación también debe cumplir los
                    procedimientos de revisión ética que correspondan.
                </p>

            </div>

        </div>

        <!-- BUENAS PRÁCTICAS -->
        <div class="ethics-highlight">

            <i class="fa-solid fa-shield-heart"></i>

            <div>

                <h3>
                    Compromiso con una investigación responsable
                </h3>

                <p>
                    Proteger a los participantes no es solamente
                    un requisito formal: es una responsabilidad ética.
                    Antes de iniciar una investigación, es importante
                    evaluar sus riesgos, explicar las condiciones
                    de participación y establecer medidas para
                    proteger los derechos y la información personal.
                </p>

            </div>

        </div>

        <!-- BOTÓN VOLVER -->
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