<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Asistente de Ética';

$chatbotUrl = Url::to(['/chatbot/preguntar']);
$csrfToken = Yii::$app->request->csrfToken;

$this->registerCssFile(
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'
);

$this->registerCss(<<<CSS
#ethics-chatbot {
    position: fixed;
    right: 25px;
    bottom: 25px;
    z-index: 10000;
    font-family: Arial, Helvetica, sans-serif;
}

#ethics-chatbot *,
#ethics-chatbot *::before,
#ethics-chatbot *::after {
    box-sizing: border-box;
}

#ethics-chatbot button,
#ethics-chatbot input {
    font-family: inherit;
}

.chat-button {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 62px;
    height: 62px;
    border: 1px solid rgba(255,255,255,.2);
    border-radius: 50%;
    background: linear-gradient(135deg, #0f172a, #1e40af);
    color: #fff;
    font-size: 23px;
    cursor: pointer;
    box-shadow: 0 8px 28px rgba(15,23,42,.3);
    transition: transform .25s ease, box-shadow .25s ease;
}

.chat-button:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(15,23,42,.4);
}

.chat-button:focus-visible,
.chat-close:focus-visible,
.chat-form button:focus-visible,
.quick-questions button:focus-visible {
    outline: 3px solid #38bdf8;
    outline-offset: 3px;
}

.chat-notification {
    position: absolute;
    top: -3px;
    right: -3px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 21px;
    height: 21px;
    border: 2px solid #fff;
    border-radius: 50%;
    background: #dc2626;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
}

.chat-notification[hidden] {
    display: none;
}

.chat-window {
    position: absolute;
    right: 0;
    bottom: 78px;
    display: flex;
    flex-direction: column;
    width: 390px;
    max-width: calc(100vw - 30px);
    height: 560px;
    max-height: calc(100vh - 115px);
    max-height: calc(100dvh - 115px);
    overflow: hidden;
    border: 1px solid #dbe3ef;
    border-radius: 20px;
    background: #fff;
    box-shadow: 0 20px 65px rgba(15,23,42,.24);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: translateY(14px) scale(.97);
    transform-origin: bottom right;
    transition: opacity .22s ease, transform .22s ease, visibility .22s ease;
}

.chat-window.active {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: translateY(0) scale(1);
}

.chat-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 17px 18px;
    background: linear-gradient(135deg, #0f172a, #1e40af);
    color: #fff;
}

.chat-header-info {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

.chat-avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 44px;
    height: 44px;
    border: 1px solid rgba(255,255,255,.2);
    border-radius: 50%;
    background: rgba(255,255,255,.12);
    font-size: 19px;
}

.chat-header strong {
    display: block;
    font-size: 15px;
    font-weight: 700;
}

.chat-header .status {
    display: block;
    margin-top: 5px;
    color: #dbeafe;
    font-size: 11px;
}

.chat-header .status i {
    margin-right: 4px;
    color: #4ade80;
    font-size: 8px;
}

.chat-close {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 36px;
    height: 36px;
    border: 0;
    border-radius: 50%;
    background: transparent;
    color: #fff;
    font-size: 19px;
    cursor: pointer;
}

.chat-close:hover {
    background: rgba(255,255,255,.15);
}

.chat-messages {
    flex: 1;
    min-height: 0;
    overflow-y: auto;
    padding: 18px 14px;
    background: #f4f7fb;
    scroll-behavior: smooth;
    overscroll-behavior: contain;
}

.bot-message {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    margin-bottom: 16px;
}

.bot-avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #dbeafe;
    color: #1e40af;
    font-size: 13px;
}

.message-bubble {
    max-width: 85%;
    padding: 12px 14px;
    border: 1px solid #e5eaf2;
    border-radius: 4px 15px 15px 15px;
    background: #fff;
    box-shadow: 0 2px 7px rgba(15,23,42,.04);
    color: #334155;
    font-size: 13px;
    line-height: 1.65;
    white-space: pre-wrap;
    overflow-wrap: anywhere;
}

.user-message {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 16px;
}

.user-bubble {
    max-width: 85%;
    padding: 11px 14px;
    border-radius: 15px 4px 15px 15px;
    background: #1e40af;
    color: #fff;
    font-size: 13px;
    line-height: 1.6;
    white-space: pre-wrap;
    overflow-wrap: anywhere;
}

.quick-questions {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
    padding: 11px 13px;
    border-top: 1px solid #e5eaf2;
    background: #fff;
}

.quick-questions button {
    padding: 7px 10px;
    border: 1px solid #cbd5e1;
    border-radius: 18px;
    background: #fff;
    color: #1e3a8a;
    font-size: 11px;
    cursor: pointer;
    transition: background .2s ease, border-color .2s ease;
}

.quick-questions button:hover {
    border-color: #93c5fd;
    background: #eff6ff;
}

.chat-form {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 12px;
    border-top: 1px solid #e5eaf2;
    background: #fff;
}

.chat-form input {
    flex: 1;
    min-width: 0;
    height: 44px;
    padding: 10px 13px;
    border: 1px solid #cbd5e1;
    border-radius: 13px;
    outline: none;
    background: #f8fafc;
    color: #0f172a;
    font-size: 13px;
    transition: border-color .2s ease, box-shadow .2s ease;
}

.chat-form input:focus {
    border-color: #2563eb;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
}

.chat-form input:disabled {
    opacity: .7;
    cursor: wait;
}

.chat-form button {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 44px;
    height: 44px;
    border: 0;
    border-radius: 13px;
    background: #1e40af;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    transition: background .2s ease;
}

.chat-form button:hover:not(:disabled) {
    background: #1e3a8a;
}

.chat-form button:disabled {
    opacity: .55;
    cursor: wait;
}

.chat-disclaimer {
    padding: 5px 12px 9px;
    background: #fff;
    color: #64748b;
    text-align: center;
    font-size: 10px;
    line-height: 1.5;
}

@media (max-width: 600px) {
    
#ethics-chatbot {
    position: fixed;
    right: 25px;
    bottom: 200px;
    z-index: 10000;
    font-family: Arial, Helvetica, sans-serif;
}


    .chat-window {
        position: fixed;
        right: 10px;
        bottom: 82px;
        width: calc(100vw - 20px);
        max-width: 420px;
        height: min(560px, calc(100vh - 105px));
        height: min(560px, calc(100dvh - 105px));
        max-height: calc(100dvh - 105px);
    }

    .chat-button {
        width: 56px;
        height: 56px;
    }
}

@media (max-width: 360px) {
    #ethics-chatbot {
        right: 10px;
        bottom: 10px;
    }

    .chat-window {
        right: 8px;
        width: calc(100vw - 16px);
    }

    .chat-messages {
        padding: 12px 9px;
    }

    .quick-questions {
        gap: 5px;
        padding: 9px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .chat-window,
    .chat-button,
    .chat-form input,
    .chat-form button {
        transition: none;
    }

    .chat-messages {
        scroll-behavior: auto;
    }
}
CSS);

?>

<div id="ethics-chatbot">
    <div
        id="chat-window"
        class="chat-window"
        aria-hidden="true"
        role="dialog"
        aria-label="Asistente de Ética"
        aria-modal="false"
    >
        <div class="chat-header">
            <div class="chat-header-info">
                <div class="chat-avatar">
                    <i class="fa-solid fa-scale-balanced" aria-hidden="true"></i>
                </div>

                <div>
                    <strong>Asistente de Ética</strong>
                    <span class="status">
                        <i class="fa-solid fa-circle" aria-hidden="true"></i>
                        Asistente virtual
                    </span>
                </div>
            </div>

            <button
                type="button"
                id="chat-close"
                class="chat-close"
                aria-label="Cerrar chatbot"
            >
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
        </div>

        <div
            id="chat-messages"
            class="chat-messages"
            aria-live="polite"
            aria-relevant="additions"
        >
            <div class="bot-message">
                <div class="bot-avatar">
                    <i class="fa-solid fa-robot" aria-hidden="true"></i>
                </div>

                <div class="message-bubble">¡Hola! Soy el asistente del Código de Ética de la Investigación Científica.

Puedes consultarme sobre principios éticos, plagio, consentimiento informado, confidencialidad, integridad científica, autoría y otros temas relacionados con la investigación ética.

¿En qué puedo ayudarte?</div>
            </div>
        </div>

        <div class="quick-questions" aria-label="Preguntas sugeridas">
            <button
                type="button"
                data-question="¿Qué es la ética de la investigación científica?"
            >
                ¿Qué es la ética?
            </button>

            <button
                type="button"
                data-question="¿Qué es el plagio científico?"
            >
                Plagio
            </button>

            <button
                type="button"
                data-question="¿Qué es el consentimiento informado?"
            >
                Consentimiento
            </button>

            <button
                type="button"
                data-question="¿Cómo se protege la confidencialidad de los participantes?"
            >
                Confidencialidad
            </button>
        </div>

        <div class="chat-disclaimer">
            Las respuestas son orientativas. Consulta el documento oficial para confirmar las disposiciones institucionales.
        </div>

        <form id="chat-form" class="chat-form">
            <input
                type="text"
                id="chat-input"
                name="pregunta"
                maxlength="2000"
                placeholder="Escribe tu pregunta..."
                autocomplete="off"
                aria-label="Escribe tu pregunta"
                required
            >

            <button type="submit" aria-label="Enviar pregunta">
                <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
            </button>
        </form>
    </div>

    <button
        type="button"
        id="chat-button"
        class="chat-button"
        aria-label="Abrir asistente"
        aria-expanded="false"
        aria-controls="chat-window"
        title="Asistente de Ética"
    >
        <i class="fa-solid fa-robot" aria-hidden="true"></i>
        <span
            class="chat-notification"
            id="chat-notification"
            aria-label="Nueva notificación"
        >1</span>
    </button>
</div>

<?php

$js = <<<'JS'
(function () {
    const chatButton = document.getElementById('chat-button');
    const chatWindow = document.getElementById('chat-window');
    const chatClose = document.getElementById('chat-close');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const chatMessages = document.getElementById('chat-messages');
    const notification = document.getElementById('chat-notification');
    const sendButton = chatForm.querySelector('button');

    const chatbotUrl = CHATBOT_URL;
    const csrfToken = CSRF_TOKEN;

    let esperandoRespuesta = false;

    function abrirChat() {
        chatWindow.classList.add('active');
        chatWindow.setAttribute('aria-hidden', 'false');
        chatButton.setAttribute('aria-expanded', 'true');
        notification.hidden = true;
        chatInput.focus();
    }

    function cerrarChat() {
        chatWindow.classList.remove('active');
        chatWindow.setAttribute('aria-hidden', 'true');
        chatButton.setAttribute('aria-expanded', 'false');
        chatButton.focus();
    }

    chatButton.addEventListener('click', function () {
        if (chatWindow.classList.contains('active')) {
            cerrarChat();
        } else {
            abrirChat();
        }
    });

    chatClose.addEventListener('click', cerrarChat);

    document.addEventListener('keydown', function (event) {
        if (
            event.key === 'Escape' &&
            chatWindow.classList.contains('active')
        ) {
            cerrarChat();
        }
    });

    function desplazarMensajes() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function crearAvatar() {
        const avatar = document.createElement('div');
        avatar.className = 'bot-avatar';

        const icono = document.createElement('i');
        icono.className = 'fa-solid fa-robot';
        icono.setAttribute('aria-hidden', 'true');

        avatar.appendChild(icono);

        return avatar;
    }

    function agregarUsuario(pregunta) {
        const elemento = document.createElement('div');
        elemento.className = 'user-message';

        const burbuja = document.createElement('div');
        burbuja.className = 'user-bubble';
        burbuja.textContent = pregunta;

        elemento.appendChild(burbuja);
        chatMessages.appendChild(elemento);

        desplazarMensajes();
    }

    function agregarBot(respuesta) {
        const elemento = document.createElement('div');
        elemento.className = 'bot-message';

        const burbuja = document.createElement('div');
        burbuja.className = 'message-bubble';
        burbuja.textContent = respuesta;

        elemento.appendChild(crearAvatar());
        elemento.appendChild(burbuja);
        chatMessages.appendChild(elemento);

        desplazarMensajes();
    }

    function mostrarEscribiendo() {
        const elemento = document.createElement('div');
        elemento.className = 'bot-message';
        elemento.id = 'chat-typing';

        const burbuja = document.createElement('div');
        burbuja.className = 'message-bubble';
        burbuja.textContent = 'Estoy preparando tu respuesta...';

        elemento.appendChild(crearAvatar());
        elemento.appendChild(burbuja);
        chatMessages.appendChild(elemento);

        desplazarMensajes();
    }

    function quitarEscribiendo() {
        document.getElementById('chat-typing')?.remove();
    }

    async function procesarPregunta(pregunta) {
        pregunta = pregunta.trim();

        if (!pregunta || esperandoRespuesta) {
            return;
        }

        if (pregunta.length > 2000) {
            agregarBot('La pregunta no puede superar los 2000 caracteres.');
            return;
        }

        esperandoRespuesta = true;
        chatInput.disabled = true;
        sendButton.disabled = true;

        agregarUsuario(pregunta);
        chatInput.value = '';
        mostrarEscribiendo();

        const controlador = new AbortController();
        const temporizador = setTimeout(function () {
            controlador.abort();
        }, 45000);

        try {
            const respuestaHttp = await fetch(chatbotUrl, {
                method: 'POST',
                credentials: 'same-origin',
                signal: controlador.signal,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
                    'X-CSRF-Token': csrfToken,
                    'Accept': 'application/json'
                },
                body: new URLSearchParams({
                    pregunta: pregunta,
                    _csrf: csrfToken
                }).toString()
            });

            let datos;

            try {
                datos = await respuestaHttp.json();
            } catch (errorJson) {
                throw new Error('RESPUESTA_INVALIDA');
            }

            if (
                !respuestaHttp.ok ||
                !datos ||
                datos.success !== true
            ) {
                throw new Error('SOLICITUD_FALLIDA');
            }

            if (
                typeof datos.respuesta !== 'string' ||
                datos.respuesta.trim() === ''
            ) {
                throw new Error('SIN_RESPUESTA');
            }

            quitarEscribiendo();
            agregarBot(datos.respuesta);

        } catch (error) {
            quitarEscribiendo();

            let mensaje = 'No fue posible obtener una respuesta. Inténtalo nuevamente más tarde.';

            if (error.name === 'AbortError') {
                mensaje = 'La solicitud tardó demasiado. Inténtalo nuevamente.';
            } else if (error instanceof TypeError) {
                mensaje = 'No se pudo conectar con el servidor. Comprueba tu conexión.';
            } else if (error.message === 'RESPUESTA_INVALIDA') {
                mensaje = 'El servidor devolvió una respuesta inesperada. Inténtalo más tarde.';
            } else if (error.message === 'SIN_RESPUESTA') {
                mensaje = 'El asistente no generó una respuesta. Inténtalo nuevamente.';
            }

            agregarBot(mensaje);
            console.error('Error al consultar el asistente:', error.name || 'Error');

        } finally {
            clearTimeout(temporizador);
            quitarEscribiendo();

            esperandoRespuesta = false;
            chatInput.disabled = false;
            sendButton.disabled = false;

            if (chatWindow.classList.contains('active')) {
                chatInput.focus();
            }
        }
    }

    chatForm.addEventListener('submit', function (event) {
        event.preventDefault();
        procesarPregunta(chatInput.value);
    });

    chatWindow.querySelectorAll('.quick-questions button').forEach(function (button) {
        button.addEventListener('click', function () {
            procesarPregunta(button.dataset.question || '');
        });
    });
})();
JS;

$js = str_replace(
    ['CHATBOT_URL', 'CSRF_TOKEN'],
    [
        Json::encode($chatbotUrl),
        Json::encode($csrfToken),
    ],
    $js
);

$this->registerJs($js, View::POS_READY);

?>
