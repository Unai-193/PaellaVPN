<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "paella";
$password = "P@ssw0rd";
$dbname = "paellavpn";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['nickname'];
    $contrasenya = $_POST['password'];

    $contrasenya_encriptada = hash('sha256', $contrasenya);

    $stmt = $conn->prepare("SELECT * FROM Usuaris WHERE Correu_Electronic = ? AND Contrasenya = ?");
    $stmt->bind_param("ss", $correo, $contrasenya_encriptada);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $_SESSION['user_id'] = $usuario['ID_Usuari'];
        $_SESSION['user_name'] = $usuario['Nom'];

        header("Location: archivo.php");
        exit();
    } else {
        echo "<script>alert('Credenciales incorrectas'); window.location.href = 'index.php';</script>";
        exit();
    }

    $stmt->close();
}

$conn->close();
?>