<div>
    <button onclick="openSignupForm()"
        class="py-4 px-2 font-semibold hover:text-primary transition duration-300 {{ request()->routeIs('about') ? ' text-primary border-b-4 border-primary font-semibold' : 'text-blue-600 lg:text-slate-300' }}">Regístrate</button>


    <script>
        function openSignupForm() {
            Swal.fire({
                title: 'Iniciar sesión',
                html: `
                <input type="text" id="nameS" required class="swal2-input" placeholder="Nombre completo">
                <input type="email" id="emailS" required class="swal2-input " placeholder="Correo Electrónico">
                <input type="password" id="passwordS" class="swal2-input" placeholder="Contraseña">
                <input type="tel" id="phoneS" placeholder="Teléfono" class="swal2-input">    
                `,
                confirmButtonText: 'Confirmar',
                focusConfirm: false,
                preConfirm: () => {
                    const name = Swal.getPopup().querySelector('#nameS').value
                    const email = Swal.getPopup().querySelector('#emailS').value
                    const password = Swal.getPopup().querySelector('#passwordS').value
                    const phone = Swal.getPopup().querySelector('#phoneS').value
                    //validate if is email with regex
                    isEmail = String(email).toLowerCase().match(
                        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    );
                    isPassword = String(password).length > 6;
                    if (!email || !password || !name || !phone || !isEmail || !isPassword) {
                        Swal.showValidationMessage(`Por favor, verifique los campos`)
                    }
                    return {
                        name: name,
                        email: email,
                        password: password,
                        phone: phone,
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('signup', result.value);
                }
            })
            $('input[type=tel]').each(function() {
                $(this).formatPhoneNumber({
                    format: '(###) ###-####'
                })
            })
        }
    </script>
</div>
