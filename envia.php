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

    // Crear la estructura del mensaje
    $boundary = md5(time());
    $headers = "From: Prueba sonrisa <cherrera@dentalnetwork.com.mx>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";

    $message = "Nombre: $name\n";
    $message .= "Email: $email\n";
    $message .= "Numero: $phone\n";
    $message .= "Que me quiero revisar: $dientes\n";
    $message .= "Preocupaciones: $preocupaciones\n";
    $message .= "Interesado en: $estoyinteresado\n";
    $message .= "Iniciar tratamiento: $gridRadios\n";
    $message .= "Inquietudes: $inquietudes\n";
    $message .= "Agendar cita: $estoycita\n";

    // Enviar el correo electrónico
    if (mail($to, $subject, $message, $headers)) {
        echo "¡El formulario se ha enviado correctamente!";
    } else {
        echo "Error al enviar el formulario.";
    }
}
?>

