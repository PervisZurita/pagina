<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var app\models\Foro $foro */
/** @var app\models\ForoRespuesta[] $respuestas */
/** @var app\models\ForoRespuesta $respuesta */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = $foro->titulo;

$this->registerCss(<<<'CSS'
.debate-page {
    width: 100%;
    min-height: 100vh;
    padding: 50px 25px 90px;
    background: radial-gradient(circle at top right, rgba(37,99,235,.08), transparent 35%), #f8fafc;
}
.debate-container {
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
}
.btn-volver {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    margin-bottom: 22px;
    color: #2563eb !important;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    transition: all .2s ease;
}
.btn-volver:hover { gap: 13px; }
.debate-header {
    position: relative;
    overflow: hidden;
    padding: 42px;
    margin-bottom: 22px;
    border-radius: 22px;
    background: linear-gradient(135deg,#0f172a 0%,#1e3a8a 55%,#2563eb 100%);
    color: white;
    box-shadow: 0 20px 45px rgba(15,23,42,.18);
}
.debate-header::after {
    content: "";
    position: absolute;
    width: 250px;
    height: 250px;
    right: -80px;
    top: -100px;
    border-radius: 50%;
    background: rgba(255,255,255,.06);
}
.debate-label {
    position: relative;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 6px 11px;
    margin-bottom: 12px;
    border-radius: 20px;
    background: rgba(255,255,255,.10);
    color: #bfdbfe;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.5px;
}
.debate-header h1 {
    position: relative;
    z-index: 2;
    margin: 0 0 20px;
    max-width: 850px;
    color: white;
    font-size: 34px;
    line-height: 1.25;
    font-weight: 800;
    overflow-wrap: anywhere;
}
.debate-meta {
    position: relative;
    z-index: 2;
    display: flex;
    flex-wrap: wrap;
    gap: 12px 25px;
}
.debate-meta span {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #dbeafe;
    font-size: 14px;
}
.debate-meta i { color: #93c5fd; }
.debate-content {
    padding: 32px;
    margin-bottom: 38px;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 17px;
    box-shadow: 0 8px 25px rgba(15,23,42,.05);
}
.debate-content-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 15px;
    color: #2563eb;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1px;
}
.debate-content p {
    margin: 0;
    color: #475569;
    font-size: 16px;
    line-height: 1.85;
    white-space: pre-line;
    overflow-wrap: anywhere;
}
.respuestas-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 18px;
}
.respuestas-title h2 {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
    color: #0f172a;
    font-size: 24px;
    font-weight: 800;
}
.respuestas-title h2 i { color: #2563eb; }
.respuestas-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 28px;
    padding: 0 9px;
    border-radius: 20px;
    background: #eff6ff;
    color: #2563eb;
    font-size: 12px;
    font-weight: 800;
}
.respuesta-card {
    position: relative;
    padding: 25px;
    margin-bottom: 14px;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(15,23,42,.04);
    transition: transform .2s ease, box-shadow .2s ease;
}
.respuesta-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(15,23,42,.07);
}
.respuesta-top {
    display: flex;
    justify-content: space-between;
    gap: 15px;
}
.usuario-info {
    display: flex;
    align-items: center;
    gap: 12px;
}
.usuario-avatar {
    width: 46px;
    height: 46px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: linear-gradient(135deg,#dbeafe,#eff6ff);
    color: #2563eb;
    font-size: 17px;
}
.usuario-nombre {
    color: #0f172a;
    font-size: 14px;
    font-weight: 800;
}
.usuario-fecha {
    margin-top: 3px;
    color: #64748b;
    font-size: 12px;
}
.respuesta-contenido {
    margin-top: 19px;
    padding-top: 18px;
    border-top: 1px solid #f1f5f9;
    color: #475569;
    font-size: 15px;
    line-height: 1.8;
    white-space: pre-line;
    overflow-wrap: anywhere;
}
.respuesta-acciones {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-top: 18px;
    padding-top: 15px;
    border-top: 1px solid #f1f5f9;
}
.btn-eliminar {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 12px;
    border: 1px solid #fecaca;
    border-radius: 8px;
    background: #fff1f2;
    color: #b91c1c;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
}
.btn-eliminar:hover {
    background: #fee2e2;
    color: #991b1b;
}
.sin-respuestas {
    padding: 45px 25px;
    margin-bottom: 20px;
    text-align: center;
    background: white;
    border: 1px dashed #cbd5e1;
    border-radius: 17px;
}
.sin-respuestas-icon {
    width: 62px;
    height: 62px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    border-radius: 50%;
    background: #eff6ff;
    color: #2563eb;
    font-size: 25px;
}
.sin-respuestas h3 {
    margin: 0 0 7px;
    color: #0f172a;
    font-size: 19px;
}
.sin-respuestas p {
    margin: 0;
    color: #64748b;
    font-size: 14px;
}
.responder-card {
    position: relative;
    padding: 30px;
    margin-top: 30px;
    background: white;
    border: 1px solid #dbeafe;
    border-radius: 18px;
    box-shadow: 0 12px 30px rgba(37,99,235,.07);
}
.responder-header {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 20px;
}
.responder-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 13px;
    background: #eff6ff;
    color: #2563eb;
    font-size: 20px;
}
.responder-header h2 {
    margin: 0;
    color: #0f172a;
    font-size: 21px;
    font-weight: 800;
}
.responder-header p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 13px;
}
.responder-card .form-group { margin-bottom: 15px; }
.responder-card .form-control {
    width: 100%;
    min-height: 145px;
    padding: 15px 16px;
    resize: vertical;
    border: 1px solid #cbd5e1;
    border-radius: 11px;
    color: #334155;
    font-size: 15px;
    line-height: 1.6;
    box-shadow: none;
    transition: all .2s ease;
}
.responder-card .form-control::placeholder { color: #64748b; }
.responder-card .form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37,99,235,.10);
}
.responder-card .help-block {
    color: #dc2626;
    font-size: 13px;
}
.btn-responder {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 13px 22px;
    border: none;
    border-radius: 10px;
    background: #2563eb;
    color: white;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    transition: all .25s ease;
    box-shadow: 0 8px 18px rgba(37,99,235,.20);
}
.btn-responder:hover {
    background: #1d4ed8;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(37,99,235,.28);
}
@media (max-width: 768px) {
    .debate-page { padding: 30px 15px 60px; }
    .debate-header { padding: 30px 24px; }
    .debate-header h1 { font-size: 26px; }
    .debate-content { padding: 25px; }
    .respuesta-card { padding: 20px; }
    .responder-card { padding: 23px; }
    .respuestas-title { align-items: flex-start; }
}
CSS);
?>

<div class="debate-page">
    <div class="debate-container">

        <?= Html::a(
            '<i class="fa-solid fa-arrow-left"></i> Volver al foro',
            ['/foro/index'],
            ['class' => 'btn-volver', 'encode' => false]
        ) ?>

        <?php foreach (Yii::$app->session->getAllFlashes() as $tipo => $mensajes): ?>
            <?php foreach ((array) $mensajes as $mensaje): ?>
                <?php
                $clasesAlert = [
                    'success' => 'success',
                    'error' => 'danger',
                    'warning' => 'warning',
                    'info' => 'info',
                ];
                $clase = $clasesAlert[$tipo] ?? 'info';
                ?>
                <div class="alert alert-<?= $clase ?> alert-dismissible fade show" role="alert">
                    <?= Html::encode($mensaje) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>

        <div class="debate-header">
            <span class="debate-label">
                <i class="fa-solid fa-comments"></i>
                DEBATE
            </span>

            <h1><?= Html::encode($foro->titulo) ?></h1>

            <div class="debate-meta">
                <span>
                    <i class="fa-solid fa-user"></i>
                    <?= Html::encode(
                        $foro->usuario->nombre
                        ?? $foro->usuario->username
                        ?? 'Usuario'
                    ) ?>
                </span>

                <span>
                    <i class="fa-regular fa-calendar"></i>
                    <?= Yii::$app->formatter->asDatetime(
                        $foro->fecha_creacion,
                        'php:d/m/Y H:i'
                    ) ?>
                </span>
            </div>
        </div>

        <div class="debate-content">
            <div class="debate-content-label">
                <i class="fa-solid fa-align-left"></i>
                CONTENIDO DEL DEBATE
            </div>

            <p><?= nl2br(Html::encode($foro->contenido)) ?></p>
        </div>

        <div class="respuestas-title">
            <h2>
                <i class="fa-solid fa-comments"></i>
                Respuestas
                <span class="respuestas-count"><?= count($respuestas) ?></span>
            </h2>
        </div>

        <?php if (!empty($respuestas)): ?>

            <?php foreach ($respuestas as $item): ?>
                <div class="respuesta-card">

                    <div class="respuesta-top">
                        <div class="usuario-info">
                            <div class="usuario-avatar">
                                <i class="fa-solid fa-user"></i>
                            </div>

                            <div>
                                <div class="usuario-nombre">
                                    <?= Html::encode(
                                        $item->usuario->nombre
                                        ?? $item->usuario->username
                                        ?? 'Usuario'
                                    ) ?>
                                </div>

                                <div class="usuario-fecha">
                                    <i class="fa-regular fa-clock"></i>
                                    <?= Yii::$app->formatter->asDatetime(
                                        $item->fecha_creacion,
                                        'php:d/m/Y H:i'
                                    ) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="respuesta-contenido">
                        <?= nl2br(Html::encode($item->contenido)) ?>
                    </div>

                    <?php
                    $esAdmin = !Yii::$app->user->isGuest
                        && Yii::$app->user->identity->role === 'admin';

                    $esPropietario = !Yii::$app->user->isGuest
                        && (int) $item->usuario_id === (int) Yii::$app->user->id;
                    ?>

                    <?php if ($esAdmin || $esPropietario): ?>
                        <div class="respuesta-acciones">
                            <?= Html::beginForm(
                                ['/foro/delete-reply', 'id' => $item->id],
                                'post',
                                [
                                    'onsubmit' => "return confirm('¿Estás seguro de que deseas eliminar esta respuesta?');",
                                    'style' => 'display:inline;',
                                ]
                            ) ?>

                            <?= Html::submitButton(
                                '<i class="fa-solid fa-trash"></i> Eliminar respuesta',
                                [
                                    'class' => 'btn-eliminar',
                                    'encode' => false,
                                ]
                            ) ?>

                            <?= Html::endForm() ?>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>

        <?php else: ?>

            <div class="sin-respuestas">
                <div class="sin-respuestas-icon">
                    <i class="fa-regular fa-comments"></i>
                </div>

                <h3>Todavía no hay respuestas</h3>
                <p>Sé el primero en participar en esta conversación.</p>
            </div>

        <?php endif; ?>

        <div class="responder-card">
            <div class="responder-header">
                <div class="responder-icon">
                    <i class="fa-solid fa-reply"></i>
                </div>

                <div>
                    <h2>Escribe una respuesta</h2>
                    <p>Comparte tu opinión y participa en el debate.</p>
                </div>
            </div>

            <?php if (!Yii::$app->user->isGuest): ?>

                <?php $form = ActiveForm::begin([
                    'action' => Url::to([
                        '/foro/reply',
                        'foro_id' => $foro->id,
                    ]),
                    'method' => 'post',
                    'id' => 'form-respuesta',
                    'enableClientValidation' => true,
                ]); ?>

                <?= $form->field($respuesta, 'contenido')->textarea([
                    'rows' => 5,
                    'placeholder' => 'Escribe tu opinión o respuesta...',
                    'maxlength' => true,
                ])->label(false) ?>

                <?= Html::submitButton(
                    '<i class="fa-solid fa-paper-plane"></i> Publicar respuesta',
                    [
                        'class' => 'btn-responder',
                        'encode' => false,
                    ]
                ) ?>

                <?php ActiveForm::end(); ?>

            <?php else: ?>

                <p>Debes iniciar sesión para responder en este debate.</p>

                <?= Html::a(
                    '<i class="fa-solid fa-right-to-bracket"></i> Iniciar sesión',
                    ['/site/login'],
                    [
                        'class' => 'btn-responder',
                        'encode' => false,
                    ]
                ) ?>

            <?php endif; ?>
        </div>

    </div>
</div>
