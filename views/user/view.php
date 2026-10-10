<?php

declare(strict_types=1);

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;



$this->registerCss(<<<'CSS'

.user-view {
    width: 100%;
    padding: 30px 10px 50px;
    box-sizing: border-box;
}

/* ENCABEZADO */

.user-view-header {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
    padding: 30px;
    background: linear-gradient(135deg, #0f172a, #1e3a8a);
    border-radius: 18px;
    color: #ffffff;
    box-shadow: 0 12px 35px rgba(15, 23, 42, .18);
    box-sizing: border-box;
}

.user-view-header-content {
    display: flex;
    align-items: center;
    gap: 18px;
}

.user-view-header-icon {
    width: 65px;
    height: 65px;
    flex: 0 0 65px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    background: rgba(255, 255, 255, .15);
    color: #ffffff;
    font-size: 28px;
}

.user-view-header h1 {
    margin: 0 0 7px;
    color: #ffffff;
    font-size: 28px;
    font-weight: 700;
}

.user-view-header p {
    margin: 0;
    color: #dbeafe;
    font-size: 14px;
}

/* BOTONES SUPERIORES */

.user-view-header-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-user-back,
.btn-user-edit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    padding: 11px 17px;
    border-radius: 10px;
    text-decoration: none !important;
    font-size: 14px;
    font-weight: 600;
    transition: all .25s ease;
    white-space: nowrap;
}

.btn-user-back {
    color: #ffffff !important;
    background: rgba(255, 255, 255, .12);
    border: 1px solid rgba(255, 255, 255, .25);
}

.btn-user-back:hover {
    background: #ffffff;
    color: #1e3a8a !important;
    transform: translateY(-2px);
}

.btn-user-edit {
    color: #ffffff !important;
    background: #2563eb;
    border: 1px solid #60a5fa;
}

.btn-user-edit:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
}

/* TARJETA */

.user-view-card {
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    box-shadow: 0 8px 30px rgba(15, 23, 42, .07);
    overflow: hidden;
    box-sizing: border-box;
}

/* CABECERA DE TARJETA */

.user-view-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 22px 30px;
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
}

.user-view-card-header-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: #dbeafe;
    color: #2563eb;
    font-size: 18px;
}

.user-view-card-header h2 {
    margin: 0 0 4px;
    color: #0f172a;
    font-size: 17px;
    font-weight: 700;
}

.user-view-card-header p {
    margin: 0;
    color: #64748b;
    font-size: 13px;
}

/* CUERPO */

.user-view-body {
    padding: 35px;
    box-sizing: border-box;
}

/* DETALLES */

.user-detail-table {
    width: 100%;
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
}

.user-detail-table th,
.user-detail-table td {
    padding: 19px 22px !important;
    vertical-align: middle !important;
    border-bottom: 1px solid #e8edf4 !important;
    font-size: 14px;
}

.user-detail-table th {
    width: 32%;
    background: #f8fafc;
    color: #334155;
    font-weight: 700;
}

.user-detail-table td {
    background: #ffffff;
    color: #475569;
    overflow-wrap: anywhere;
}

.user-detail-table tr:last-child th,
.user-detail-table tr:last-child td {
    border-bottom: none !important;
}

.user-detail-table tr:hover td {
    background: #f8fbff;
}

.user-detail-table th i {
    width: 22px;
    margin-right: 8px;
    color: #2563eb;
    text-align: center;
}

/* IDENTIFICADOR */

.user-id-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 42px;
    padding: 6px 12px;
    border-radius: 8px;
    background: #eff6ff;
    color: #1d4ed8;
    font-weight: 700;
}

/* ROL */

.user-role-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 13px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
}

.user-role-admin {
    color: #6d28d9;
    background: #f3e8ff;
}

.user-role-normal {
    color: #047857;
    background: #d1fae5;
}

/* ACCIONES INFERIORES */

.user-view-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 28px;
    padding-top: 25px;
    border-top: 1px solid #e5e7eb;
}

.btn-user-delete {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-width: 150px;
    height: 46px;
    padding: 0 20px;
    border: none;
    border-radius: 9px;
    background: #fee2e2;
    color: #b91c1c;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s ease;
}

.btn-user-delete:hover {
    background: #dc2626;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 7px 18px rgba(220, 38, 38, .18);
}

/* RESPONSIVE */

@media (max-width: 768px) {
    .user-view {
        padding: 20px 5px 40px;
    }

    .user-view-header {
        flex-direction: column;
        align-items: flex-start;
        padding: 22px;
    }

    .user-view-header-content {
        width: 100%;
    }

    .user-view-header h1 {
        font-size: 23px;
    }

    .user-view-header-actions {
        width: 100%;
    }

    .btn-user-back,
    .btn-user-edit {
        flex: 1;
    }

    .user-view-body {
        padding: 20px;
    }

    .user-detail-table th,
    .user-detail-table td {
        padding: 15px 12px !important;
        font-size: 13px;
    }

    .user-detail-table th {
        width: 42%;
    }

    .user-view-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .btn-user-delete {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .user-view-header-content {
        gap: 12px;
    }

    .user-view-header-icon {
        width: 54px;
        height: 54px;
        flex-basis: 54px;
        font-size: 22px;
    }

    .user-view-header h1 {
        font-size: 20px;
    }

    .user-view-header-actions {
        flex-direction: column;
    }

    .btn-user-back,
    .btn-user-edit {
        width: 100%;
        flex: auto;
    }

    .user-view-body {
        padding: 14px;
    }

    .user-detail-table th,
    .user-detail-table td {
        padding: 13px 9px !important;
        font-size: 12px;
    }

    .user-detail-table th {
        width: 44%;
    }

    .user-detail-table th i {
        width: 16px;
        margin-right: 4px;
    }
}

CSS);

$esAdmin = $model->role === 'admin';

?>

<div class="user-view">

    <div class="user-view-header">

        <div class="user-view-header-content">

            <div class="user-view-header-icon">
                <i class="fa-solid fa-user"></i>
            </div>

            <div>
                <h1><?= Html::encode($model->username) ?></h1>
                <p>Información detallada de la cuenta de usuario.</p>
            </div>

        </div>

        <div class="user-view-header-actions">

            <?= Html::a(
                '<i class="fa-solid fa-arrow-left"></i> Volver',
                ['index'],
                ['class' => 'btn-user-back']
            ) ?>

            <?= Html::a(
                '<i class="fa-solid fa-pen-to-square"></i> Editar usuario',
                ['update', 'id' => $model->id],
                ['class' => 'btn-user-edit']
            ) ?>

        </div>

    </div>

    <div class="user-view-card">

        <div class="user-view-card-header">

            <div class="user-view-card-header-icon">
                <i class="fa-solid fa-address-card"></i>
            </div>

            <div>
                <h2>Información del usuario</h2>
                <p>Datos registrados en el sistema.</p>
            </div>

        </div>

        <div class="user-view-body">

            <?= DetailView::widget([
                'model' => $model,
                'options' => [
                    'class' => 'table user-detail-table',
                ],
                'attributes' => [
                    [
                        'attribute' => 'id',
                        'label' => 'Identificador',
                        'format' => 'raw',
                        'value' => static function ($model) {
                            return '<span class="user-id-badge">'
                                . Html::encode((string) $model->id)
                                . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'username',
                        'label' => 'Nombre de usuario',
                        'format' => 'raw',
                        'value' => static function ($model) {
                            return '<i class="fa-solid fa-user" style="color:#2563eb;margin-right:8px"></i>'
                                . Html::encode($model->username);
                        },
                    ],
                    [
                        'attribute' => 'auth_key',
                        'label' => 'Clave de autenticación',
                        'format' => 'text',
                        'value' => 'Protegida',
                    ],
                    [
                        'attribute' => 'access_token',
                        'label' => 'Token de acceso',
                        'format' => 'text',
                        'value' => 'Protegido',
                    ],
                    [
                        'attribute' => 'role',
                        'label' => 'Rol asignado',
                        'format' => 'raw',
                        'value' => static function ($model) {
                            $esAdmin = $model->role === 'admin';

                            return $esAdmin
                                ? '<span class="user-role-badge user-role-admin"><i class="fa-solid fa-user-shield"></i> Administrador</span>'
                                : '<span class="user-role-badge user-role-normal"><i class="fa-solid fa-user-check"></i> Usuario</span>';
                        },
                    ],
                ],
            ]) ?>

            <div class="user-view-actions">

                <?= Html::a(
                    '<i class="fa-solid fa-trash-can"></i> Eliminar usuario',
                    ['delete', 'id' => $model->id],
                    [
                        'class' => 'btn-user-delete',
                        'data' => [
                            'confirm' => '¿Estás seguro de que deseas eliminar este usuario?',
                            'method' => 'post',
                        ],
                    ]
                ) ?>

            </div>

        </div>

    </div>

</div>
