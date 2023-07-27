var formularioIniciado = false;

    function empezarFormulario() {
        if (!formularioIniciado) {
            formularioIniciado = true;
            document.getElementById("btn-empezar").style.display = "none";
            document.getElementById("formulario").style.display = "block";
            document.getElementById("pregunta1").classList.remove("d-none");
            document.getElementById("pregunta1").scrollIntoView({ behavior: "smooth" });

            // Ocultar la imagen al iniciar el formulario
            document.getElementById("imagen-clinica").style.display = "none";

            // Ocultar el texto al iniciar el formulario
            document.getElementById("mensaje").style.display = "none";
        }
    }

    function mostrarPregunta(preguntaActual, preguntaSiguiente) {
        document.getElementById(preguntaActual).classList.add('d-none');
        document.getElementById(preguntaSiguiente).classList.remove('d-none');
        document.getElementById(preguntaSiguiente).scrollIntoView({ behavior: "smooth" });
    }

    function mostrarPregunta2(preguntaSiguiente, preguntaActual) {
        document.getElementById(preguntaSiguiente).classList.remove('d-none');
        document.getElementById(preguntaActual).classList.add('d-none');
        document.getElementById(preguntaSiguiente).scrollIntoView({ behavior: "smooth" });
    }

    // Función para previsualizar la foto seleccionada
    function previewPhoto(event) {
        var photo = document.getElementById('preview');
        photo.src = URL.createObjectURL(event.target.files[0]);
    }

    // Asociar la función de previsualización al evento "change" del campo de entrada de foto
    document.getElementById('photo').addEventListener('change', previewPhoto);

    // Funcion para recargar el formulario
    const reload = document.getElementById('reload');

    reload.addEventListener('click', _ => {
        location.reload();
    });

    // Agregar el controlador de eventos al botón de envío
    document.getElementById("btn-enviar").addEventListener("click", function() {
        if (validateForm()) {
            enviarFormulario();
        }
    });

    function validateForm() {
        const phoneNumber = document.getElementById('phone').value;
        const phoneNumberRegex = /^\d{10}$/;

        if (!phoneNumberRegex.test(phoneNumber)) {
            document.getElementById('error-msg').style.display = 'block';
            return false;
        }

        return true;
    }

    function enviarFormulario() {
        // Obtener los datos del formulario
        var formData = $('#formulario').serialize();

        // Obtener el valor del campo de texto message
        var message = $('#message').val();

        // Agregar el valor de message a los datos del formulario
        formData += '&message=' + encodeURIComponent(message);

        // Realizar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: 'ruta_hacia_tu_archivo_php.php', // Reemplaza 'ruta_hacia_tu_archivo_php.php' con la ruta correcta a tu archivo PHP que procesa el formulario y envía el correo.
            data: formData,
            success: function(response) {
                // Aquí puedes agregar código para mostrar un mensaje de éxito o realizar alguna acción adicional después de enviar el formulario
                alert('Formulario enviado correctamente');
                // Reiniciar el formulario y ocultar el modal
                document.getElementById("formulario").reset();
                $('#exampleModalCenter').modal('hide');
            },
            error: function(error) {
                // Aquí puedes agregar código para mostrar un mensaje de error en caso de que ocurra algún problema al enviar el formulario
                console.error('Error al enviar el formulario:', error);
            }
        });
    }


    function validarNombre() {
        var nombre = document.getElementById("name").value.trim();
        var regex = /^[a-zA-Z\s]+$/;
        var errorMensaje = document.getElementById("nombreError");
      
        if (nombre === "") {
          errorMensaje.textContent = "Por favor, ingresa un nombre valido.";
        } else if (!regex.test(nombre)) {
          errorMensaje.textContent = "El nombre solo puede contener letras y espacios.";
        } else {
          errorMensaje.textContent = "";
        }
      }
    
    
    function validarEmail() {
    var email = document.getElementById("email").value.trim();
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var errorMensaje = document.getElementById("emailError");
    
    if (email === "") {
      errorMensaje.textContent = "Por favor, ingresa un correo electrónico.";
    } else if (!regex.test(email)) {
      errorMensaje.textContent = "Por favor, ingresa un correo electrónico válido.";
    } else {
      errorMensaje.textContent = "";
    }
    }
    
    function validarTelefono() {
    var telefono = document.getElementById("phone").value.trim();
    var regex = /^[0-9+\-\s()]+$/;
    var errorMensaje = document.getElementById("telefonoError");
    
    if (telefono === "") {
      errorMensaje.textContent = "Por favor, ingresa un número telefónico.";
    } else if (!regex.test(telefono)) {
      errorMensaje.textContent = "Por favor, ingresa un número telefónico válido.";
    } else {
      errorMensaje.textContent = "";
    }
    }


    function mostrarAlerta(){
      alert("Cierra el siguiente mensaje para enviarlo");
    }

   function redirec() {
    setTimeout(function() {
        location.href = 'https://laclinicadental.org/';
    }, 1000); // 4000 milisegundos = 4 segundos
}
