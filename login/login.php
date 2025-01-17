<?php
session_start();

$servername = "localhost";
$username = "paella";
$password = "@P4ssw0rd";
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

        header("Location: login.php");
        exit();
    } else {
        echo "<script>alert('Credenciales incorrectas'); window.location.href = 'index.php';</script>";
        exit();
    }

    $stmt->close();
}

$conn->close();
?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>PAELLAVPN</title>
</head>
<body>
    <header>
        <a href="../index.html" class="logo"><img src="../img/logopaella12.png"></a>
        <nav>
            <div class="desplegable">
                <a class="Doc" >DOCUMENTACIÓN↓</a>
                <div class="submenu">
                    <a href="../nosotros/index.html" class="link-cabecera">Nosotros</a>
                </div>
            </div>
        </nav>
    </header>





    <h2 class="pl"></h2>
<div class="Login">
    <h1 class="textomain">Enhorabuena, has iniciado sesion <b><?php echo $decoded->data->user_name; ?></b></h1>
    <h1 class="textomain2"><a href="imagen.png" download><strong>Archivo VPN</strong></a></h1>
    <h1 class="textomain3"><a href="logout.php"><strong>Cerrar sesión</strong></a></h1>
</div>

<style>
.pl {
    padding-bottom: 200px;
}

.Login {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    max-width: 500px;
    margin: auto;
    padding: 5%;
    margin-bottom: 100px;
}

.Login .textomain {
    white-space: nowrap;
    font-family: 'League Spartan';
    padding: 3%;
    margin: 3%;
    text-align: center;
}

.Login .textomain2 {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    border: 3px solid #BBE1FA;
    border-radius: 40%;
    background-color: #BBE1FA;
    padding: 20px;
    color: black;
    text-decoration: none;
}

.Login .textomain3 {
    margin-top: 200px;
    border: 2px solid red; 
    border-radius: 0; 
    background-color: #FFCCCC; 
    padding: 10px; 
    color: black;
    text-decoration: none;
}

.Login .textomain2 a, .Login .textomain3 a {
    color: black; 
    text-decoration: none; 
}

.Login .textomain2 a:hover, .Login .textomain3 a:hover {
    text-decoration: underline; 
}
</style>


   



    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="columna">
                <figure>
                    <a href="#"><img src="../img/logopaella12.png"></a>
                </figure>
            </div>
            <div class="columna">
                <h2>CONTACTO</h2><br>
                <a href="mailto:paellavpn@gmail.com">paellavpn@gmail.com</a><br><br>
                <h2>APOYANOS</h2><br>
                <a href="https://www.paypal.me/Unaipi193">PaellaVPN paypal</a><br><br>
            </div>
            <div class="columna">
                <h2>COLABORADORES</h2><br>
                <a href="https://fp.institutmvm.cat" target="_blank"><img src="../img/logomvm2-removebg-preview.png" alt="Logo del instituto"></a>
            </div>
        </div>
    </footer>


</body>
</html>