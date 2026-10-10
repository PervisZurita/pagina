<?php

use yii\helpers\Html;

$this->title = 'Respuesta';

$this->registerCss(<<<'CSS'

.respuesta-view {
    max-width: 850px;
    margin: 50px auto;
    padding: 0 20px;
}

.respuesta-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 35px;
    box-shadow: 0 12px 30px rgba(15,23,42,.08);
}

.usuario {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 25px;
}

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #dbeafe;
    color: #2563eb;

    display: flex;
    align-items: center;
    justify-content: center;
}

.nombre {
    font-weight: 700;
    color: #0f172a;
}

.fecha {
    color: #94a3b8;
    font-size: 13px;
}

.contenido {
    color: #475569;
    line-height: 1.8;
    white-space: pre-line;
}

.btn-volver {
    display: inline-block;
    margin-top: 25px;
    color: #2563eb;
    text-decoration: none;
    font-weight: 700;
}

CSS);
?>

<div class="respuesta-view">

    <div class="respuesta-card">

        <div class="usuario">

            <div class="avatar">
                <i class="fa-solid fa-user"></i>
            </div>

            <div>

                <div class="nombre">
                    <?= Html::encode(
                        $model->usuario->nombre
                        ?? $model->usuario->username
                        ?? 'Usuario'
                    ) ?>
                </div>

                <div class="fecha">

                    <?= Yii::$app->formatter->asDatetime(
                        $model->fecha_creacion,
                        'php:d/m/Y H:i'
                    ) ?>

                </div>

            </div>

        </div>


        <div class="contenido">

            <?= Html::encode(
                $model->contenido
            ) ?>

        </div>


        <?= Html::a(
            '<i class="fa-solid fa-arrow-left"></i> Volver al debate',
            [
                '/foro/view',
                'id' => $model->foro_id
            ],
            [
                'class' => 'btn-volver'
            ]
        ) ?>

    </div>

</div>
