<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\filters\AccessControl;

class CuestionarioController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => [
                    'index',
                    'realizar',
                    'resultados',
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'index',
                            'realizar',
                            'resultados',
                        ],
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
        ];
    }
    public function actionResultado()
{
    return $this->render('resultado');
}

public function actionEstadisticas()
{
    $db = Yii::$app->db;

    $resumen = $db->createCommand("
        SELECT
            COUNT(*) AS total_intentos,
            COUNT(DISTINCT usuario_id) AS total_usuarios,
            COALESCE(AVG(puntuacion), 0) AS promedio_puntuacion,
            COALESCE(AVG(respuestas_correctas), 0) AS promedio_correctas
        FROM cuestionario_resultados
    ")->queryOne();

    $estadisticasPreguntas = $db->createCommand("
        SELECT
            pregunta_id,
            COUNT(*) AS total_respuestas,
            SUM(es_correcta = 1) AS correctas,
            SUM(es_correcta = 0) AS incorrectas,
            ROUND(AVG(es_correcta) * 100, 2) AS porcentaje_aciertos
        FROM cuestionario_respuestas
        GROUP BY pregunta_id
        ORDER BY pregunta_id ASC
    ")->queryAll();

    $historial = $db->createCommand("
        SELECT
            DATE(fecha_realizacion) AS fecha,
            COUNT(*) AS intentos,
            ROUND(AVG(puntuacion), 2) AS promedio
        FROM cuestionario_resultados
        GROUP BY DATE(fecha_realizacion)
        ORDER BY fecha ASC
    ")->queryAll();

    return $this->render('estadisticas', [
        'resumen' => $resumen,
        'estadisticasPreguntas' => $estadisticasPreguntas,
        'historial' => $historial,
    ]);
}


    public function actionIndex()
    {
        $preguntas = (new Query())
            ->from('cuestionario_preguntas')
            ->where(['estado' => 1])
            ->count();

        return $this->render('index', [
            'totalPreguntas' => $preguntas,
        ]);
    }

    public function actionRealizar()
    {
        $preguntas = (new Query())
            ->from('cuestionario_preguntas')
            ->where(['estado' => 1])
            ->all();

        foreach ($preguntas as &$pregunta) {
            $pregunta['opciones'] = (new Query())
                ->from('cuestionario_opciones')
                ->where(['pregunta_id' => $pregunta['id']])
                ->all();
        }
        unset($pregunta);

        if (Yii::$app->request->isPost) {
            $respuestas = Yii::$app->request->post('respuestas', []);

            if (count($preguntas) === 0) {
                Yii::$app->session->setFlash(
                    'error',
                    'No hay preguntas disponibles para evaluar.'
                );

                return $this->redirect(['index']);
            }

            $correctas = 0;
            $revision = [];

            foreach ($preguntas as $pregunta) {
                $opcionId = $respuestas[$pregunta['id']] ?? null;

                $opcion = null;

                if ($opcionId !== null && $opcionId !== '') {
                    $opcion = (new Query())
                        ->from('cuestionario_opciones')
                        ->where([
                            'id' => $opcionId,
                            'pregunta_id' => $pregunta['id'],
                        ])
                        ->one();
                }

                $esCorrecta = $opcion !== null
                    && (int) $opcion['es_correcta'] === 1;

                if ($esCorrecta) {
                    $correctas++;
                }

                $revision[] = [
                    'pregunta' => $pregunta['pregunta'],
                    'explicacion' => $pregunta['explicacion'],
                    'seleccionada' => $opcion['opcion'] ?? 'Sin responder',
                    'correcta' => (new Query())
                        ->select('opcion')
                        ->from('cuestionario_opciones')
                        ->where([
                            'pregunta_id' => $pregunta['id'],
                            'es_correcta' => 1,
                        ])
                        ->scalar(),
                    'es_correcta' => $esCorrecta,
                ];
            }

            $totalPreguntas = count($preguntas);
            $puntuacion = round(
                ($correctas / $totalPreguntas) * 100,
                2
            );

            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();

            try {
                $db->createCommand()->insert(
                    'cuestionario_resultados',
                    [
                        'usuario_id' => Yii::$app->user->isGuest
                            ? null
                            : Yii::$app->user->id,
                        'puntuacion' => $puntuacion,
                        'total_preguntas' => $totalPreguntas,
                        'respuestas_correctas' => $correctas,
                    ]
                )->execute();

                $resultadoId = $db->getLastInsertID();

                foreach ($preguntas as $pregunta) {
                    $opcionId = $respuestas[$pregunta['id']] ?? null;

                    $opcion = null;

                    if ($opcionId !== null && $opcionId !== '') {
                        $opcion = (new Query())
                            ->from('cuestionario_opciones')
                            ->where([
                                'id' => $opcionId,
                                'pregunta_id' => $pregunta['id'],
                            ])
                            ->one();
                    }

                    $db->createCommand()->insert(
                        'cuestionario_respuestas',
                        [
                            'resultado_id' => $resultadoId,
                            'pregunta_id' => $pregunta['id'],
                            'opcion_id' => $opcion['id'] ?? null,
                            'es_correcta' => (
                                $opcion !== null
                                && (int) $opcion['es_correcta'] === 1
                            ) ? 1 : 0,
                        ]
                    )->execute();
                }

                $transaction->commit();
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }

            return $this->render('resultado', [
                'correctas' => $correctas,
                'totalPreguntas' => $totalPreguntas,
                'puntuacion' => $puntuacion,
                'revision' => $revision,
            ]);
        }

        return $this->render('realizar', [
            'preguntas' => $preguntas,
        ]);
    }

    public function actionResultados()
    {
        $usuarioId = Yii::$app->user->isGuest
            ? null
            : Yii::$app->user->id;

        $resultados = (new Query())
            ->from('cuestionario_resultados')
            ->where(['usuario_id' => $usuarioId])
            ->orderBy(['fecha_realizacion' => SORT_DESC])
            ->all();

        return $this->render('resultados', [
            'resultados' => $resultados,
        ]);
    }
}
