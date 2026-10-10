<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class ChatController extends Controller
{
    /**
     * Vista del chatbot.
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * Procesar pregunta del usuario.
     */
    public function actionAsk(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {

            $message = trim(
                (string) Yii::$app->request->post('message', '')
            );

            if ($message === '') {

                return [
                    'success' => false,
                    'message' => 'Escribe una pregunta.',
                ];
            }

            if (mb_strlen($message) > 2000) {

                return [
                    'success' => false,
                    'message' => 'La pregunta es demasiado larga.',
                ];
            }


            /*
             * API KEY
             */
            $apiKey = getenv('OPENAI_API_KEY');

if (!$apiKey) {

    return [
        'success' => false,
        'message' => 'PHP no encuentra OPENAI_API_KEY.',
    ];
}

            /*
             * Datos enviados a OpenAI.
             */
            $data = [

                'model' => 'gpt-5-mini',

                'instructions' => '
                    Eres el asistente virtual de una plataforma
                    educativa sobre el Código de Ética de la
                    Investigación Científica.

                    Tu objetivo es ayudar a estudiantes,
                    investigadores y docentes a comprender
                    la ética de la investigación científica.

                    Puedes responder preguntas sobre:

                    - Ética de la investigación científica.
                    - Integridad científica.
                    - Honestidad académica.
                    - Plagio.
                    - Fabricación de datos.
                    - Falsificación de datos.
                    - Manipulación de resultados.
                    - Autoría científica.
                    - Conflictos de intereses.
                    - Consentimiento informado.
                    - Protección de participantes.
                    - Privacidad.
                    - Confidencialidad.
                    - Protección de datos.
                    - Publicación científica responsable.
                    - Citación y referencias.
                    - Buenas prácticas de investigación.
                    - Responsabilidad del investigador.
                    - Uso ético de inteligencia artificial
                      en investigación.

                    Responde siempre en español.

                    Utiliza un lenguaje claro y educativo.

                    Cuando sea útil, proporciona ejemplos
                    relacionados con tesis y proyectos de
                    investigación.

                    No inventes artículos, leyes, reglamentos
                    o normas institucionales.

                    Si el usuario pregunta específicamente
                    qué establece un determinado artículo
                    de un código y no tienes ese documento,
                    indícalo claramente.

                    No presentes una explicación general
                    como si fuera una norma institucional.

                    No solicites contraseñas ni claves API.
                ',

                'input' => $message,
            ];


            /*
             * Conexión con OpenAI.
             */
            $ch = curl_init(
                'https://api.openai.com/v1/responses'
            );


            curl_setopt_array($ch, [

                CURLOPT_RETURNTRANSFER => true,

                CURLOPT_POST => true,

                CURLOPT_HTTPHEADER => [

                    'Content-Type: application/json',

                    'Authorization: Bearer ' . $apiKey,

                ],

                CURLOPT_POSTFIELDS => json_encode(
                    $data,
                    JSON_UNESCAPED_UNICODE
                ),

                CURLOPT_TIMEOUT => 60,

            ]);


            $response = curl_exec($ch);

            $httpCode = curl_getinfo(
                $ch,
                CURLINFO_HTTP_CODE
            );

            $curlError = curl_error($ch);

            curl_close($ch);


            /*
             * Error CURL.
             */
            if ($response === false) {

                Yii::error(
                    'CURL ERROR: ' . $curlError
                );

                return [
                    'success' => false,
                    'message' =>
                        'Error de conexión con OpenAI: '
                        . $curlError,
                ];
            }


            /*
             * Convertir JSON.
             */
            $result = json_decode(
                $response,
                true
            );


            /*
             * Error HTTP de OpenAI.
             */
            if (
                $httpCode < 200 ||
                $httpCode >= 300
            ) {

                Yii::error(
                    'OPENAI HTTP ' .
                    $httpCode .
                    ': ' .
                    $response
                );


                $errorMessage =
                    $result['error']['message']
                    ?? 'OpenAI rechazó la solicitud.';


                return [
                    'success' => false,
                    'message' =>
                        'OpenAI: ' .
                        $errorMessage,
                ];
            }


            /*
             * Obtener texto.
             */
            $answer =
                $result['output_text']
                ?? null;


            /*
             * Buscar manualmente
             * si output_text no existe.
             */
            if (
                !$answer &&
                isset($result['output'])
            ) {

                foreach (
                    $result['output']
                    as $output
                ) {

                    if (
                        !isset(
                            $output['content']
                        )
                    ) {
                        continue;
                    }


                    foreach (
                        $output['content']
                        as $content
                    ) {

                        if (
                            isset(
                                $content['type']
                            ) &&
                            $content['type'] ===
                                'output_text' &&
                            isset(
                                $content['text']
                            )
                        ) {

                            $answer =
                                $content['text'];

                            break 2;
                        }
                    }
                }
            }


            if (!$answer) {

                Yii::error(
                    'OpenAI no devolvió texto: '
                    . $response
                );

                return [
                    'success' => false,
                    'message' =>
                        'La IA no devolvió una respuesta.',
                ];
            }


            return [
                'success' => true,
                'answer' => trim($answer),
            ];


        } catch (\Throwable $e) {

            Yii::error(
                'CHATBOT ERROR: ' .
                $e->getMessage()
            );

            return [
                'success' => false,
                'message' =>
                    'Error interno del servidor: ' .
                    $e->getMessage(),
            ];
        }
    }
}
