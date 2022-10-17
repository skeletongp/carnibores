<div class="w-2/3">
    <button onclick="login()"
        class="text-base leading-none  py-3 bg-gray-300 border-white border focus:outline-none focus:ring-0  hover:text-gray-200 hover:bg-red-600 text-red-500  w-full font-bold uppercase rounded-md">
        <span class="fab fa-google "></span>
        <span>Iniciar sesión</span>
    </button>
    <script>
        function login() {
            Swal.fire({
                title: 'Iniciar sesión',
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
                Livewire.emit('login', result.value);
            })
        }
    </script>

</div>
