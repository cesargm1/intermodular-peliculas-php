<?php

use App\User\Auth;

$user = Auth::user();
$nombreUsuario = $user['nombre'] ?? 'Invitado';
?>
<header class="header">
    <nav>
        <ul>
            <li>
                <div class="container__icon">
                    <a href="/index.php"><img src="/svg/logo.svg" alt="logo" class="icon"></a>
                </div>
            </li>

            <li class="li__search">
                <form action="/buscador.php" method="get">
                    <div class="container__serch">
                        <label>
                            <input class="search" name="buscador" type="search" placeholder="Busca tu pelicula">
                        </label>

                        <div class="container__icon">
                            <button class="button--icon" type="submit"> <img src="/svg/nav/glass.svg" alt="glass" class="icon"></a></button>
                        </div>
                    </div>

                </form>
            </li>

            <li class="cart">
                <div class="container__icon">
                    <a href="/cesta.php"><img src="/svg/nav/cart.svg" alt="glass" class="icon"></a>
                </div>
            </li>

            <li>
                <div class="container__icon">
                    <a href="/catalogo.php"><img src="/svg/nav/films.svg" alt="films" class="icon"></a>
                </div>
            </li>

            <li>
                <div class="container__icon">
                    <?php if (!$nombreUsuario === 'nombre') { ?>
                        <a href="/index.php"><img src="/svg/nav/logOut.svg" alt="usuarios" title="logout" class="icon"></a>
                    <?php } else { ?>
                        <a href="/login.php"><img src="/svg/login/user.svg" alt="usuarios" title="logearse" class="icon"></a>
                    <?php } ?>
                </div>

            </li>
            <li>
                <div class="container__icon">
                    <span>Bienvenido <?php echo $nombreUsuario ?></span>
                </div>
            </li>
        </ul>
    </nav>
</header>