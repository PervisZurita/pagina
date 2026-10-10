<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use Throwable;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class ChatbotController extends Controller
{
    private const MAX_CARACTERES = 2000;
    private const LIMITE_SOLICITUDES = 20;
    private const VENTANA_LIMITE = 60;
    private const PUNTAJE_MINIMO = 2;

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'preguntar' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    private function normalizarTexto(string $texto): string
    {
        $texto = mb_strtolower(trim($texto), 'UTF-8');

        $normalizado = @iconv(
            'UTF-8',
            'ASCII//TRANSLIT//IGNORE',
            $texto
        );

        if (is_string($normalizado) && $normalizado !== '') {
            $texto = $normalizado;
        }

        $texto = preg_replace(
            '/[^\p{L}\p{N}\s]/u',
            ' ',
            $texto
        ) ?? $texto;

        $texto = preg_replace('/\s+/', ' ', $texto) ?? $texto;

        return trim($texto);
    }

    private function extraerPalabras(string $textoNormalizado): array
    {
        if ($textoNormalizado === '') {
            return [];
        }

        $palabras = preg_split('/\s+/u', $textoNormalizado) ?: [];

        $palabras = array_filter(
            $palabras,
            static fn (string $p): bool =>
                $p !== '' && mb_strlen($p) >= 2
        );

        return array_values(array_unique($palabras));
    }

    private function excedeLimiteSolicitudes(): bool
    {
        $ip = (string) Yii::$app->request->userIP;
        $clave = 'chatbot_fijo_' . hash('sha256', $ip);
        $cache = Yii::$app->cache;

        $solicitudes = $cache->get($clave);

        if ($solicitudes === false) {
            $cache->set($clave, 1, self::VENTANA_LIMITE);
            return false;
        }

        if ((int) $solicitudes >= self::LIMITE_SOLICITUDES) {
            return true;
        }

        $cache->set(
            $clave,
            (int) $solicitudes + 1,
            self::VENTANA_LIMITE
        );

        return false;
    }

    private function obtenerRespuesta(string $pregunta): string
    {
        $texto = $this->normalizarTexto($pregunta);
        $palabrasTexto = $this->extraerPalabras($texto);

        if ($palabrasTexto === []) {
            return $this->respuestaPorDefecto();
        }

        $respuestas = [
            [
                'palabras' => ['hola', 'buenos', 'dias', 'tardes', 'noches', 'saludos', 'hey'],
                'respuesta' => "¡Hola! Bienvenido al asistente virtual de preguntas y respuestas sobre ética en la investigación científica.\n\nPuedes consultar sobre principios éticos, derechos de los participantes, plagio, consentimiento informado, confidencialidad, publicación científica y muchos otros temas."
            ],
            [
                'palabras' => ['quien', 'eres', 'puedes', 'hacer', 'funcionas', 'funciona', 'ayuda', 'ayudar'],
                'respuesta' => "Soy un asistente virtual que funciona mediante preguntas y respuestas predeterminadas.\n\nPuedo ofrecerte información sobre ética de la investigación, integridad científica, consentimiento informado, protección de datos, autoría, comités de ética y buenas prácticas. Selecciona una pregunta conocida o escribe palabras relacionadas con el tema."
            ],
            [
                'palabras' => ['codigo', 'etica', 'objetivo', 'finalidad', 'importancia', 'sirve'],
                'respuesta' => "El Código de Ética en la Investigación Científica establece orientaciones para realizar investigaciones de forma responsable, honesta y respetuosa.\n\nSu finalidad es promover la integridad científica, proteger los derechos de las personas participantes, fomentar buenas prácticas y orientar la conducta de investigadores y colaboradores.\n\nPara conocer obligaciones institucionales concretas, debe consultarse el documento oficial correspondiente."
            ],
            [
                'palabras' => ['principios', 'eticos', 'valores', 'cuales', 'son'],
                'respuesta' => "Entre los principales principios éticos de la investigación se encuentran:\n\n1. Honestidad: comunicar información y resultados verdaderos.\n2. Integridad: actuar de acuerdo con los principios científicos y éticos.\n3. Responsabilidad: asumir las consecuencias del trabajo realizado.\n4. Respeto: proteger la dignidad y los derechos humanos.\n5. Justicia: procurar un trato equitativo.\n6. Transparencia: comunicar métodos, resultados y conflictos de intereses.\n7. Beneficencia: procurar beneficios.\n8. No maleficencia: prevenir o reducir daños.\n9. Autonomía: respetar las decisiones informadas de las personas."
            ],
            [
                'palabras' => ['integridad', 'cientifica', 'academica', 'honestidad'],
                'respuesta' => "La integridad científica consiste en desarrollar y comunicar investigaciones de manera honesta, rigurosa y responsable.\n\nImplica registrar los datos correctamente, reconocer las fuentes, describir los métodos con transparencia, evitar el fraude, respetar las contribuciones de otros investigadores y corregir errores cuando se detectan."
            ],
            [
                'palabras' => ['consentimiento', 'informado', 'voluntaria', 'voluntario', 'autorizacion'],
                'respuesta' => "El consentimiento informado es el proceso mediante el cual una persona recibe información comprensible sobre una investigación antes de decidir si participa.\n\nLa información debe incluir el objetivo del estudio, los procedimientos, los riesgos, los beneficios y las condiciones de participación. La decisión debe ser voluntaria y sin coacción.\n\nCuando corresponda, debe documentarse el consentimiento y respetarse el derecho a retirarse conforme a las condiciones aplicables."
            ],
            [
                'palabras' => ['derechos', 'participantes', 'humanos', 'dignidad', 'proteccion'],
                'respuesta' => "Las personas participantes en una investigación deben recibir un trato digno y respetuoso.\n\nEntre las consideraciones fundamentales están:\n• Recibir información suficiente sobre el estudio.\n• Decidir voluntariamente si desean participar.\n• Obtener protección de su privacidad.\n• Conocer los riesgos relevantes.\n• No ser objeto de discriminación o coacción.\n• Recibir protección frente a daños evitables.\n\nLas condiciones específicas dependen de la investigación y de las normas aplicables."
            ],
            [
                'palabras' => ['plagio', 'plagiar', 'plagios', 'copiar', 'copiado', 'evitar'],
                'respuesta' => "El plagio consiste en presentar ideas, textos, resultados o trabajos ajenos como propios sin reconocer adecuadamente su procedencia.\n\nPara evitarlo:\n1. Cita las fuentes utilizadas.\n2. Incluye las referencias bibliográficas.\n3. Identifica las citas textuales.\n4. Distingue tus ideas de las de otros autores.\n5. No presentes trabajos ajenos como propios.\n\nLa paráfrasis también requiere reconocer la fuente de las ideas."
            ],
            [
                'palabras' => ['citas', 'referencias', 'citar', 'bibliograficas', 'fuentes', 'bibliografia'],
                'respuesta' => "Las citas y referencias permiten identificar las fuentes utilizadas en una investigación.\n\nUna cita reconoce la procedencia de una idea, dato o fragmento. La referencia bibliográfica proporciona los datos necesarios para localizar la fuente.\n\nDebes utilizar el estilo de citación solicitado por tu universidad, revista o programa académico y mantener un formato consistente."
            ],
            [
                'palabras' => ['fabricacion', 'inventar', 'inventados', 'falsos', 'inventadas'],
                'respuesta' => "La fabricación de datos consiste en inventar información o resultados y presentarlos como si se hubieran obtenido realmente.\n\nEsta práctica compromete la integridad científica porque impide verificar los resultados y puede conducir a conclusiones falsas. Los datos deben proceder de procedimientos reales y documentados."
            ],
            [
                'palabras' => ['falsificacion', 'manipulacion', 'manipular', 'alterar', 'falsear', 'tergiversar'],
                'respuesta' => "La falsificación implica manipular materiales, procedimientos, datos o resultados de forma que la investigación deje de representar fielmente lo realizado.\n\nLos resultados deben comunicarse con exactitud. No es ético modificar datos para ajustarlos a una hipótesis ni ocultar información relevante de manera engañosa."
            ],
            [
                'palabras' => ['autoria', 'autor', 'autores', 'honorario', 'fantasma', 'contribuciones', 'firmar'],
                'respuesta' => "La autoría científica debe reconocer las contribuciones reales al trabajo.\n\nBuenas prácticas:\n• Acordar los criterios de autoría desde etapas tempranas.\n• Reconocer las contribuciones de cada participante.\n• No incluir autores sin aportaciones suficientes.\n• No excluir injustificadamente a colaboradores.\n• Aclarar las responsabilidades de quienes firman la publicación.\n\nLos criterios concretos deben ajustarse a las normas académicas y editoriales aplicables."
            ],
            [
                'palabras' => ['confidencialidad', 'privacidad', 'confidencial', 'reservada'],
                'respuesta' => "La confidencialidad consiste en proteger la información obtenida durante una investigación y evitar su divulgación indebida.\n\nSe recomienda limitar el acceso a personas autorizadas, almacenar los datos de forma segura, evitar identificaciones innecesarias y respetar los compromisos adquiridos con los participantes."
            ],
            [
                'palabras' => ['proteccion', 'datos', 'personales', 'anonimato', 'anonimizacion', 'anonimizar', 'seudonimizacion'],
                'respuesta' => "La protección de datos en investigación busca evitar el acceso, uso o divulgación no autorizados de información personal.\n\nBuenas prácticas:\n• Recopilar únicamente los datos necesarios.\n• Informar para qué se utilizarán.\n• Restringir los permisos de acceso.\n• Aplicar medidas de seguridad.\n• Eliminar o conservar los datos conforme a las reglas aplicables.\n• Anonimizar la información cuando sea adecuado.\n\nLa anonimización y la seudonimización no son equivalentes: los datos seudonimizados todavía pueden permitir una identificación mediante información adicional."
            ],
            [
                'palabras' => ['conflicto', 'intereses', 'interes', 'financieros', 'economico', 'personal'],
                'respuesta' => "Un conflicto de intereses ocurre cuando intereses personales, económicos, profesionales o institucionales pueden influir, o parecer influir, en las decisiones de una investigación.\n\nPara gestionarlo, es importante identificarlo, declararlo cuando corresponda y seguir los procedimientos establecidos. Su existencia no demuestra automáticamente una falta ética, pero debe manejarse de forma transparente."
            ],
            [
                'palabras' => ['comite', 'comites', 'bioetica', 'evaluacion', 'aprobacion', 'revision'],
                'respuesta' => "Los comités de ética competentes pueden revisar proyectos de investigación para evaluar aspectos relacionados con los participantes, los riesgos, los beneficios, el consentimiento informado y la protección de datos.\n\nAntes de iniciar un estudio, verifica si necesita revisión y aprobación previa. Los requisitos dependen del tipo de investigación y de las normas institucionales aplicables."
            ],
            [
                'palabras' => ['riesgos', 'riesgo', 'danos', 'dano', 'minimo', 'peligros'],
                'respuesta' => "La evaluación de riesgos busca identificar posibles daños físicos, psicológicos, sociales, económicos o relacionados con la privacidad.\n\nEl equipo investigador debe valorar los riesgos previsibles, adoptar medidas para reducirlos, informar adecuadamente a los participantes y establecer procedimientos para responder ante incidentes. La clasificación del riesgo debe seguir los criterios aplicables al proyecto."
            ],
            [
                'palabras' => ['beneficios', 'beneficio', 'social', 'ventajas'],
                'respuesta' => "Los beneficios de una investigación pueden ser directos para los participantes o indirectos para la sociedad, la comunidad científica o el conocimiento.\n\nLos beneficios esperados deben describirse con honestidad. No se deben prometer resultados terapéuticos, económicos o personales que no estén garantizados."
            ],
            [
                'palabras' => ['justicia', 'seleccion', 'discriminacion', 'equidad', 'equitativa'],
                'respuesta' => "La justicia en investigación exige una selección equitativa de participantes y una distribución razonable de las cargas y beneficios del estudio.\n\nLos criterios de inclusión y exclusión deben estar justificados científicamente. No se debe discriminar injustificadamente ni aprovecharse de la vulnerabilidad de una persona o comunidad."
            ],
            [
                'palabras' => ['vulnerables', 'vulnerable', 'menores', 'ninos', 'infancia', 'discapacidad'],
                'respuesta' => "Cuando una investigación involucra personas en situación de vulnerabilidad, pueden ser necesarias protecciones adicionales.\n\nDeben considerarse su capacidad para decidir, las posibles presiones, los riesgos y las salvaguardas pertinentes. En estudios con menores de edad, se deben cumplir los requisitos aplicables de autorización de representantes y participación o asentimiento del menor, cuando corresponda."
            ],
            [
                'palabras' => ['animales', 'animal', 'experimentacion', 'bienestar', 'veterinaria'],
                'respuesta' => "La investigación con animales debe cumplir las normas éticas y legales aplicables y considerar su bienestar.\n\nEntre las buenas prácticas están justificar su utilización, considerar alternativas, reducir el número de animales cuando sea posible, perfeccionar los procedimientos para minimizar el sufrimiento y obtener las autorizaciones requeridas."
            ],
            [
                'palabras' => ['publicacion', 'publicar', 'duplicada', 'negativos', 'revista'],
                'respuesta' => "La publicación científica responsable requiere comunicar resultados de manera honesta, clara y verificable.\n\nBuenas prácticas:\n• Describir los métodos con precisión.\n• Informar los resultados de forma fiel.\n• Reconocer las fuentes y contribuciones.\n• Declarar conflictos de intereses relevantes.\n• Evitar publicaciones duplicadas indebidas.\n• Corregir errores importantes cuando se detecten.\n\nLos resultados negativos también pueden ser importantes para el conocimiento científico."
            ],
            [
                'palabras' => ['propiedad', 'intelectual', 'derechos', 'imagenes', 'material', 'licencias'],
                'respuesta' => "La propiedad intelectual protege determinadas creaciones y reconoce los derechos de sus autores o titulares.\n\nEn una investigación, debes respetar las licencias y condiciones de uso de textos, imágenes, instrumentos, bases de datos y otros materiales. Citar una fuente no siempre sustituye la autorización necesaria para reproducir material protegido."
            ],
            [
                'palabras' => ['gestion', 'almacenamiento', 'almacenar', 'conservar', 'conservacion', 'respaldo'],
                'respuesta' => "La gestión responsable de datos comprende su recopilación, organización, almacenamiento, análisis, protección y conservación.\n\nEs recomendable mantener registros fiables, documentar los métodos de análisis, crear copias de seguridad, restringir el acceso a información sensible y establecer reglas para compartir o conservar los datos conforme a los requisitos del proyecto."
            ],
            [
                'palabras' => ['metodologia', 'metodos', 'metodo', 'rigor', 'reproducibilidad', 'reproducible'],
                'respuesta' => "Una metodología rigurosa debe ser adecuada a la pregunta de investigación y estar documentada con suficiente claridad.\n\nEl equipo investigador debe explicar los procedimientos, justificar las decisiones metodológicas, registrar cambios relevantes y evitar presentar conclusiones que excedan lo que permiten los datos. La transparencia facilita la evaluación y, cuando sea posible, la reproducción de los resultados."
            ],
            [
                'palabras' => ['responsable', 'responsabilidades', 'deberes', 'obligaciones', 'investigador', 'investigadores'],
                'respuesta' => "Las responsabilidades de quienes investigan incluyen:\n\n• Actuar con honestidad e integridad.\n• Proteger a los participantes.\n• Respetar la confidencialidad.\n• Reconocer las contribuciones y las fuentes.\n• Registrar y comunicar los resultados fielmente.\n• Declarar conflictos de intereses relevantes.\n• Cumplir los requisitos institucionales y legales.\n• Corregir errores y comunicar posibles irregularidades por los canales adecuados."
            ],
            [
                'palabras' => ['mala', 'conducta', 'falta', 'faltas', 'incumplimiento', 'fraude', 'deshonestidad'],
                'respuesta' => "Las posibles faltas de integridad científica pueden incluir fabricación o falsificación de datos, plagio y otras conductas contrarias a las normas aplicables.\n\nUna sospecha debe tratarse con seriedad e imparcialidad. Conviene conservar la documentación pertinente, evitar acusaciones públicas no verificadas y utilizar los procedimientos institucionales establecidos para comunicar y revisar la situación."
            ],
            [
                'palabras' => ['denunciar', 'denuncia', 'reportar', 'irregularidad', 'queja'],
                'respuesta' => "Ante una posible irregularidad ética:\n\n1. Reúne la documentación pertinente.\n2. Registra los hechos de forma objetiva.\n3. Consulta el procedimiento institucional correspondiente.\n4. Comunica la situación a la instancia competente.\n5. Respeta la confidencialidad y el proceso de revisión.\n\nLa determinación de una falta requiere una evaluación adecuada y no debe basarse únicamente en rumores."
            ],
            [
                'palabras' => ['comunidades', 'comunidad', 'indigenas', 'ancestrales', 'saberes', 'tradicionales'],
                'respuesta' => "La investigación con comunidades debe desarrollarse con respeto a su dignidad, derechos, contexto cultural y participación.\n\nEs importante explicar los objetivos del proyecto, considerar los posibles impactos, respetar los acuerdos establecidos y cumplir las normas aplicables sobre conocimientos tradicionales, datos y propiedad intelectual. No deben atribuirse autorizaciones o consensos que no se hayan obtenido."
            ],
            [
                'palabras' => ['inteligencia', 'artificial', 'chatgpt', 'ia', 'algoritmos'],
                'respuesta' => "El uso de herramientas de inteligencia artificial en investigación requiere transparencia y evaluación crítica.\n\nBuenas prácticas:\n• Verificar la exactitud de la información generada.\n• No inventar referencias ni resultados.\n• Proteger los datos confidenciales antes de introducirlos en herramientas externas.\n• Respetar las políticas de la institución y de la publicación.\n• Declarar el uso de estas herramientas cuando las reglas aplicables lo exijan.\n• Mantener la responsabilidad humana sobre el trabajo presentado."
            ],
            [
                'palabras' => ['tesis', 'titulacion', 'grado', 'universitaria', 'universidad', 'tesina'],
                'respuesta' => "Una tesis o trabajo de titulación debe respetar la integridad académica y las normas de investigación.\n\nDebes delimitar el problema, justificar la metodología, citar las fuentes, presentar resultados auténticos, respetar a los participantes y cumplir los requisitos de tu universidad. Consulta las directrices de tu carrera para conocer las reglas específicas."
            ],
            [
                'palabras' => ['documento', 'oficial', 'articulos', 'articulo', 'normativa', 'reglamento'],
                'respuesta' => "Para verificar obligaciones institucionales concretas, consulta el documento oficial completo del Código de Ética en la Investigación Científica y la normativa vigente de tu universidad.\n\nEste asistente ofrece respuestas generales predeterminadas y no debe utilizarse para atribuir artículos o disposiciones específicas que no hayan sido comprobados en el documento oficial."
            ],
            [
                'palabras' => ['gracias', 'agradezco', 'agradecido'],
                'respuesta' => "¡Con gusto! Espero que la información te sea útil. Puedes hacer otra consulta sobre ética en la investigación científica."
            ],
            [
                'palabras' => ['adios', 'luego', 'vemos', 'chao', 'bye', 'despedida'],
                'respuesta' => "¡Hasta pronto! Gracias por utilizar el asistente virtual."
            ],
        ];

        /*
         * RESPUESTA AUTOMÁTICA POR NÚMERO
         *
         * Acepta:
         * 1
         * 2
         * 15
         * pregunta 3
         * numero 4
         * respuesta 5
         *
         * El número corresponde a la posición del grupo
         * dentro del arreglo $respuestas.
         */
        if (
            preg_match(
                '/^(?:(?:pregunta|numero|respuesta)\s*)?(\d+)$/u',
                $texto,
                $coincidencia
            )
        ) {
            $numero = (int) $coincidencia[1];
            $indice = $numero - 1;

            if ($numero >= 1 && isset($respuestas[$indice])) {
                return $respuestas[$indice]['respuesta'];
            }

            return "No existe una respuesta registrada con el número {$numero}.\n\n"
                . "Escribe un número válido o formula tu pregunta usando palabras relacionadas con el tema.";
        }

        $mejorGrupo = null;
        $mejorPuntaje = 0;

        foreach ($respuestas as $grupo) {
            $puntaje = 0;

            foreach ($grupo['palabras'] as $palabraClave) {
                $clave = $this->normalizarTexto($palabraClave);

                if ($clave === '') {
                    continue;
                }

                if (in_array($clave, $palabrasTexto, true)) {
                    $puntaje += 3;
                    continue;
                }

                if (mb_strlen($clave) >= 4) {
                    foreach ($palabrasTexto as $pt) {
                        if (
                            mb_strlen($pt) >= 4 &&
                            str_contains($pt, $clave)
                        ) {
                            $puntaje += 1;
                            break;
                        }
                    }
                }

                if (mb_strlen($clave) >= 5) {
                    foreach ($palabrasTexto as $pt) {
                        if (
                            mb_strlen($pt) >= 5 &&
                            str_contains($clave, $pt)
                        ) {
                            $puntaje += 1;
                            break;
                        }
                    }
                }
            }

            if ($puntaje > $mejorPuntaje) {
                $mejorPuntaje = $puntaje;
                $mejorGrupo = $grupo;
            }
        }

        if (
            $mejorGrupo !== null &&
            $mejorPuntaje >= self::PUNTAJE_MINIMO
        ) {
            return $mejorGrupo['respuesta'];
        }

        return $this->respuestaPorDefecto();
    }

    private function respuestaPorDefecto(): string
    {
        return "No encuentro una respuesta predeterminada exacta para esa pregunta.\n\n"
            . "Puedes consultar sobre estos temas:\n"
            . "• Principios éticos e integridad científica.\n"
            . "• Consentimiento informado y derechos humanos.\n"
            . "• Plagio, citas y autoría.\n"
            . "• Confidencialidad y protección de datos.\n"
            . "• Conflictos de intereses.\n"
            . "• Riesgos y beneficios.\n"
            . "• Comités de ética y experimentación animal.\n"
            . "• Publicaciones, propiedad intelectual y metodología.\n"
            . "• Responsabilidades y faltas éticas.\n\n"
            . "Prueba formulando tu pregunta con el nombre del tema que deseas consultar.";
    }

    public function actionPreguntar(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $pregunta = Yii::$app->request->post('pregunta', '');

        if (!is_string($pregunta)) {
            Yii::$app->response->statusCode = 400;

            return [
                'success' => false,
                'respuesta' => 'La pregunta enviada no es válida.',
            ];
        }

        $pregunta = trim($pregunta);

        if ($pregunta === '') {
            Yii::$app->response->statusCode = 400;

            return [
                'success' => false,
                'respuesta' => 'Escribe una pregunta antes de enviar el mensaje.',
            ];
        }

        if (!mb_check_encoding($pregunta, 'UTF-8')) {
            Yii::$app->response->statusCode = 400;

            return [
                'success' => false,
                'respuesta' => 'La pregunta contiene caracteres no válidos.',
            ];
        }

        if (mb_strlen($pregunta, 'UTF-8') > self::MAX_CARACTERES) {
            Yii::$app->response->statusCode = 400;

            return [
                'success' => false,
                'respuesta' => 'La pregunta no puede superar los 2000 caracteres.',
            ];
        }

        try {
            if ($this->excedeLimiteSolicitudes()) {
                Yii::$app->response->statusCode = 429;

                return [
                    'success' => false,
                    'respuesta' => 'Has enviado demasiadas preguntas. Espera un minuto antes de intentarlo nuevamente.',
                ];
            }
        } catch (Throwable $e) {
            Yii::error(
                'Error al aplicar el límite del chatbot: ' . get_class($e),
                'chatbot'
            );

            Yii::$app->response->statusCode = 503;

            return [
                'success' => false,
                'respuesta' => 'El chatbot no está disponible temporalmente.',
            ];
        }

        return [
            'success' => true,
            'respuesta' => $this->obtenerRespuesta($pregunta),
        ];
    }
}
