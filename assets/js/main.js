document.addEventListener('DOMContentLoaded', function() {
    // Validación de formulario en el cliente
    const form = document.getElementById('registrationForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const telefono = document.getElementById('telefono').value;
            
            if (!validateEmail(email)) {
                alert('Por favor, ingrese un correo electrónico válido.');
                e.preventDefault();
            }

            if (telefono.length < 7) {
                alert('Por favor, ingrese un número de teléfono válido.');
                e.preventDefault();
            }
        });
    }

    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    // Efecto de scroll para la navbar
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            header.style.background = '#ffffff';
            header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        } else {
            header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        }
    });
});
