<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <main class="main">
        <section class="main__section">
            <form class="form" action="login.php" method="post">
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

                <button type="submit">Registrar usuario</button>
            </form>
        </section>
    </main>
</body>

</html>