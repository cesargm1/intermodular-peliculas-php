<?php
$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$telefono = $_POST['telefono'] ?? '';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="svg/logo.svg" />
    <title>Formulario de registro</title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>

<body>
    <?php include_once '../resources/header.php' ?>
    <main class="main">
        <section class="main__section">
            <form class="form" action="/comprar.php" method="post">
                <h1 class="h1">Registro de usuarios</h1>
                <div class="input__container">
                    <label>
                        <div class="icon__container">
                            <img class="img__icon" src="/svg/login/user.svg" alt="icono">
                        </div>


                        <input class="input" name="nombre" type="text" required placeholder="Introduce tu nombre de usuario">
                    </label>
                </div>

                <div class="input__container">
                    <label>
                        <div class="icon__container">
                            <img class="img__icon" src="/svg/login/email.svg" alt="icono">
                        </div>


                        <input class="input" name="correo" type="email" required placeholder="introduce tu correo electronico">
                    </label>

                </div>

                <div class="input__container">

                    <label>
                        <div class="icon__container">
                            <img class="img__icon" src="/svg/login/truck.svg" alt="icono">
                        </div>


                        <input class="input" name="direccion" type="text" required placeholder="introduce la direccion de envio">
                    </label>


                </div>

                <div class="input__container">
                    <label>
                        <div class="icon__container">
                            <img class="img__icon" src="/svg/login/phone.svg" alt="icono">
                        </div>

                        <input class="input" name="telefono" type="tel" required placeholder="introduce el numero de telefono">
                    </label>
                </div>


                <label>
                    <div class="icon__container">
                        <p>Escribe el capcha</p>
                        <input class="input" type="text" name="capcha" />
                    </div>
                </label>
                <img class="img__capcha" src="../capcha/funcs/generate_code.php" alt="capcha" />


                <button class="button-generate-capcha" type="button">
                    + genera nuevo codigo
                </button>

                <button class="button" type="submit">Registrar usuario</button>
            </form>
        </section>
    </main>
    <?php include_once '../resources/footer.php' ?>
</body>

<script>
    // por js selecionamos la imagen del capcha y tambien el boton de generar nuevo
    const imgCodes = document.querySelector(".img__capcha");
    const buttonsGenerate = document.querySelector(".button-generate-capcha");
    buttonsGenerate.addEventListener('click', generateCode, false)

    // Creamos un evento click al boton para que suceda algo llarama a una funcion

    /*parametros

    useCapture	Optional (default = false).
    false - The handler is executed in the bubbling phase.
    true - The handler is executed in the capturing phase.
    */

    //  al hacer click llama a la funcion generateCode le pasamos los botones como parametro

    function generateCode() {


        // aqui le decimos donde esta el script para que cambie la imagen
        let url = "../capcha/funcs/generate_code.php";

        fetch(url)
            .then(response => response.blob())
            .then(data => {
                if (data) {
                    imgCodes.src = URL.createObjectURL(data)
                }
            })
    }
</script>

</html>