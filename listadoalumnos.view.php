<?php
require 'functions.php';

$permisos = ['Administrador','Profesor'];
permisos($permisos);
//consulta los alumnos para el listaddo de alumnos
$alumnos = $conn->prepare("select a.id, a.num_lista, a.nombres, a.apellidos, a.genero, b.nombre as grado, c.nombre as seccion from alumnos as a inner join grados as b on a.id_grado = b.id inner join secciones as c on a.id_seccion = c.id order by a.apellidos");
$alumnos->execute();
$alumnos = $alumnos->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Listado de Alumnos | Registro de Notas</title>
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
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="listadonotas.view.php">Consulta de Notas</a> </li>
        <li><a href="alumnos.view.php">Registro de Alumnos</a> </li>
        <li class="active"><a href="listadoalumnos.view.php">Listado de Alumnos</a> </li>
        <li><a href="notas.view.php">Registro de Notas</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>

    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Alumnos ingresados recientemente</h4>
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>No de<br>lista</th><th>Apellidos</th><th>Nombres</th><th>Genero</th><th>Técnico</th><th>Sección</th>
                    <th>Editar</th><th>Eliminar</th>
                </tr>
                <?php foreach ($alumnos as $alumno) :?>
                <tr>
                    <td align="center"><?php echo $alumno['num_lista'] ?></td><td><?php echo $alumno['apellidos'] ?></td>
                    <td><?php echo $alumno['nombres'] ?></td><td align="center"><?php echo $alumno['genero'] ?></td>
                    <td align="center"><?php echo $alumno['grado'] ?></td><td align="center"><?php echo $alumno['seccion'] ?></td>
                    <td><a href="alumnoedit.view.php?id=<?php echo $alumno['id'] ?>">Editar</a> </td>
                    <td><a href="alumnodelete.php?id=<?php echo $alumno['id'] ?>">Eliminar</a> </td>
                </tr>
                <?php endforeach;?>
            </table>
                <br><br>

                <a class="btn-link" href="alumnos.view.php">Agregar Alumno</a>
                <br><br>
                <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al almacenar el registro</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Registro almacenado correctamente!</span>';
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