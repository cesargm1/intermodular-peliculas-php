let viewPasswords = document.getElementsByClassName('viewPasswords');

// recorre cada input contraseña 
for (let i = 0; i < viewPasswords.length; i++) {
    let click = false;

    viewPasswords[i].addEventListener('click', () => {
        // closest: Buscar el input anterior dentro del mismo label
        const input = viewPasswords[i].closest('label').querySelector('input[type="password"], input[type="text"]');

        // cambia el yipo de input al hacer click 
        if (input) {
            input.type = click ? 'password' : 'text';
            click = !click;
        }
    });
}
