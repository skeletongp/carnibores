<div class="">
    <button onclick="login()"
        class="py-3 px-2 font-semibold hover:text-primary transition duration-300 {{ request()->routeIs('about') ? ' text-primary border-b-4 border-primary font-semibold' : 'text-blue-600 lg:text-slate-300' }}">Acceder</button>
    <script>
        function login() {
            Swal.fire({
                title: 'Crear Cuenta',
                html: `<input type="email" id="email" required class="swal2-input " placeholder="Correo Electrónico">
                            <input type="password" id="password" class="swal2-input" placeholder="Contraseña">`,
                confirmButtonText: 'Confirmar',
                focusConfirm: false,
                preConfirm: () => {
                    const email = Swal.getPopup().querySelector('#email').value
                    const password = Swal.getPopup().querySelector('#password').value
                    if (!email || !password) {
                        Swal.showValidationMessage(`Por favor, llene los campos`)
                    }
                    return {
                        email: email,
                        password: password
                    }
                }
            }).then((result) => {
                if(result.isConfirmed){
                    Livewire.emit('login', result.value);
                }
            })
        }
    </script>

</div>
