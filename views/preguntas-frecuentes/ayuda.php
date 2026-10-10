<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Ayuda y orientación';

$this->registerCssFile('@web/css/ayuda.css', [
    'depends' => [\yii\web\YiiAsset::class],
]);
?>

<div class="ayuda-page">

    <section class="ayuda-hero">
        <div class="ayuda-hero-content">
            <span class="ayuda-etiqueta">
                <i class="fa-solid fa-hands-helping"></i>
                CENTRO DE ORIENTACIÓN
            </span>

            <h1>Ayuda y orientación</h1>

            <p>
                Encuentra información, recomendaciones y recursos para
                desarrollar investigaciones científicas responsables,
                transparentes y respetuosas de los principios éticos.
            </p>

            <a href="#temas-ayuda" class="btn-ayuda-principal">
                Explorar orientación
                <i class="fa-solid fa-arrow-down"></i>
            </a>
        </div>

        <div class="ayuda-hero-icon">
            <i class="fa-solid fa-compass"></i>
        </div>
    </section>

    <section class="ayuda-introduccion">
        <div class="ayuda-icono-intro">
            <i class="fa-solid fa-circle-info"></i>
        </div>

        <div>
            <h2>¿Cómo podemos ayudarte?</h2>
            <p>
                Esta sección está dirigida a estudiantes, docentes e
                investigadores que necesitan orientación sobre la aplicación
                del Código de Ética en la Investigación Científica. Aquí
                encontrarás información para proteger los derechos de los
                participantes, actuar con honestidad y prevenir malas
                prácticas científicas.
            </p>
        </div>
    </section>

    <section class="ayuda-seccion" id="temas-ayuda">
        <div class="ayuda-encabezado">
            <span>RECURSOS DE ORIENTACIÓN</span>
            <h2>¿Qué necesitas consultar?</h2>
            <p>Selecciona un tema para conocer sus principales recomendaciones.</p>
        </div>

        <div class="ayuda-grid">

            <article class="ayuda-card">
                <div class="ayuda-card-icono azul">
                    <i class="fa-solid fa-microscope"></i>
                </div>

                <h3>Orientación para investigadores</h3>

                <p>
                    Conoce las recomendaciones básicas para planificar y
                    desarrollar investigaciones científicas responsables.
                </p>

                <ul>
                    <li>Definir objetivos claros.</li>
                    <li>Respetar los principios éticos.</li>
                    <li>Presentar resultados honestos.</li>
                </ul>

                <a href="#consulta-investigacion">
                    Consultar recomendaciones
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </article>

            <article class="ayuda-card">
                <div class="ayuda-card-icono verde">
                    <i class="fa-solid fa-handshake"></i>
                </div>

                <h3>Consentimiento informado</h3>

                <p>
                    Comprende la importancia de informar y respetar la
                    decisión de las personas que participan en una investigación.
                </p>

                <ul>
                    <li>Explicar el propósito del estudio.</li>
                    <li>Informar sobre riesgos y beneficios.</li>
                    <li>Respetar la participación voluntaria.</li>
                </ul>

                <a href="#consulta-consentimiento">
                    Conocer más
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </article>

            <article class="ayuda-card">
                <div class="ayuda-card-icono naranja">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <h3>Integridad científica</h3>

                <p>
                    Aprende a prevenir prácticas que afectan la credibilidad
                    y la calidad de los resultados científicos.
                </p>

                <ul>
                    <li>Evitar el plagio.</li>
                    <li>No falsificar datos.</li>
                    <li>Reconocer las fuentes consultadas.</li>
                </ul>

                <a href="#consulta-integridad">
                    Revisar recomendaciones
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </article>

            <article class="ayuda-card">
                <div class="ayuda-card-icono morado">
                    <i class="fa-solid fa-lock"></i>
                </div>

                <h3>Protección de datos</h3>

                <p>
                    Identifica buenas prácticas para proteger la información
                    personal obtenida durante los estudios científicos.
                </p>

                <ul>
                    <li>Resguardar los datos recopilados.</li>
                    <li>Limitar el acceso a la información.</li>
                    <li>Respetar la confidencialidad.</li>
                </ul>

                <a href="#consulta-datos">
                    Conocer buenas prácticas
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </article>

        </div>
    </section>

    <section class="ayuda-preguntas">
        <div class="ayuda-encabezado">
            <span>ORIENTACIÓN RÁPIDA</span>
            <h2>Preguntas frecuentes</h2>
            <p>Respuestas a algunas dudas comunes sobre la ética científica.</p>
        </div>

        <div class="ayuda-acordeon">

            <details>
                <summary>
                    ¿Qué debo hacer antes de iniciar una investigación?
                    <i class="fa-solid fa-plus"></i>
                </summary>
                <p>
                    Define los objetivos y la metodología, identifica los
                    posibles riesgos, revisa las normas aplicables y determina
                    si necesitas autorización institucional o evaluación ética
                    antes de comenzar.
                </p>
            </details>

            <details>
                <summary>
                    ¿Por qué es importante el consentimiento informado?
                    <i class="fa-solid fa-plus"></i>
                </summary>
                <p>
                    Permite que las personas comprendan el propósito del estudio,
                    sus procedimientos, riesgos y beneficios, y decidan
                    libremente si desean participar, conforme a las normas
                    aplicables.
                </p>
            </details>

            <details>
                <summary>
                    ¿Qué se considera plagio?
                    <i class="fa-solid fa-plus"></i>
                </summary>
                <p>
                    El plagio consiste en presentar ideas, textos u obras de
                    otras personas como propios sin el reconocimiento adecuado
                    de su autoría. Para prevenirlo, cita las fuentes y utiliza
                    referencias académicas correctas.
                </p>
            </details>

            <details>
                <summary>
                    ¿Qué puedo hacer si identifico una posible falta ética?
                    <i class="fa-solid fa-plus"></i>
                </summary>
                <p>
                    Revisa la normativa institucional y solicita orientación a
                    la instancia universitaria competente. Describe los hechos
                    de forma objetiva y utiliza los canales oficiales
                    establecidos por la institución.
                </p>
            </details>

            <details>
                <summary>
                    ¿Cómo debo proteger los datos de los participantes?
                    <i class="fa-solid fa-plus"></i>
                </summary>
                <p>
                    Recopila únicamente los datos necesarios, limita el acceso
                    a las personas autorizadas, utiliza medidas de seguridad
                    adecuadas y cumple las obligaciones legales de protección
                    de datos que correspondan.
                </p>
            </details>

        </div>
    </section>

    <section class="ayuda-recomendaciones" id="consulta-investigacion">
        <div class="ayuda-encabezado">
            <span>BUENAS PRÁCTICAS</span>
            <h2>Recomendaciones para una investigación responsable</h2>
        </div>

        <div class="recomendaciones-grid">
            <div class="recomendacion">
                <i class="fa-solid fa-check-circle"></i>
                <div>
                    <h3>Actúa con honestidad</h3>
                    <p>Registra, analiza y presenta los resultados de manera veraz.</p>
                </div>
            </div>

            <div class="recomendacion" id="consulta-consentimiento">
                <i class="fa-solid fa-check-circle"></i>
                <div>
                    <h3>Respeta a los participantes</h3>
                    <p>Protege su dignidad, autonomía, derechos y bienestar.</p>
                </div>
            </div>

            <div class="recomendacion" id="consulta-integridad">
                <i class="fa-solid fa-check-circle"></i>
                <div>
                    <h3>Reconoce las fuentes</h3>
                    <p>Utiliza citas y referencias para reconocer las contribuciones de otros autores.</p>
                </div>
            </div>

            <div class="recomendacion" id="consulta-datos">
                <i class="fa-solid fa-check-circle"></i>
                <div>
                    <h3>Protege la información</h3>
                    <p>Gestiona los datos de manera segura y conforme a la normativa aplicable.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="ayuda-contacto" id="contacto-ayuda">
        <div class="contacto-texto">
            <span>¿NECESITAS MÁS INFORMACIÓN?</span>
            <h2>Solicita orientación</h2>
            <p>
                Si tienes dudas sobre un procedimiento, una norma o una
                situación relacionada con la ética de la investigación,
                consulta los canales oficiales de tu institución.
            </p>
            <p>
                <i class="fa-solid fa-circle-info"></i>
                Utiliza los medios institucionales autorizados para comunicar
                situaciones que requieran atención.
            </p>
        </div>

        <div class="contacto-panel">
            <div class="contacto-panel-icono">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>

            <h3>Canales de atención institucional</h3>

            <p>
                Para recibir orientación específica, contacta a la dependencia
                universitaria responsable de investigación o ética, de acuerdo
                con los procedimientos oficiales vigentes.
            </p>

            <a href="<?= \yii\helpers\Url::to(['/site/documentos']) ?>"
               class="btn-documentos-ayuda">
                <i class="fa-solid fa-folder-open"></i>
                Consultar documentos
            </a>
        </div>
    </section>

    <section class="ayuda-final">
        <i class="fa-solid fa-graduation-cap"></i>
        <h2>La ética fortalece la ciencia</h2>
        <p>
            Investigar responsablemente significa generar conocimiento con
            honestidad, respeto, compromiso social y responsabilidad.
        </p>
    </section>

</div>