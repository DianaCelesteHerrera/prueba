<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $to = "cherrera@dentalnetwork.com.mx";
    $subject = "Haz la prueba de sonrisa";

    // Obtener los datos del formulario
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $dientes = $_POST["dientes"];
    $preocupaciones = $_POST["preocupaciones"];
    $estoyinteresado = $_POST["estoyinteresado"];
    $gridRadios = $_POST["gridRadios"];
    $inquietudes = $_POST["inquietudes"];
    $estoycita = $_POST["estoycita"];

    // Procesar la foto adjunta
    $photo_tmp_name = $_FILES["photo"]["tmp_name"];
    $photo_type = $_FILES["photo"]["type"];
    $photo_name = $_FILES["photo"]["name"];
    $photo_size = $_FILES["photo"]["size"];

    // Variable de control para adjuntar la foto
    $attach_photo = true;

    // Verificar si se cargó una foto
    if (!empty($photo_tmp_name) && is_uploaded_file($photo_tmp_name)) {
        // Permitir formatos de imagen comunes
        $allowed_formats = array(
            "image/jpeg",
            "image/png",
            "image/gif",
            "image/bmp",
            "image/webp",
            "image/heif",
            "image/heic"
        );
        if (in_array($photo_type, $allowed_formats)) {
            // Establecer un límite de tamaño máximo para el archivo (en este ejemplo, 20 MB)
            $max_photo_size = 20 * 1024 * 1024; // 20 MB en bytes

            if ($photo_size > $max_photo_size) {
                echo "Advertencia: El tamaño del archivo es demasiado grande. La foto no se adjuntará al correo.<br>";
                $attach_photo = false;
            }
        } else {
            echo "Advertencia: Formato de imagen no admitido. La foto no se adjuntará al correo.<br>";
            $attach_photo = false;
        }
    } else {
        echo "Advertencia: No se ha seleccionado ninguna foto. La foto no se adjuntará al correo.<br>";
        $attach_photo = false;
    }

    // Crear la estructura del mensaje
    $boundary = md5(time());
    $headers = "From: Prueba sonrisa <cherrera@dentalnetwork.com.mx>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    $message = "--$boundary\r\n";
    $message .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $message .= "Nombre: $name\n";
    $message .= "Email: $email\n";
    $message .= "Numero: $phone\n";
    $message .= "Que me quiero revisar: $dientes\n";
    $message .= "Preocupaciones: $preocupaciones\n";
    $message .= "Interesado en: $estoyinteresado\n";
    $message .= "Iniciar tratamiento: $gridRadios\n";
    $message .= "Inquietudes: $inquietudes\n";
    $message .= "Agendar cita: $estoycita\n";
    $message .= "\r\n";

    // Adjuntar la foto al correo electrónico si la variable de control lo permite
    if ($attach_photo) {
        $message .= "--$boundary\r\n";
        $message .= "Content-Type: $photo_type; name=\"$photo_name\"\r\n";
        $message .= "Content-Disposition: attachment; filename=\"$photo_name\"\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $message .= chunk_split(base64_encode(file_get_contents($photo_tmp_name))) . "\r\n";
        $message .= "--$boundary--";
    }

    // Enviar el correo electrónico
    if (mail($to, $subject, $message, $headers)) {
        echo "¡El formulario se ha enviado correctamente!";
    } else {
        echo "Error al enviar el formulario.";
    }
}
?>
