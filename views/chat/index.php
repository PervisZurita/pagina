
<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->registerCssFile(
    '@web/css/chatbot.css'
);

$this->registerJsFile(
    '@web/js/chatbot.js',
    [
        'depends' => [
            \yii\web\YiiAsset::class,
        ],
    ]
);

$chatUrl = Url::to(['/chat/ask']);

?>

<div
    id="chatbot"
    class="chatbot-container"
>

    <button
        id="chatbot-toggle"
        class="chatbot-button"
        type="button"
        aria-label="Abrir asistente"
    >

        <i class="fa-solid fa-robot"></i>

    </button>


    <div
        id="chatbot-window"
        class="chatbot-window"
    >

        <div class="chatbot-header">

            <div class="chatbot-title">

                <div class="chatbot-avatar">

                    <i class="fa-solid fa-robot"></i>

                </div>

                <div>

                    <strong>
                        Asistente IA
                    </strong>

                    <small>
                        Ética de la Investigación Científica
                    </small>

                </div>

            </div>


            <button
                id="chatbot-close"
                type="button"
                class="chatbot-close"
                aria-label="Cerrar chatbot"
            >

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>


        <div
            id="chatbot-messages"
            class="chatbot-messages"
        >

            <div class="chat-message bot">

                <div class="message-avatar">

                    <i class="fa-solid fa-robot"></i>

                </div>

                <div class="message-content">

                    <p>
                        ¡Hola! 👋
                    </p>

                    <p>
                        Soy el asistente de Ética de la
                        Investigación Científica.
                    </p>

                    <p>
                        Puedes preguntarme sobre plagio,
                        integridad científica, consentimiento
                        informado, conflictos de intereses,
                        autoría, privacidad y otros temas.
                    </p>

                </div>

            </div>

        </div>


        <div
            id="chatbot-loading"
            class="chatbot-loading"
        >

            <span></span>
            <span></span>
            <span></span>

        </div>


        <form
            id="chatbot-form"
            class="chatbot-form"
        >

            <input
                type="text"
                id="chatbot-input"
                name="message"
                placeholder="Escribe tu pregunta..."
                autocomplete="off"
                maxlength="2000"
            >

            <button
                type="submit"
                aria-label="Enviar pregunta"
            >

                <i class="fa-solid fa-paper-plane"></i>

            </button>

        </form>

    </div>

</div>


<script>

window.chatbotConfig = {

    url: <?= json_encode($chatUrl) ?>,

    csrfToken:
        <?= json_encode(
            Yii::$app->request->csrfToken
        ) ?>

};

</script>
