<?php
//arreglo con mensajes que puede recibir
$messages = [
    "1" => "Credenciales incorrectas",
    "2" => "No ha iniciado sesión"
];
?>
<!DOCTYPE html>
<html>
<head>
<title>Login | Registro de Notas</title>
    <meta name="description" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>

<div class="header">
        <div class="box"><img class="logo1header" src="logo.png"></div>
        <div class="content text-center"><h1>Sistema Gesti&oacute;n Acad&eacute;mica <br>INATEC</h1></div>
        <div class="box"><img class="logo2header" src="logogob.png"></div>     
</div>

<div class="body">
    <div class="panel-login">
            <h4>Inicio de Sesion</h4>
            <form method="post" class="form" action="login_post.php">
                <label>Usuario</label><br>
                <input type="text" name="username">
                <br>
                <label>Contraseña</label><br>
                <input type="password" name="password">
                <br><br>
                <button type="submit">Entrar</button>
            </form>
        <?php
        if(isset($_GET['err']) && is_numeric($_GET['err']) && $_GET['err'] > 0 && $_GET['err'] < 3 )
            echo '<span class="error">'.$messages[$_GET['err']].'</span>';
        ?>
        </div>
</div>

<footer>
<div class="container ultimod">
    <div class="content text-center">
          Capacitación y Educación Técnica Gratuita y de Calidad. <br>
          Dirección: Centro Cívico Zumen, frente al Hospital Bertha Calderón, Managua. <br>
          Teléfonos: Planta Central 2253-8830, Atención al Protagonista 2253-8888
    </div>
    <div class="footersocial">
        <div class="ico"><a href="https://www.facebook.com/TecNacional"><img src="facebookicon.png"></a></div>
        <div class="ico"><a href="https://twitter.com/TecNacional"><img src="twitericon.png"></a></div>
        <div class="ico"><a href="https://www.instagram.com/tecnacional/?hl=es"><img src="igicon.png"></a></div>
        <div class="ico"><a href="https://www.youtube.com/user/TecnologicoNacional"><img src="youtubeicon.png"></a></div>
    </div>
</div>

</footer>

</body>

</html>