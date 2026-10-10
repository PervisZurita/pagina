document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('chatForm');
    const input = document.getElementById('pregunta');
    const messages = document.getElementById('chatMessages');

    function escapar(texto) {

        const div = document.createElement('div');

        div.textContent = texto;

        return div.innerHTML;
    }


    function agregarUsuario(texto) {

        const mensaje = document.createElement('div');

        mensaje.className = 'chat-message user';

        mensaje.innerHTML = `
            <div class="message-bubble">
                <strong>Tú</strong>
                <p>${escapar(texto)}</p>
            </div>
        `;

        messages.appendChild(mensaje);

        messages.scrollTop = messages.scrollHeight;
    }


    function agregarBot(texto) {

        const mensaje = document.createElement('div');

        mensaje.className = 'chat-message bot';

        mensaje.innerHTML = `
            <div class="message-avatar">
                <i class="fa-solid fa-robot"></i>
            </div>

            <div class="message-bubble">

                <strong>Asistente</strong>

                <p>${escapar(texto)}</p>

            </div>
        `;

        messages.appendChild(mensaje);

        messages.scrollTop = messages.scrollHeight;
    }


    async function preguntar(texto) {

        texto = texto.trim();

        if (!texto) {
            return;
        }

        agregarUsuario(texto);

        input.value = '';

        try {

            const datos = new FormData();

            datos.append('pregunta', texto);

            const respuesta = await fetch(
                form.action,
                {
                    method: 'POST',
                    body: datos,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }
            );

            const resultado = await respuesta.json();

            if (resultado.success) {

                agregarBot(resultado.respuesta);

            } else {

                agregarBot(
                    'No pude procesar tu pregunta.'
                );
            }

        } catch (error) {

            console.error(error);

            agregarBot(
                'Ocurrió un error al conectar con el servidor.'
            );
        }
    }


    form.addEventListener('submit', function (event) {

        event.preventDefault();

        preguntar(input.value);

    });


    document.addEventListener('click', function (event) {

        const boton =
            event.target.closest('[data-question]');

        if (!boton) {
            return;
        }

        preguntar(
            boton.dataset.question
        );

    });

});
