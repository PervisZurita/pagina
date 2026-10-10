<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Blog de Investigación Científica';

$this->registerCssFile('@web/css/videos.css');

$this->registerCssFile(
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'
);

$this->registerJs(<<<JS
(function () {
    const search = document.getElementById('blogSearch');
    const filters = document.querySelectorAll('.blog-filter');
    const cards = document.querySelectorAll('.blog-card');
    const count = document.getElementById('blogCount');

    let activeCategory = 'todos';

    function filterContent() {
        const term = search.value.toLowerCase().trim();
        let visible = 0;

        cards.forEach(function (card) {
            const category = card.dataset.category || '';
            const text = card.textContent.toLowerCase();
            const matchesCategory =
                activeCategory === 'todos' || category === activeCategory;
            const matchesSearch = text.includes(term);
            const show = matchesCategory && matchesSearch;

            card.hidden = !show;

            if (show) {
                visible++;
            }
        });

        count.textContent = visible + (visible === 1
            ? ' recurso encontrado'
            : ' recursos encontrados');
    }

    filters.forEach(function (filter) {
        filter.addEventListener('click', function () {
            filters.forEach(function (item) {
                item.classList.remove('active');
            });

            filter.classList.add('active');
            activeCategory = filter.dataset.filter;
            filterContent();
        });
    });

    search.addEventListener('input', filterContent);
})();
JS);
?>

<section class="research-blog">

    <div class="blog-container">

        <header class="blog-hero">
            <div class="blog-hero-content">
                <span class="blog-eyebrow">
                    <i class="fa-solid fa-book-open"></i>
                    BLOG ACADÉMICO
                </span>

                <h1>
                    Explora el mundo de la
                    <span>investigación científica</span>
                </h1>

                <p>
                    Videos, imágenes y recursos educativos para aprender
                    sobre investigación responsable, integridad académica
                    y principios éticos de la ciencia.
                </p>

                <a href="#blog-recursos" class="blog-hero-button">
                    Explorar recursos
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="blog-hero-visual">
                <img
                    src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1000&q=85"
                    alt="Material de laboratorio para investigación científica"
                    loading="lazy"
                >

                <div class="blog-hero-badge">
                    <i class="fa-solid fa-flask"></i>
                    Ciencia con responsabilidad
                </div>
            </div>
        </header>

        <section class="blog-featured">
            <div class="blog-featured-video">
                <iframe
                    src="https://www.youtube-nocookie.com/embed/l6-s_nTCrsk"
                    title="Video destacado sobre investigación científica"
                    loading="lazy"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen>
                </iframe>
            </div>

            <div class="blog-featured-info">
                <span class="blog-category-label">
                    <i class="fa-solid fa-star"></i>
                    RECURSO DESTACADO
                </span>

                <h2>La importancia de la ética en la investigación</h2>

                <p>
                    La investigación científica exige honestidad, rigor,
                    transparencia y respeto hacia las personas participantes,
                    la comunidad y el conocimiento.
                </p>

                <a
                    href="https://www.youtube.com/watch?v=l6-s_nTCrsk"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="blog-text-link">
                    Ver en YouTube
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
            </div>
        </section>

        <section class="blog-resources" id="blog-recursos">

            <div class="blog-section-heading">
                <div>
                    <span class="blog-section-kicker">BIBLIOTECA DIGITAL</span>
                    <h2>Aprende a través de recursos</h2>
                    <p>
                        Explora materiales audiovisuales y artículos
                        ilustrados sobre los temas esenciales de la ciencia.
                    </p>
                </div>
            </div>

            <div class="blog-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="search"
                    id="blogSearch"
                    placeholder="Buscar videos, temas o artículos..."
                    aria-label="Buscar recursos"
                >
            </div>

            <div class="blog-filters" aria-label="Filtrar recursos">
                <button type="button" class="blog-filter active" data-filter="todos">
                    Todos
                </button>

                <button type="button" class="blog-filter" data-filter="etica">
                    Ética científica
                </button>

                <button type="button" class="blog-filter" data-filter="integridad">
                    Integridad
                </button>

                <button type="button" class="blog-filter" data-filter="metodologia">
                    Metodología
                </button>

                <button type="button" class="blog-filter" data-filter="participantes">
                    Participantes
                </button>

                <button type="button" class="blog-filter" data-filter="publicacion">
                    Publicación
                </button>
            </div>

            <p class="blog-result-count" id="blogCount">
                9 recursos encontrados
            </p>

            <div class="blog-grid">

                <article class="blog-card" data-category="metodologia">
                    <div class="blog-card-image">
                        <img
                            src="https://images.unsplash.com/photo-1532619675605-1ede6c2ed2b0?auto=format&fit=crop&w=800&q=80"
                            alt="Investigadora analizando información científica"
                            loading="lazy"
                        >
                        <span class="blog-image-tag">Artículo</span>
                    </div>

                    <div class="blog-card-body">
                        <span class="blog-card-category">Metodología</span>
                        <h3>¿Qué es la investigación científica?</h3>
                        <p>
                            Descubre cómo se formula un problema, se recopilan
                            evidencias y se analizan resultados mediante métodos
                            sistemáticos y verificables.
                        </p>
                        <details class="blog-read-more">
                            <summary>Leer artículo</summary>
                            <div>
                                <p>
                                    La investigación científica es un proceso
                                    ordenado que busca responder preguntas,
                                    generar conocimientos y contrastar hipótesis.
                                    Debe describir sus métodos con claridad,
                                    fundamentar sus conclusiones en evidencias
                                    y reconocer las limitaciones del estudio.
                                </p>
                            </div>
                        </details>
                    </div>
                </article>

                <article class="blog-card" data-category="etica">
                    <div class="blog-card-image">
                        <img
                            src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80"
                            alt="Profesionales de la salud trabajando en equipo"
                            loading="lazy"
                        >
                        <span class="blog-image-tag">Artículo</span>
                    </div>

                    <div class="blog-card-body">
                        <span class="blog-card-category">Ética científica</span>
                        <h3>Principios éticos de la investigación</h3>
                        <p>
                            Conoce el respeto por las personas, la beneficencia,
                            la justicia y la responsabilidad durante el proceso
                            investigativo.
                        </p>
                        <details class="blog-read-more">
                            <summary>Leer artículo</summary>
                            <div>
                                <p>
                                    La ética orienta las decisiones del
                                    investigador. Implica proteger la dignidad,
                                    reducir los riesgos, distribuir las cargas
                                    y beneficios de forma justa y actuar con
                                    honestidad durante todas las etapas del estudio.
                                </p>
                            </div>
                        </details>
                    </div>
                </article>

                <article class="blog-card" data-category="integridad">
                    <div class="blog-card-image">
                        <img
                            src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80"
                            alt="Documentos y trabajo de análisis académico"
                            loading="lazy"
                        >
                        <span class="blog-image-tag">Artículo</span>
                    </div>

                    <div class="blog-card-body">
                        <span class="blog-card-category">Integridad</span>
                        <h3>Honestidad y transparencia científica</h3>
                        <p>
                            Aprende por qué es necesario presentar datos
                            auténticos, describir los métodos y comunicar
                            resultados sin distorsionarlos.
                        </p>
                        <details class="blog-read-more">
                            <summary>Leer artículo</summary>
                            <div>
                                <p>
                                    La integridad científica requiere conservar
                                    registros adecuados, informar los resultados
                                    de manera fiel, reconocer las contribuciones
                                    de otras personas y declarar los conflictos
                                    de interés relevantes.
                                </p>
                            </div>
                        </details>
                    </div>
                </article>

                <article class="blog-card" data-category="integridad">
                    <div class="blog-card-image">
                        <img
                            src="https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=800&q=80"
                            alt="Persona escribiendo un documento académico"
                            loading="lazy"
                        >
                        <span class="blog-image-tag">Artículo</span>
                    </div>

                    <div class="blog-card-body">
                        <span class="blog-card-category">Integridad</span>
                        <h3>Plagio y reconocimiento de autoría</h3>
                        <p>
                            Aprende a citar fuentes, parafrasear correctamente
                            y reconocer las ideas y aportaciones de otros autores.
                        </p>
                        <details class="blog-read-more">
                            <summary>Leer artículo</summary>
                            <div>
                                <p>
                                    El plagio consiste en presentar ideas,
                                    palabras o trabajos ajenos como propios.
                                    Para prevenirlo, cita las fuentes utilizadas,
                                    diferencia las citas textuales de las
                                    paráfrasis y asigna la autoría de acuerdo
                                    con las contribuciones reales.
                                </p>
                            </div>
                        </details>
                    </div>
                </article>

                <article class="blog-card" data-category="participantes">
                    <div class="blog-card-image">
                        <img
                            src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=800&q=80"
                            alt="Personas participando en una conversación"
                            loading="lazy"
                        >
                        <span class="blog-image-tag">Artículo</span>
                    </div>

                    <div class="blog-card-body">
                        <span class="blog-card-category">Participantes</span>
                        <h3>Consentimiento informado</h3>
                        <p>
                            Comprende el derecho de los participantes a recibir
                            información clara y decidir libremente si participan
                            en un estudio.
                        </p>
                        <details class="blog-read-more">
                            <summary>Leer artículo</summary>
                            <div>
                                <p>
                                    El consentimiento informado debe explicar
                                    el propósito del estudio, los procedimientos,
                                    los riesgos previsibles, los beneficios
                                    esperados y las condiciones para retirarse.
                                    Debe respetarse la autonomía de cada persona.
                                </p>
                            </div>
                        </details>
                    </div>
                </article>

                <article class="blog-card" data-category="participantes">
                    <div class="blog-card-image">
                        <img
                            src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80"
                            alt="Trabajo con información en un ordenador"
                            loading="lazy"
                        >
                        <span class="blog-image-tag">Artículo</span>
                    </div>

                    <div class="blog-card-body">
                        <span class="blog-card-category">Protección de datos</span>
                        <h3>Privacidad y confidencialidad</h3>
                        <p>
                            Conoce prácticas para proteger los datos personales
                            y evitar divulgaciones no autorizadas de información.
                        </p>
                        <details class="blog-read-more">
                            <summary>Leer artículo</summary>
                            <div>
                                <p>
                                    Los investigadores deben limitar la
                                    recopilación de datos a lo necesario,
                                    proteger los archivos, controlar los accesos
                                    y explicar cómo se almacenará y utilizará
                                    la información de los participantes.
                                </p>
                            </div>
                        </details>
                    </div>
                </article>

                <article class="blog-card" data-category="publicacion">
                    <div class="blog-card-image">
                        <img
                            src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=800&q=80"
                            alt="Estanterías de libros y material de consulta"
                            loading="lazy"
                        >
                        <span class="blog-image-tag">Artículo</span>
                    </div>

                    <div class="blog-card-body">
                        <span class="blog-card-category">Publicación</span>
                        <h3>Buenas prácticas en publicaciones</h3>
                        <p>
                            Revisa la importancia de citar adecuadamente,
                            informar resultados con honestidad y reconocer
                            las contribuciones de cada autor.
                        </p>
                        <details class="blog-read-more">
                            <summary>Leer artículo</summary>
                            <div>
                                <p>
                                    Una publicación responsable presenta
                                    resultados verificables, explica los métodos,
                                    identifica las fuentes, declara conflictos
                                    de interés y evita la duplicación engañosa
                                    de publicaciones.
                                </p>
                            </div>
                        </details>
                    </div>
                </article>

                <article class="blog-card" data-category="etica">
                    <div class="blog-card-image">
                        <img
                            src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=80"
                            alt="Equipo de trabajo colaborando en un proyecto"
                            loading="lazy"
                        >
                        <span class="blog-image-tag">Artículo</span>
                    </div>

                    <div class="blog-card-body">
                        <span class="blog-card-category">Responsabilidad</span>
                        <h3>Conflictos de interés</h3>
                        <p>
                            Identifica situaciones personales, económicas
                            o profesionales que podrían influir en las
                            decisiones de una investigación.
                        </p>
                        <details class="blog-read-more">
                            <summary>Leer artículo</summary>
                            <div>
                                <p>
                                    Los conflictos de interés deben identificarse,
                                    comunicarse y gestionarse de forma transparente.
                                    Su existencia no implica automáticamente una
                                    conducta incorrecta, pero ocultarlos puede
                                    comprometer la confianza en los resultados.
                                </p>
                            </div>
                        </details>
                    </div>
                </article>

                <article class="blog-card" data-category="metodologia">
                    <div class="blog-card-image">
                        <img
                            src="https://images.unsplash.com/photo-1507668077129-56e32842fceb?auto=format&fit=crop&w=800&q=80"
                            alt="Material científico para estudiar y analizar"
                            loading="lazy"
                        >
                        <span class="blog-image-tag">Video</span>
                    </div>

                    <div class="blog-card-body">
                        <span class="blog-card-category">Metodología</span>
                        <h3>Cómo organizar un proyecto de investigación</h3>
                        <p>
                            Revisa los elementos básicos de un proyecto:
                            problema, objetivos, metodología, recursos,
                            cronograma y resultados esperados.
                        </p>
                        <a
                            class="blog-watch-link"
                            href="https://www.youtube.com/results?search_query=como+elaborar+un+proyecto+de+investigacion+cientifica"
                            target="_blank"
                            rel="noopener noreferrer">
                            <i class="fa-brands fa-youtube"></i>
                            Buscar videos del tema
                        </a>
                    </div>
                </article>

            </div>

            <div class="blog-empty" id="blogEmpty" hidden>
                <i class="fa-solid fa-magnifying-glass"></i>
                <h3>No encontramos recursos</h3>
                <p>Prueba con otra palabra o selecciona una categoría diferente.</p>
            </div>

        </section>

        <section class="blog-principles">
            <div class="blog-principles-icon">
                <i class="fa-solid fa-lightbulb"></i>
            </div>

            <div>
                <span>INVESTIGAR CON RESPONSABILIDAD</span>
                <h2>El conocimiento también requiere ética.</h2>
                <p>
                    Una investigación de calidad no solo busca resultados:
                    también respeta a las personas, protege la información,
                    reconoce las fuentes y contribuye al bienestar de la sociedad.
                </p>
            </div>
        </section>

    </div>
</section>
