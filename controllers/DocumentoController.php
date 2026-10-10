<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use app\models\Documento;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

class DocumentoController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => ['@'],
                        'matchCallback' => static function (): bool {
                            return Yii::$app->user->identity->role === 'admin';
                        },
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $documentos = Documento::find()
            ->orderBy(['fecha_creacion' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'documentos' => $documentos,
        ]);
    }

    public function actionCreate()
    {
        $model = new Documento();

        if ($model->load(Yii::$app->request->post())) {
            $archivo = UploadedFile::getInstance($model, 'archivo');

            if ($archivo !== null) {
                if (strtolower($archivo->extension) !== 'pdf') {
                    $model->addError('archivo', 'Solo se permiten archivos PDF.');
                } elseif ($archivo->size > 10 * 1024 * 1024) {
                    $model->addError('archivo', 'El archivo no puede superar 10 MB.');
                } else {
                    $directorio = Yii::getAlias('@webroot/documentos');

                    if (!is_dir($directorio)) {
                        mkdir($directorio, 0755, true);
                    }

                    $nombreArchivo = Yii::$app->security->generateRandomString(24)
                        . '.pdf';

                    if ($archivo->saveAs($directorio . DIRECTORY_SEPARATOR . $nombreArchivo)) {
                        $model->archivo = $nombreArchivo;

                        if ($model->save(false)) {
                            Yii::$app->session->setFlash(
                                'success',
                                'Documento agregado correctamente.'
                            );

                            return $this->redirect(['index']);
                        }

                        @unlink($directorio . DIRECTORY_SEPARATOR . $nombreArchivo);
                    } else {
                        $model->addError('archivo', 'No se pudo guardar el archivo.');
                    }
                }
            } else {
                $model->addError('archivo', 'Selecciona un archivo PDF.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $archivoAnterior = $model->archivo;

        if ($model->load(Yii::$app->request->post())) {
            $archivo = UploadedFile::getInstance($model, 'archivo');

            if ($archivo !== null) {
                if (strtolower($archivo->extension) !== 'pdf') {
                    $model->addError('archivo', 'Solo se permiten archivos PDF.');
                } elseif ($archivo->size > 10 * 1024 * 1024) {
                    $model->addError('archivo', 'El archivo no puede superar 10 MB.');
                } else {
                    $directorio = Yii::getAlias('@webroot/documentos');

                    if (!is_dir($directorio)) {
                        mkdir($directorio, 0755, true);
                    }

                    $nombreArchivo = Yii::$app->security->generateRandomString(24)
                        . '.pdf';

                    if ($archivo->saveAs($directorio . DIRECTORY_SEPARATOR . $nombreArchivo)) {
                        $model->archivo = $nombreArchivo;

                        if ($model->save()) {
                            $rutaAnterior = $directorio . DIRECTORY_SEPARATOR
                                . $archivoAnterior;

                            if (is_file($rutaAnterior)) {
                                @unlink($rutaAnterior);
                            }

                            Yii::$app->session->setFlash(
                                'success',
                                'Documento actualizado correctamente.'
                            );

                            return $this->redirect(['index']);
                        }

                        @unlink($directorio . DIRECTORY_SEPARATOR . $nombreArchivo);
                        $model->archivo = $archivoAnterior;
                    } else {
                        $model->addError('archivo', 'No se pudo guardar el archivo.');
                    }
                }
            } else {
                $model->archivo = $archivoAnterior;

                if ($model->save()) {
                    Yii::$app->session->setFlash(
                        'success',
                        'Documento actualizado correctamente.'
                    );

                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete(int $id)
    {
        $model = $this->findModel($id);
        $ruta = Yii::getAlias('@webroot/documentos/')
            . $model->archivo;

        if ($model->delete() !== false) {
            if (is_file($ruta)) {
                @unlink($ruta);
            }

            Yii::$app->session->setFlash(
                'success',
                'Documento eliminado correctamente.'
            );
        }

        return $this->redirect(['index']);
    }

    protected function findModel(int $id): Documento
    {
        $model = Documento::findOne($id);

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('El documento solicitado no existe.');
    }
}
