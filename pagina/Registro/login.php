<?php
session_start();

// Verificar si el formulario se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se recibieron los datos esperados
    if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
        // Recibir datos del formulario
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        
        // Conectar a la base de datos
        $servername = "sql208.infinityfree.com";
        $username = "if0_36647700";
        $password_db = "De12Li34Gh56T"; // Reemplaza con tu contraseña si es diferente
        $dbname = "if0_36647700_mydatabase";

        $conn = new mysqli($servername, $username, $password_db, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta SQL para verificar las credenciales del usuario
        $sql = $conn->prepare("SELECT * FROM users WHERE usuario = ?");
        $sql->bind_param("s", $usuario);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows == 1) {
            // El usuario existe, verificar la contraseña
            $row = $result->fetch_assoc();
            if (password_verify($contrasena, $row['contrasena'])) {
                // Contraseña correcta, iniciar sesión y redirigir
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['correo'] = $row['correo'];
                header("Location: ../../Sesion_iniciada.html"); // Redirigir a la página de inicio exitoso
                exit();
            } else {
                // Contraseña incorrecta, mostrar mensaje de error
                header("Location: ../../Sesion_iniciada.html"); // Redirigir a la página de inicio exitoso
                exit();

            }
        } else {
            // El usuario no existe, mostrar mensaje de error
            $error_message = "El usuario ingresado no existe.";
            header("Location: Registro.html"); 
            exit();
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    } else {
        $error_message = "Por favor, completa todos los campos.";
    }
} else {
    $error_message = "Método de solicitud no permitido.";
    
}

// Mostrar mensaje de error si hay uno
if (isset($error_message)) {
    echo "<script>alert('$error_message');</script>";
}
?>
