<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\Documento[] $documentos */

use yii\helpers\Html;

$this->title = 'Documentos institucionales';

$this->registerCssFile('@web/css/documentos.css');

$esAdmin = !Yii::$app->user->isGuest
    && Yii::$app->user->identity->role === 'admin';

?>

<div class="documentos-pagina">

    <header class="documentos-hero">
        <div class="documentos-hero-icon">
            <i class="fa-solid fa-folder-open"></i>
        </div>

        <span>RECURSOS INSTITUCIONALES</span>

        <h1>Documentos</h1>

        <p>
            Consulta y accede a los documentos relacionados con la ética
            y la investigación científica.
        </p>
    </header>

    <div class="documentos-contenedor">

        <div class="documentos-encabezado">
            <div>
                <h2>Biblioteca documental</h2>
                <p>Documentos disponibles para consulta.</p>
            </div>

            <?php if ($esAdmin): ?>
                <?= Html::a(
                    '<i class="fa-solid fa-plus"></i> Agregar documento',
                    ['create'],
                    ['class' => 'btn-documento-agregar']
                ) ?>
            <?php endif; ?>
        </div>

        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success">
                <?= Html::encode(Yii::$app->session->getFlash('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($documentos)): ?>

            <div class="documentos-lista">

                <?php foreach ($documentos as $documento): ?>

                    <article class="documento-card">

                        <div class="documento-icono">
                            <i class="fa-solid fa-file-pdf"></i>
                        </div>

                        <div class="documento-informacion">
                            <h3><?= Html::encode($documento->titulo) ?></h3>

                            <p>
                                <?= nl2br(Html::encode(
                                    $documento->descripcion
                                        ?: 'Documento institucional disponible para consulta.'
                                )) ?>
                            </p>

                            <small>
                                <i class="fa-regular fa-calendar"></i>
                                <?= Yii::$app->formatter->asDate(
                                    $documento->fecha_creacion
                                ) ?>
                            </small>

                            <div class="documento-acciones">

                                <?= Html::a(
                                    '<i class="fa-solid fa-eye"></i> Ver documento',
                                    '@web/documentos/' . rawurlencode($documento->archivo),
                                    [
                                        'class' => 'btn-documento-ver',
                                        'target' => '_blank',
                                        'rel' => 'noopener',
                                    ]
                                ) ?>

                                <?= Html::a(
                                    '<i class="fa-solid fa-download"></i> Descargar',
                                    '@web/documentos/' . rawurlencode($documento->archivo),
                                    [
                                        'class' => 'btn-documento-descargar',
                                        'download' => $documento->archivo,
                                    ]
                                ) ?>

                                <?php if ($esAdmin): ?>

                                    <?= Html::a(
                                        '<i class="fa-solid fa-pen"></i> Editar',
                                        ['update', 'id' => $documento->id],
                                        ['class' => 'btn-documento-editar']
                                    ) ?>

                                    <?= Html::a(
                                        '<i class="fa-solid fa-trash"></i> Eliminar',
                                        ['delete', 'id' => $documento->id],
                                        [
                                            'class' => 'btn-documento-eliminar',
                                            'data' => [
                                                'confirm' => '¿Deseas eliminar este documento?',
                                                'method' => 'post',
                                            ],
                                        ]
                                    ) ?>

                                <?php endif; ?>

                            </div>
                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="documentos-vacios">
                <i class="fa-regular fa-folder-open"></i>
                <h3>No hay documentos publicados</h3>
                <p>Los documentos institucionales aparecerán aquí cuando se registren.</p>
            </div>

        <?php endif; ?>

    </div>

</div>
