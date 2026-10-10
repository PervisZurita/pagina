<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use app\models\Foro;
use app\models\ForoRespuesta;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class ForoController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'reply', 'delete', 'delete-reply'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'create' => ['GET', 'POST'],
                    'reply' => ['POST'],
                    'delete' => ['POST'],
                    'delete-reply' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $foros = Foro::find()
            ->with('usuario')
            ->orderBy(['fecha_creacion' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'foros' => $foros,
        ]);
    }

    public function actionView(int $id): string|Response
    {
        $foro = $this->findModel($id);

        $respuestas = ForoRespuesta::find()
            ->with('usuario')
            ->where(['foro_id' => $foro->id])
            ->orderBy(['fecha_creacion' => SORT_ASC])
            ->all();

        $respuesta = new ForoRespuesta();
        $respuesta->foro_id = $foro->id;

        return $this->render('view', [
            'foro' => $foro,
            'respuestas' => $respuestas,
            'respuesta' => $respuesta,
        ]);
    }

    public function actionCreate(): string|Response
    {
        $foro = new Foro();

        if ($foro->load(Yii::$app->request->post())) {
            $foro->usuario_id = (int) Yii::$app->user->id;

            if ($foro->save()) {
                Yii::$app->session->setFlash(
                    'success',
                    'El debate fue creado correctamente.'
                );

                return $this->redirect([
                    '/foro/view',
                    'id' => $foro->id,
                ]);
            }

            Yii::$app->session->setFlash(
                'error',
                'No se pudo crear el debate. Verifica los datos.'
            );
        }

        return $this->render('create', [
            'foro' => $foro,
        ]);
    }

    public function actionReply(int $foro_id): Response
    {
        $foro = $this->findModel($foro_id);
        $respuesta = new ForoRespuesta();

        if ($respuesta->load(Yii::$app->request->post())) {
            $respuesta->foro_id = (int) $foro->id;
            $respuesta->usuario_id = (int) Yii::$app->user->id;

            if ($respuesta->save()) {
                Yii::$app->session->setFlash(
                    'success',
                    'Tu respuesta fue publicada correctamente.'
                );
            } else {
                Yii::$app->session->setFlash(
                    'error',
                    'No se pudo publicar la respuesta. Verifica los datos.'
                );
            }
        } else {
            Yii::$app->session->setFlash(
                'error',
                'No se recibieron los datos de la respuesta.'
            );
        }

        return $this->redirect([
            '/foro/view',
            'id' => $foro->id,
        ]);
    }

    public function actionDeleteReply(int $id): Response
    {
        $respuesta = ForoRespuesta::findOne($id);

        if ($respuesta === null) {
            throw new NotFoundHttpException(
                'La respuesta solicitada no existe.'
            );
        }

        $esAdmin = Yii::$app->user->identity->role === 'admin';
        $esPropietario = (int) $respuesta->usuario_id === (int) Yii::$app->user->id;

        if (!$esAdmin && !$esPropietario) {
            throw new ForbiddenHttpException(
                'No tienes permiso para eliminar esta respuesta.'
            );
        }

        $foroId = (int) $respuesta->foro_id;

        if ($respuesta->delete() === false) {
            Yii::$app->session->setFlash(
                'error',
                'No se pudo eliminar la respuesta.'
            );
        } else {
            Yii::$app->session->setFlash(
                'success',
                'La respuesta fue eliminada correctamente.'
            );
        }

        return $this->redirect([
            '/foro/view',
            'id' => $foroId,
        ]);
    }

    public function actionDelete(int $id): Response
    {
        $foro = $this->findModel($id);

        $esAdmin = Yii::$app->user->identity->role === 'admin';
        $esPropietario = (int) $foro->usuario_id === (int) Yii::$app->user->id;

        if (!$esAdmin && !$esPropietario) {
            throw new ForbiddenHttpException(
                'No tienes permiso para eliminar este debate.'
            );
        }

        if ($foro->delete() === false) {
            Yii::$app->session->setFlash(
                'error',
                'No se pudo eliminar el debate.'
            );
        } else {
            Yii::$app->session->setFlash(
                'success',
                'El debate fue eliminado correctamente.'
            );
        }

        return $this->redirect(['/foro/index']);
    }

    protected function findModel(int $id): Foro
    {
        $foro = Foro::findOne($id);

        if ($foro !== null) {
            return $foro;
        }

        throw new NotFoundHttpException(
            'El debate solicitado no existe.'
        );
    }
}
