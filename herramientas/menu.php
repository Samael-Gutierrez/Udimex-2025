<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 2;
        opacity: 0;
        visibility: hidden;
        transition: opacity 300ms ease, visibility 0ms 300ms;
    }

    .popup {
        position: absolute;
        z-index: 3;
        top: -150%;
        left: 50%;
        opacity: 0;
        transform: translate(-50%, -50%) scale(1.25);
        width: 380px;
        padding: 20px 30px;
        background: #fff;
        box-shadow: 2px 2px 5px 5px rgba(0, 0, 0, 0.5);
        border-radius: 10px;
        transition: top 0ms ease-in-out 200ms,
                    opacity 200ms ease-in-out 0ms,
                    transform 200ms ease-in-out 0ms;
    }

    .popup.active {
        top: 50%;
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
        transition: top 0ms ease-in-out 0ms,
                    opacity 200ms ease-in-out 0ms,
                    transform 200ms ease-in-out 0ms;
    }

    .popup::backdrop {
        background: rgba(0, 0, 0, 0.4);
    }

    .popup .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 15px;
        height: 15px;
        background-color: #888;
        color: #eee;
        text-align: center;
        line-height: 15px;
        border-radius: 15px;
        cursor: pointer;
    }

    .bar {
        width: 100%;
        height: 3px;
        background-color: var(--secondary);
        margin-top: -10px;
    }

    .popup .form h2 {
        text-align: center;
        color: var(--primary);
        margin: 10px 0px 20px;
        font-size: 18px;
        font-weight: bold;
    }

    .popup .form .form-element {
        margin: 15px 0px;
    }

    .popup .form .form-element label {
        font-size: 14px;
        color: #222;
    }

    .popup .form .form-element input[type='text'],
    .popup .form .form-element input[type='password'] {
        margin-top: 5px;
        display: block;
        width: 100%;
        padding: 10px;
        outline: none;
        border: 1px solid #aaa;
        border-radius: 5px;
        text-align: center;
    }

    .popup .form .form-element input[type='submit'] {
        width: 100%;
        height: 40px;
        border: none;
        outline: none;
        font-size: 16px;
        background-color: var(--secondary);
        color: #f5f5f5;
        border-radius: 10px;
        cursor: pointer;
        text-transform: uppercase;
        font-weight: bold;
    }
</style>
<body>
    <a class='hover-underline' onclick="togglePopup('Alumno 1',1)"><i class="bi bi-person icon-tab"></i> Alumno 1</a>
    <a class='hover-underline' onclick="togglePopup('Alumno 2',2)"><i class="bi bi-person icon-tab"></i> Alumno 2</a>
    <a class='hover-underline' onclick="togglePopup('Alumno 3',1)"><i class="bi bi-person icon-tab"></i> Alumno 3</a>

    <div class="backdrop" id="backdrop"></div>

    <div class="popup">
        <div class="close-btn">&times;</div>
        <div id="content-popup"></div>
    </div>

    <script>
        const popup = document.querySelector(".popup");
        const backdrop = document.getElementById("backdrop");
        let content = document.getElementById('content-popup');

        function togglePopup(name,tipo) {
            if(tipo == 1){
                content.innerHTML += `
                <form class='form' method='POST' action='alumno/login.php'>
                    <h2 id='popup-title'>Alumnos</h2>
                    <div class='bar'></div>
                    <div class='form-element'>
                        <input type='text' id='email' name='us' placeholder='Usuario'>
                    </div>
                    <div class='form-element'>
                        <input type='password' id='password' name='pas' placeholder='Contraseña'>
                    </div>
                    <input type='hidden' id='alumno-name' name='alumno_name'>
                    <div class='form-element'>
                        <input type='submit' value='Entrar'>
                    </div>
                    <hr>
                </form>
                `;
            }

            if(tipo == 2){
                backdrop.style.opacity = "1";
                backdrop.style.visibility = "visible";
                content.innerHTML += `
                    <form class='form' method='POST' action='alumno/login.php'>
                        <h2 id='popup-title'>Mensaje para ${name}</h2>
                        <div class='bar'></div>
                        <div class='form-element'>
                            <input type='text' id='text' name='nombre' placeholder='Tu nombre'>
                        </div>
                        <div class='form-element'>
                            <input type='text' id='asunto' name='asunto' placeholder='Asunto'>
                        </div>
                        <div class='form-element'>
                            <textarea id='mensaje' name='mensaje' placeholder='Escribe tu mensaje'></textarea>
                        </div>
                        <input type='hidden' id='destinatario' name='destinatario' value='${name}'>
                        <div class='form-element'>
                            <input type='submit' value='Entrar'>
                        </div>
                        <hr>
                    </form>
                    `;
            }
                popup.classList.add("active");
        }

        function closePopup() {


            backdrop.style.opacity = "0";
            backdrop.style.visibility = "hidden";
            popup.classList.remove("active");
            content.innerHTML = "";

        }

        document.getElementById("backdrop").addEventListener("click", closePopup);
        document.querySelector(".popup .close-btn").addEventListener("click", closePopup);
    </script>
</body>

</html>