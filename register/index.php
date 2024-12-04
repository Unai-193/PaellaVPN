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
        <a href="../index.html" class="logo"><img src="../img/paellalogo.png"></a>
        <nav>
            <a href="../login/index.html">INICIAR SESIÓN</a>
            <div class="desplegable">
                <a class="Doc" ><strong>DOCUMENTACIÓN↓</strong></a>
                <div class="submenu">
                    <a href="../manual/index.html">Manual</a>
                    <a href="../nosotros/index.html" class="link-cabecera"><strong>NOSOTROS</strong></a>
                </div>
            </div>
        </nav>
    </header>

    <h1 class="bodylogin">REGISTRESE</h1>
    <form action="registro.php" method="POST">

        <p class="plogin"><label for="nickname">Nombre</label>
            <input type="text" name="nickname" placeholder="Introduce tu nombre"></p>

        <p class="plogin"><label for="secname">Apellidos</label>
            <input type="text" name="secname" placeholder="Introduce tus apellidos"></p>

        <p class="plogin"><label for="mail">Correo</label>
        <input type="text" name="mail" placeholder="Correo electronico"></p>

        <i class="fa-solid fa-unlock"></i>
        <p class="plogin"><label for="password">Contraseña</label>
        <input type="password" name="password" placeholder="******"></p>


        <p class="plogin"><input class="submit" type="submit" value="Acceder"></p>
    </form>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $database = "users";
    $username = "paellavpn";
    $password = "P@ellaVPN";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
    mysqli_close($conn);
}
    ?>



    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="columna">
                <figure>
                    <a href="#"><img src="../img/paellalogo.png"></a>
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