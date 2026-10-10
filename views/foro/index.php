<?php

use yii\helpers\Html;

$this->title = 'Foro de Debate';

$this->registerCss(<<<'CSS'

.foro-page {
    width: 100%;
    min-height: 100vh;
    background: #f8fafc;
    padding: 50px 30px 80px;
}

.foro-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

/* ENCABEZADO */

.foro-header {
    background: linear-gradient(135deg, #0f172a, #1e3a8a);
    border-radius: 20px;
    padding: 45px;
    color: white;
    margin-bottom: 30px;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .15);

    display: flex;
    align-items: center;
    gap: 25px;
}

.foro-header-icon {
    width: 75px;
    height: 75px;
    min-width: 75px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.2);
    border-radius: 18px;

    font-size: 32px;
}

.foro-header h1 {
    margin: 5px 0 8px;
    font-size: 34px;
    font-weight: 800;
}

.foro-header p {
    margin: 0;
    color: #dbeafe;
    font-size: 16px;
}

.foro-label {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.5px;
    color: #93c5fd;
}

/* BOTÓN */

.foro-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.foro-top h2 {
    margin: 0;
    color: #0f172a;
    font-size: 24px;
}

.btn-nuevo {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    padding: 13px 20px;

    background: #2563eb;
    color: white;

    border-radius: 10px;
    text-decoration: none;
    font-weight: 700;

    transition: .2s ease;
}

.btn-nuevo:hover {
    background: #1d4ed8;
    color: white;
    transform: translateY(-2px);
}

/* DEBATES */

.foro-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 16px;

    padding: 25px;
    margin-bottom: 18px;

    box-shadow: 0 8px 25px rgba(15, 23, 42, .06);

    transition: .2s ease;
}

.foro-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(15, 23, 42, .10);
}

.foro-card-top {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.foro-card h3 {
    margin: 0 0 10px;
    font-size: 21px;
}

.foro-card h3 a {
    color: #0f172a;
    text-decoration: none;
}

.foro-card h3 a:hover {
    color: #2563eb;
}

.foro-contenido {
    color: #64748b;
    line-height: 1.7;
    margin-bottom: 18px;

    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.foro-meta {
    display: flex;
    align-items: center;
    gap: 18px;

    color: #64748b;
    font-size: 14px;
}

.foro-meta span {
    display: inline-flex;
    align-items: center;
    gap: 7px;
}

.foro-meta i {
    color: #2563eb;
}

/* VER */

.btn-ver {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    padding: 9px 15px;

    border-radius: 9px;

    background: #eff6ff;
    color: #2563eb;

    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
}

.btn-ver:hover {
    background: #dbeafe;
    color: #1d4ed8;
}

/* VACÍO */

.foro-empty {
    background: white;
    border: 2px dashed #cbd5e1;
    border-radius: 18px;

    padding: 70px 30px;
    text-align: center;
}

.foro-empty i {
    font-size: 50px;
    color: #94a3b8;
    margin-bottom: 20px;
}

.foro-empty h3 {
    margin: 0 0 10px;
    color: #0f172a;
}

.foro-empty p {
    color: #64748b;
    margin-bottom: 25px;
}

/* RESPONSIVE */

@media (max-width: 768px) {

    .foro-page {
        padding: 30px 15px 60px;
    }

    .foro-header {
        padding: 30px 25px;
        flex-direction: column;
        text-align: center;
    }

    .foro-header h1 {
        font-size: 27px;
    }

    .foro-top {
        flex-direction: column;
        align-items: stretch;
        gap: 15px;
    }

    .btn-nuevo {
        justify-content: center;
    }

    .foro-card-top {
        flex-direction: column;
    }

}

CSS);
?>

<div class="foro-page">

    <div class="foro-container">

        <!-- ENCABEZADO -->

        <div class="foro-header">

            <div class="foro-header-icon">
                <i class="fa-solid fa-comments"></i>
            </div>

            <div>

                <span class="foro-label">
                    COMUNIDAD DE INVESTIGACIÓN
                </span>

                <h1>
                    Foro de Debate
                </h1>

                <p>
                    Comparte ideas, opiniones y reflexiones sobre
                    la ética de la investigación científica.
                </p>

            </div>

        </div>


        <!-- TÍTULO + BOTÓN -->

        <div class="foro-top">

            <h2>
                Debates recientes
            </h2>

            <?= Html::a(
                '<i class="fa-solid fa-plus"></i> Nuevo debate',
                ['create'],
                [
                    'class' => 'btn-nuevo'
                ]
            ) ?>

        </div>


        <!-- LISTA DE DEBATES -->

        <?php if (!empty($foros)): ?>

            <?php foreach ($foros as $foro): ?>

                <div class="foro-card">

                    <div class="foro-card-top">

                        <div style="flex: 1;">

                            <h3>

                                <?= Html::a(
                                    Html::encode($foro->titulo),
                                    ['view', 'id' => $foro->id]
                                ) ?>

                            </h3>

                            <div class="foro-contenido">

                                <?= Html::encode(
                                    $foro->contenido
                                ) ?>

                            </div>

                            <div class="foro-meta">

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


                        <div>

                            <?= Html::a(
                                '<i class="fa-solid fa-arrow-right"></i> Ver debate',
                                ['view', 'id' => $foro->id],
                                [
                                    'class' => 'btn-ver'
                                ]
                            ) ?>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="foro-empty">

                <i class="fa-regular fa-comments"></i>

                <h3>
                    Todavía no existen debates
                </h3>

                <p>
                    Sé el primero en iniciar una conversación
                    con la comunidad.
                </p>

                <?= Html::a(
                    '<i class="fa-solid fa-plus"></i> Crear primer debate',
                    ['create'],
                    [
                        'class' => 'btn-nuevo'
                    ]
                ) ?>

            </div>

        <?php endif; ?>

    </div>

</div>
