<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\Foro[] $foros */

use app\models\Categorias2;
use yii\helpers\Html;
use yii\helpers\StringHelper;

$this->title = 'Código de Ética de la Investigación Científica';

$this->params['meta_description'] =
    'Consulta los capítulos y artículos del Código de Ética de la Investigación Científica.';

$this->params['meta_keywords'] =
    'código de ética, investigación científica, principios éticos, UTLVTE';

$this->registerCssFile('@web/css/codigo-etica.css');

$this->registerJsFile('@web/js/codigo-etica.js', [
    'depends' => [\yii\web\YiiAsset::class],
]);

$capitulosRomanos = [
    'I', 'II', 'III', 'IV', 'V',
    'VI', 'VII', 'VIII', 'IX',
];

$esAdmin = !Yii::$app->user->isGuest
    && Yii::$app->user->identity->role === 'admin';

$categorias = Categorias2::find()
    ->with([
        'codigoEticas' => function ($query) {
            $query->orderBy(['id' => SORT_ASC]);
        },
    ])
    ->orderBy(['id' => SORT_ASC])
    ->all();

?>

<div class="site-index">

    <section class="codigo-hero">

        
<div class="codigo-hero-content">

    <div class="codigo-hero-main">

        <div class="codigo-hero-image">
            <?= \yii\helpers\Html::img('@web/images/logo.png', [
                'alt' => 'Código de Ética en la Investigación Científica',
                'class' => 'codigo-hero-img',
            ]) ?>
        </div>

        <div class="codigo-hero-text">

            <div class="codigo-hero-badge">
                <span class="badge-icon">
                    <i class="fa-solid fa-scale-balanced"></i>
                </span>

                <span>CÓDIGO DE ÉTICA EN LA INVESTIGACIÓN</span>
            </div>

            <div class="codigo-hero-line"></div>

            <h1>
                Ética de la
                <span>Investigación Científica</span>
            </h1>

            <p>
                Principios, valores y normas éticas que orientan la
                investigación científica y fortalecen su compromiso
                con la sociedad.
            </p>

            <div class="codigo-hero-info">

                <div class="hero-info-item">
                    <i class="fa-solid fa-building-columns"></i>

                    <div>
                        <strong>Universidad Técnica</strong>
                        <small>Luis Vargas Torres de Esmeraldas</small>
                    </div>
                </div>

                <div class="hero-info-divider"></div>

                <div class="hero-info-item">
                    <i class="fa-solid fa-book-open"></i>

                    <div>
                        <strong>Documento institucional</strong>
                        <small>Investigación científica</small>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>


    </section>


    <section class="codigo-section">

        <div class="codigo-container">

            <div class="codigo-intro">

                <div class="codigo-intro-header">

                    <div class="codigo-intro-icon">
                        <i class="fa-solid fa-book-open-reader"></i>
                    </div>

                    <div>
                        <span class="section-label">
                            UNIVERSIDAD TÉCNICA “LUIS VARGAS TORRES”
                        </span>

                        <h2>
                            Código de Ética de la Investigación Científica
                        </h2>
                    </div>

                </div>

                <div class="codigo-intro-line"></div>

                <p>
                    Conoce los capítulos, artículos, principios y
                    disposiciones que orientan la actividad científica
                    dentro de la Universidad Técnica “Luis Vargas Torres”
                    de Esmeraldas.
                </p>

                <div class="codigo-intro-features">

                    <div class="intro-feature">
                        <div class="intro-feature-icon">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </div>

                        <div>
                            <strong>Principios éticos</strong>
                            <span>
                                Orientaciones para una investigación responsable.
                            </span>
                        </div>
                    </div>

                    <div class="intro-feature">
                        <div class="intro-feature-icon">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>

                        <div>
                            <strong>Normativa</strong>
                            <span>
                                Artículos y disposiciones institucionales.
                            </span>
                        </div>
                    </div>

                    <div class="intro-feature">
                        <div class="intro-feature-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>

                        <div>
                            <strong>Comunidad científica</strong>
                            <span>
                                Compromiso con la sociedad y la investigación.
                            </span>
                        </div>
                    </div>

                </div>

            </div>


            <div class="codigo-capitulos">

                <div class="capitulos-encabezado">

                    <span class="section-label">
                        DOCUMENTO NORMATIVO
                    </span>

                    <h2>Capítulos y artículos</h2>

                    <p>
                        Selecciona un capítulo para consultar sus artículos
                        y disposiciones.
                    </p>

                    <?php if ($esAdmin): ?>

                        <div class="acciones-codigo">

                            <?= Html::a(
                                '<i class="fa-solid fa-plus"></i> Agregar artículo',
                                ['codigo-etica/create'],
                                ['class' => 'btn-agregar-articulo']
                            ) ?>

                        </div>

                    <?php endif; ?>

                </div>


                <?php if (!empty($categorias)): ?>

                    <?php foreach ($categorias as $indice => $categoria): ?>

                        <div class="capitulo">

                            <button
                                type="button"
                                class="capitulo-btn"
                                onclick="toggleCapitulo(this)"
                                aria-expanded="false"
                            >

                                <span class="capitulo-titulo">

                                    <strong>
                                        CAPÍTULO <?= Html::encode(
                                            $capitulosRomanos[$indice]
                                                ?? (string) ($indice + 1)
                                        ) ?>
                                    </strong>

                                    <small>
                                        <?= Html::encode($categoria->nombre) ?>
                                    </small>

                                </span>

                                <span class="flecha">+</span>

                            </button>


                            <div class="capitulo-contenido">

                                <?php if (!empty($categoria->codigoEticas)): ?>

                                    <?php foreach ($categoria->codigoEticas as $articulo): ?>

                                        <article class="articulo-etica">

                                            <div class="articulo-etica-encabezado">

                                                <span class="articulo-etica-icono">
                                                    <i class="fa-solid fa-file-lines"></i>
                                                </span>

                                                <div class="articulo-etica-titulo">

                                                    <span class="articulo-numero">
                                                        <?= Html::encode(
                                                            $articulo->articulo
                                                                ?: 'Artículo ' . $articulo->id
                                                        ) ?>
                                                    </span>

                                                    <h3>
                                                        <?= Html::encode($articulo->titulo) ?>
                                                    </h3>

                                                </div>

                                            </div>


                                            <div class="articulo-etica-contenido">
                                                <?= nl2br(
                                                    Html::encode($articulo->contenido)
                                                ) ?>
                                            </div>


                                            <?php if ($esAdmin): ?>

                                                <div class="acciones-articulo">

                                                    <?= Html::a(
                                                        '<i class="fa-solid fa-pen-to-square"></i> Editar',
                                                        [
                                                            'codigo-etica/update',
                                                            'id' => $articulo->id,
                                                        ],
                                                        [
                                                            'class' => 'btn-editar-articulo',
                                                        ]
                                                    ) ?>

                                                    <?= Html::a(
                                                        '<i class="fa-solid fa-trash"></i> Eliminar',
                                                        [
                                                            'codigo-etica/delete',
                                                            'id' => $articulo->id,
                                                        ],
                                                        [
                                                            'class' => 'btn-eliminar-articulo',
                                                            'data' => [
                                                                'confirm' => '¿Estás seguro de que deseas eliminar este artículo?',
                                                                'method' => 'post',
                                                            ],
                                                        ]
                                                    ) ?>

                                                </div>

                                            <?php endif; ?>

                                        </article>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <div class="articulos-vacios">

                                        <i class="fa-regular fa-folder-open"></i>

                                        <p>
                                            Esta categoría todavía no tiene
                                            artículos registrados.
                                        </p>

                                        <?php if ($esAdmin): ?>

                                            <?= Html::a(
                                                '<i class="fa-solid fa-plus"></i> Agregar artículo a esta categoría',
                                                [
                                                    'codigo-etica/create',
                                                    'categoria_id' => $categoria->id,
                                                ],
                                                [
                                                    'class' => 'btn-agregar-articulo',
                                                ]
                                            ) ?>

                                        <?php endif; ?>

                                    </div>

                                <?php endif; ?>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="articulos-vacios">

                        <i class="fa-regular fa-folder-open"></i>

                        <h3>No hay capítulos registrados</h3>

                        <p>
                            Registra las categorías para mostrar los capítulos
                            del Código de Ética.
                        </p>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </section>


    

</div>
