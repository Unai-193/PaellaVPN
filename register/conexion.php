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
            <a href="../login/index.php">INICIAR SESIÓN</a>
            <div class="desplegable">
                <a class="Doc" >DOCUMENTACIÓN↓</a>
                <div class="submenu">
                    <a href="../nosotros/index.html" class="link-cabecera">Nosotros</a>
                </div>
            </div>
        </nav>
    </header>


<?php
$server = "localhost";
$user = "paella";
$passwddb = "P@ssw0rd";
$db = "paellavpn";

$enlace = mysqli_connect($server, $user, $passwddb, $db);

if (!$enlace) {
    die("No se pudo conectar con la base de datos: " . mysqli_error($enlace));
}

$nombre = $_POST['nickname'];
$apellidos = $_POST['secname'];
$mail = $_POST['mail'];
$passwd = $_POST['password'];

if (strlen($passwd) < 8) {
    echo "<script>alert('La contraseña debe tener al menos 8 caracteres.');</script>";
    echo "<script>window.location.href='index.html';</script>";
    exit;
}

$passwd = hash('sha256', $passwd);

$sql = "INSERT INTO Usuaris (Nom, Apellidos, Correu_Electronic, Contrasenya) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($enlace, $sql);

mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellidos, $mail, $passwd);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Usuario registrado con éxito');</script>";
} else {
    echo "<script>alert('Error al registrar el usuario');</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($enlace);
?>

<h2 class="pl"></h2>
<div class="Login">
    <h1 class="textomain">Enhorabuena, te has registrado</h1>
    <h1 class="textomain"><a href="../login/index.php" class="compra"><strong>Inicie sesión</strong></a></h1>
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
    border: 3px solid #BBE1FA;
    border-radius: 20%;
    margin-bottom: 100px;
}

.Login .textomain {
    white-space: nowrap;
    font-family: 'League Spartan';
    padding: 3%;
    margin: 3%;
    text-align: center;
}

.Login .compra {
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    border: 3px solid #BBE1FA;
    border-radius: 40%;
    background-color: #BBE1FA;
    padding: 20px;
    color: black;
    text-decoration: none;
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