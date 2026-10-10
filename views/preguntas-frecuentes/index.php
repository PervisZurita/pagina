<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\CategoriasFaq[] $categorias */
/** @var string|int|null $categoriaId */


use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Preguntas frecuentes';
$this->registerCssFile('@web/css/paginacion.css');

$esAdmin = !Yii::$app->user->isGuest
    && Yii::$app->user->identity->role === 'admin';

?>

<div class="faq-container">

    <div class="faq-header">
        <div class="faq-header-icon">
            <i class="fas fa-circle-question"></i>
        </div>

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            Encuentra respuestas a las preguntas más importantes
            sobre ética e investigación científica.
        </p>

        <?php if ($esAdmin): ?>
            <div class="faq-header-actions">
                <?= Html::a(
                    '<i class="fas fa-plus"></i> Nueva pregunta',
                    ['create'],
                    ['class' => 'btn-faq-primary']
                ) ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="faq-filter-card">

        <div class="faq-filter-title">
            <i class="fas fa-filter"></i>
            Filtrar preguntas
        </div>

        <?= Html::beginForm(['index'], 'get', [
            'class' => 'faq-filter-form',
        ]) ?>

            <div class="faq-filter-field">
                <?= Html::label('Categoría', 'categoria_id') ?>

                <?= Html::dropDownList(
                    'categoria_id',
                    $categoriaId,
                    \yii\helpers\ArrayHelper::map(
                        $categorias,
                        'id',
                        'categoria'
                    ),
                    [
                        'id' => 'categoria_id',
                        'class' => 'faq-select',
                        'prompt' => 'Todas las categorías',
                    ]
                ) ?>
            </div>

            <div class="faq-filter-buttons">
                <?= Html::submitButton(
                    '<i class="fas fa-search"></i> Buscar',
                    ['class' => 'btn-faq-primary']
                ) ?>

                <?= Html::a(
                    '<i class="fas fa-rotate-left"></i> Limpiar',
                    ['index'],
                    ['class' => 'btn-faq-secondary']
                ) ?>
            </div>

        <?= Html::endForm() ?>

    </div>

    <div class="faq-table-card">

        <div class="faq-table-heading">
            <div>
                <h2>Listado de preguntas</h2>
                <p>
                    <?= $esAdmin
                        ? 'Consulta, crea, modifica o elimina preguntas frecuentes.'
                        : 'Consulta las preguntas frecuentes y sus respuestas.' ?>
                </p>
            </div>

            <div class="faq-total">
                <i class="fas fa-list-check"></i>
                <?= (int) $dataProvider->getTotalCount() ?> registros
            </div>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => [
                'class' => 'table faq-table',
            ],
            'layout' => "{items}\n<div class=\"faq-pagination-footer\">{summary}\n{pager}</div>",
            'summary' => 'Mostrando <strong>{begin}-{end}</strong> de <strong>{totalCount}</strong> preguntas',
            'emptyText' => '<div class="faq-empty">
                <i class="fas fa-inbox"></i>
                <h3>No hay preguntas disponibles</h3>
                <p>Prueba con otra categoría.</p>
            </div>',
            'emptyTextOptions' => [
                'class' => 'faq-empty-cell',
            ],
            'columns' => [
                
                [
                    'attribute' => 'pregunta',
                    'label' => 'Pregunta',
                    'format' => 'raw',
                    'value' => static function ($model) {
                        return '<div class="faq-question-cell">'
                            . '<i class="fas fa-circle-question"></i>'
                            . '<span>'
                            . Html::encode($model->pregunta)
                            . '</span></div>';
                    },
                ],
                [
                    'label' => 'Categoría',
                    'format' => 'raw',
                    'value' => static function ($model) {
                        return Html::tag(
                            'span',
                            Html::encode(
                                $model->categoria->categoria ?? 'Sin categoría'
                            ),
                            ['class' => 'faq-category-tag']
                        );
                    },
                ],
                [
                    'label' => 'Respuesta',
                    'format' => 'raw',
                    'value' => static function ($model) {
                        $respuesta = strip_tags(
                            (string) $model->respuestas
                        );

                        $respuesta = mb_strlen($respuesta) > 100
                            ? mb_substr($respuesta, 0, 100) . '...'
                            : $respuesta;

                        return Html::tag(
                            'div',
                            Html::encode($respuesta),
                            ['class' => 'faq-answer-cell']
                        );
                    },
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Acciones',
                    'template' => $esAdmin
                        ? '{view} {update} {delete}'
                        : '{view}',
                    'contentOptions' => [
                        'class' => 'faq-actions',
                    ],
                    'buttons' => [
                        'view' => static function ($url, $model) {
                            return Html::a(
                                '<i class="fas fa-eye"></i>',
                                $url,
                                [
                                    'class' => 'faq-action-btn faq-view-btn',
                                    'title' => 'Ver pregunta',
                                    'aria-label' => 'Ver pregunta',
                                ]
                            );
                        },
                        'update' => static function ($url, $model) {
                            return Html::a(
                                '<i class="fas fa-pen"></i>',
                                $url,
                                [
                                    'class' => 'faq-action-btn faq-edit-btn',
                                    'title' => 'Editar pregunta',
                                    'aria-label' => 'Editar pregunta',
                                ]
                            );
                        },
                        'delete' => static function ($url, $model) {
                            return Html::a(
                                '<i class="fas fa-trash"></i>',
                                $url,
                                [
                                    'class' => 'faq-action-btn faq-delete-btn',
                                    'title' => 'Eliminar pregunta',
                                    'aria-label' => 'Eliminar pregunta',
                                    'data-confirm' => '¿Deseas eliminar esta pregunta frecuente?',
                                    'data-method' => 'post',
                                ]
                            );
                        },
                    ],
                ],
            ],
            'pager' => [
                'class' => \yii\widgets\LinkPager::class,
                'maxButtonCount' => 5,
                'firstPageLabel' => '<i class="fas fa-angles-left"></i>',
                'lastPageLabel' => '<i class="fas fa-angles-right"></i>',
                'prevPageLabel' => '<i class="fas fa-chevron-left"></i>',
                'nextPageLabel' => '<i class="fas fa-chevron-right"></i>',
                'options' => [
                    'class' => 'pagination faq-pagination',
                ],
                'linkOptions' => [
                    'class' => 'page-link',
                ],
                'disabledListItemSubTagOptions' => [
                    'class' => 'page-link',
                ],
                'activePageCssClass' => 'active',
                'disabledPageCssClass' => 'disabled',
                'prevPageCssClass' => 'page-item',
                'nextPageCssClass' => 'page-item',
                'firstPageCssClass' => 'page-item',
                'lastPageCssClass' => 'page-item',
                'pageCssClass' => 'page-item',
            ],
        ]) ?>

    </div>

</div>
