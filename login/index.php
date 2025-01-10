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
    <div class="all">
        <header>
            <a href="../index.html" class="logo"><img src="../img/logopaella12.png"></a>
            <nav>
                <a href="../register/index.html" class="pago"><strong>REGISTRARSE</strong></a>
                <div class="desplegable">
                    <a class="Doc" ><strong>DOCUMENTACIÓN↓</strong></a>
                    <div class="submenu">
                        <a href="../manual/index.html">Manual</a>
                        <a href="../nosotros/index.html" class="link-cabecera"><strong>NOSOTROS</strong></a>
                    </div>
                </div>
            </nav>
        </header>

        <h1 class="bodylogin">INICIE SESIÓN</h1>
        <form method="POST">
            <i class="fa-solid fa-user"></i>
            <p class="plogin"><label for="nickname">Correo</label>
            <input type="email" name="email" placeholder="Nombre de usuario"></p>
        
            <i class="fa-solid fa-unlock"></i>
            <p class="plogin"><label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="******"></p>
        
            <p class="plogin"><input class="submit" type="submit" value="Acceder"></p>
        
        </form>

        <?php
            require 'vendor/autoload.php';
            use Firebase\JWT\JWT;
            use Firebase\JWT\Key;


            $user = "paella";
            $passwddb = "@P4ssw0rd";

            $enlace = new PDO("mysql:host=localhost;dbname=users", $user, $passwddb);


            $nombre = $_POST['nickname'];
            $apellidos = $_POST['secname'];
            $mail = $_POST['mail'];
            $passwd = $_POST['password'];


            if (empty($_POST["email"])) {
                $error = 'Porfavor, introduzca un correo';
            } else if(empty($_POST["password"])){
                $error = 'Porfavor, introduzca una contraseña';
            } else {
                $query = "SELECT * FROM listado_usuarios WHERE correo = ?";
                $statment = $enlace->prepare($query);
                $statment->execute([$_POST["email"]]);
                $data = $statment->fetch(PDO::FETCH_ASSOC);

                if($data){
                    if($data['user_password'] == $_POST['passwd']){
                        $key = 'GKoqW2GLc2YCs3xNikcRTppQek9L_NpQZsNZjBpZxfkrBtM1euveQKSOxBupPQ27Ee0ohTtqXndX5vxYpAvi1x3pRHRONvvwK7OoAM4fhXjTtdxLvZIEhN6JwjZQbBVUldcf8CWqcOwYujXyP-iaU9Hw5BTtuLnsW7NNbRgZzxhAYarcp_MeuM3GEAZscEZVv8OoJZwtNbtJwowmesZ-eqEDH-iOi6Qq3y5Y6qP9eDOg3NeNuoJBqum24Pq2wQRQvMsaxqO7YKDKdS6vaLDONRNykOIoQOCZj1ZDccOMyUE6N-waI4pFYnOP6SjdxAjxzbc1EPmsYVAtJ2TTJuUaC0a6jBwGpO-6YWdQ5bkfsJzBz9SZ0gYYBKWzni6nVvSZekMELXAZcSIpS57WCF-DunFK-z_1PSbcPloK2X4MHFV-pKsOQDiE9kD8Tme9ZpQIKys9jd0iogZrZDm2_tkbq-hPAKseBOegNbhv92c2hhCBM18o3O71eL5Dqy60lQyB';
                        $token = JWT::encode(
                            array(
                                'iat'       =>  time(),
                                'nbf'       =>  time(),
                                'exp'       =>  time() + 3600,
                                'data'      =>  array(
                                    'user_id'   =>  $data['user_id'],
                                    'user_name' =>  $data['user_name']
                                )
                                ),
                                $key,
                                'PS256'
                            );
                            setcookie("token", $token, time() + 3600, "/", "", true, true);
                            header('location:login.php');
                        } else {
                            $error = "Contraseña incorrecta";
                        }
                    } else {
                        $error = "Email incorrecto";
                    }
                }

        ?>


    </div>





    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="columna">
                <figure>
                    <a href="#"><img src="../img/logopaella12.png"></a>
                </figure>
            </div>
            <div class="columna">
                <h2>CONTACTO</h2><br>
                <a href="mailto:paellavpn@gmail.com" class="correo">paellavpn@gmail.com</a><br><br>
                <h2>APOYANOS</h2><br>
                <a href="https://www.paypal.me/Unaipi193" class="correo">PaellaVPN paypal</a><br><br>
            </div>
            <div class="columna">
                <h2>COLABORADORES</h2><br>
                <a href="https://fp.institutmvm.cat" target="_blank"><img src="../img/logomvm2-removebg-preview.png" alt="Logo del instituto"></a>
            </div>
        </div>
    </footer>


</body>
</html>