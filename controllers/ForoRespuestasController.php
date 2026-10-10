<?php

namespace app\controllers;

use Yii;
use app\models\Foro;
use app\models\ForoRespuesta;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

class ForoRespuestaController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => [
                    'create',
                    'view',
                    'update',
                    'delete',
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreate($foro_id)
    {
        $foro = Foro::findOne($foro_id);

        if ($foro === null) {
            throw new NotFoundHttpException(
                'El debate no existe.'
            );
        }

        $model = new ForoRespuesta();

        $model->foro_id = $foro->id;

        if ($model->load(Yii::$app->request->post())) {

            $model->foro_id = $foro->id;
            $model->usuario_id = Yii::$app->user->id;

            if ($model->save()) {

                Yii::$app->session->setFlash(
                    'success',
                    'Tu respuesta fue publicada correctamente.'
                );

                return $this->redirect([
                    '/foro/view',
                    'id' => $foro->id
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'foro' => $foro,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->usuario_id != Yii::$app->user->id) {
            throw new ForbiddenHttpException(
                'No puedes modificar esta respuesta.'
            );
        }

        if ($model->load(Yii::$app->request->post())) {

            $model->usuario_id = Yii::$app->user->id;

            if ($model->save()) {

                Yii::$app->session->setFlash(
                    'success',
                    'La respuesta fue actualizada correctamente.'
                );

                return $this->redirect([
                    '/foro/view',
                    'id' => $model->foro_id
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->usuario_id != Yii::$app->user->id) {
            throw new ForbiddenHttpException(
                'No puedes eliminar esta respuesta.'
            );
        }

        $foroId = $model->foro_id;

        $model->delete();

        Yii::$app->session->setFlash(
            'success',
            'La respuesta fue eliminada correctamente.'
        );

        return $this->redirect([
            '/foro/view',
            'id' => $foroId
        ]);
    }

    protected function findModel($id)
    {
        if (($model = ForoRespuesta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(
            'La respuesta solicitada no existe.'
        );
    }
}
