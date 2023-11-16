<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador','Profesor','Alumno'];
permisos($permisos);

?>
<html>
<head>
<title>Inicio | Registro de Notas</title>
    <meta name="description" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header2">
        <div class="box"><img class="logo1header" src="logo.png"></div>
        <div class="box"><h1>Sistema Gesti&oacute;n Acad&eacute;mica <br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp INATEC
        <h2> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Usuario:  <?php echo $_SESSION["username"] ?></h2></h1></div>
        <div class="box"><img class="logo2header" src="logogob.png"></div>         
</div>
<nav>
    <ul>
        <li class="active"><a href="inicio.view.php">Inicio</a> </li>
        <?php
            if ($_SESSION['rol'] == 'Administrador') {
                // Imprimir las etiquetas <li>
                echo '<li><a href="listadonotas.view.php">Consulta de Notas</a> </li>';
                echo '<li><a href="alumnos.view.php">Registro de Alumnos</a></li>';
                echo '<li><a href="listadoalumnos.view.php">Listado de Alumnos</a></li>';
                echo '<li><a href="notas.view.php">Registro de Notas</a></li>';
            }else{
                echo '<li><a href="resultados.php">Consulta de Notas</a> </li>';
            }
            ?>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    
    <div class="panel">
        <a href="https://www.tecnacional.edu.ni/" class="imglogo"><img class="logo" src="logo.png"></a>
        <div class="iniciosocial">
        <div class="icosocial"><a href="https://www.facebook.com/TecNacional"><img src="facebookicon.png" class="rebote"></a></div>
        <div class="icosocial"><a href="https://twitter.com/TecNacional"><img src="twitericon.png" class="rebote"></a></div>
        <div class="icosocial"><a href="https://www.instagram.com/tecnacional/?hl=es"><img src="igicon.png" class="rebote"></a></div>
        <div class="icosocial"><a href="https://www.youtube.com/user/TecnologicoNacional"><img src="youtubeicon.png" class="rebote"></a></div>
    </div>
        
        
        <?php
        if(isset($_GET['err'])){
            echo '<h3 class="error text-center">ERROR: Usuario no autorizado</h3>';
        }
        ?>
    </div>
</div>

<footer>
<div class="content text-center">
          Capacitación y Educación Técnica Gratuita y de Calidad. <br>
          Dirección: Centro Cívico Zumen, frente al Hospital Bertha Calderón, Managua. <br>
          Teléfonos: Planta Central 2253-8830, Atención al Protagonista 2253-8888
</div>
</footer>

</body>

</html>