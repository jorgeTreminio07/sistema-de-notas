<!DOCTYPE html>
<?php
require 'functions.php';

$permisos = ['Administrador','Profesor','Padre', 'Alumno'];
permisos($permisos);
//consulta las materias
$materias = $conn->prepare("select * from materias");
$materias->execute();
$materias = $materias->fetchAll();

//consulta de grados
$grados = $conn->prepare("select * from grados");
$grados->execute();
$grados = $grados->fetchAll();

//consulta las secciones
$secciones = $conn->prepare("select * from secciones");
$secciones->execute();
$secciones = $secciones->fetchAll();
?>
<html>
<head>
    <title>Notas | Registro de Notas</title>
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
        <li class="active"><a href="listadonotas.view.php">Consulta de Notas</a> </li>

        <?php
            if ($_SESSION['rol'] == 'Administrador') {
                // Imprimir las etiquetas <li>
                echo '<li><a href="alumnos.view.php">Registro de Alumnos</a></li>';
                echo '<li><a href="listadoalumnos.view.php">Listado de Alumnos</a></li>';
                echo '<li><a href="notas.view.php">Registro de Notas</a></li>';
            }
            ?>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
    <h3>
        <?php
        if(isset($_GET['consultar'])){
            $id_materia = $_GET['materia'];
            $id_grado = $_GET['grado'];
            $id_seccion = $_GET['seccion'];

            // Obtener el nombre del grado
            $gradoSeleccionado = ""; // Inicializa la variable
            foreach ($grados as $grado) {
                if ($grado['id'] == $id_grado) {
                    $gradoSeleccionado = $grado['nombre'];
                    break; // Detener el bucle una vez que se encuentre el grado
                }
            }

            // Obtener el nombre de la materia
            $materiaSeleccionada = ""; // Inicializa la variable
            foreach ($materias as $materia) {
                if ($materia['id'] == $id_materia) {
                    $materiaSeleccionada = $materia['nombre'];
                    break; // Detener el bucle una vez que se encuentre la materia
                }
            }

            // Obtener el nombre de la sección
            $seccionSeleccionada = ""; // Inicializa la variable
            foreach ($secciones as $seccion) {
                if ($seccion['id'] == $id_seccion) {
                    $seccionSeleccionada = $seccion['nombre'];
                    break; // Detener el bucle una vez que se encuentre la sección
                }
            }

            echo "<h3>Consulta de Notas</h3> <h3>-Tecnico: " . $gradoSeleccionado . "<br>-Materia: " . $materiaSeleccionada . "<br>-Sección: " . $seccionSeleccionada;
        } else {
            echo "<h3>Consulta de Notas</h3>";
        }
        ?>
    </h3>
        <?php
        if(!isset($_GET['consultar'])){
            ?>
            <form method="get" class="form" action="listadonotas.view.php">
                <label>Seleccione el Técnico</label><br>
                <select name="grado" required>
                    <?php foreach ($grados as $grado):?>
                        <option value="<?php echo $grado['id'] ?>"><?php echo $grado['nombre'] ?></option>
                    <?php endforeach;?>
                </select>
                <br><br>
                <label>Seleccione la Materia</label><br>
                <select name="materia" required>
                    <?php foreach ($materias as $materia):?>
                        <option value="<?php echo $materia['id'] ?>"><?php echo $materia['nombre'] ?></option>
                    <?php endforeach;?>
                </select>

                <br><br>
                <label>Seleccione la Sección</label><br><br>

                <?php foreach ($secciones as $seccion):?>
                    <input type="radio" name="seccion" required value="<?php echo $seccion['id'] ?>">Sección <?php echo $seccion['nombre'] ?>
                <?php endforeach;?>

                <br><br>
                <button type="submit" name="consultar" value="1">Consultar Notas</button></a>
                <br><br>
            </form>
            <?php
        }
        ?>
        <hr>
        
        <?php
        if(isset($_GET['consultar'])){
            $id_materia = $_GET['materia'];
            $id_grado = $_GET['grado'];
            $id_seccion = $_GET['seccion'];
            

            //extrayendo el numero de evaluaciones para esa materia seleccionada
            $num_eval = $conn->prepare("select num_evaluaciones from materias where id = ".$id_materia);
            $num_eval->execute();
            $num_eval = $num_eval->fetch();
            $num_eval = $num_eval['num_evaluaciones'];

            if ($_SESSION['rol'] == 'Administrador') {
                // Imprimir las etiquetas <li>
                $sqlalumnos = $conn->prepare("select a.id, a.num_lista, a.apellidos, a.nombres, b.nota,b.observaciones, avg(b.nota) as promedio from alumnos as a left join notas as b on a.id = b.id_alumno
                                                where id_grado = ".$id_grado." and id_seccion = ".$id_seccion." group by a.id");
            } else {
                // imprimir los datos segundo el nombre de usuario
                $sqlalumnos = $conn->prepare("select a.id, a.num_lista, a.apellidos, a.nombres, b.nota,b.observaciones, avg(b.nota) as promedio from alumnos as a left join notas as b on a.id = b.id_alumno
                                                where id_grado = ".$id_grado." and id_seccion = ".$id_seccion." and a.nombres = '".$_SESSION["username"]."' group by a.id");
            }
            
            $sqlalumnos->execute();
            $alumnos = $sqlalumnos->fetchAll();
            $num_alumnos = $sqlalumnos->rowCount();
            $promediototal = 0.0;

            ?>
            <form action="listadonotas.view.php">
                <button type="submit" class="btn"><-Volver</button>
            </form>
            <br>
            
            <br>
            <br>


                <table class="table" cellpadding="0" cellspacing="0">
                    <tr>
                        <th>No de lista</th><th>Apellidos</th><th>Nombres</th>
                        <?php
                        for($i = 1; $i <= $num_eval; $i++){
                            echo '<th>Parcial '.$i .'</th>';
                        }
                        ?>
                        <th>Promedio</th>
                        <th>Observaciones</th>
                    </tr>
                    <?php foreach ($alumnos as $index => $alumno) :?>
                        <!-- campos ocultos necesarios para realizar el insert-->
                        <tr>
                            <td align="center"><?php echo $alumno['num_lista'] ?></td><td><?php echo $alumno['apellidos'] ?></td>
                            <td><?php echo $alumno['nombres'] ?></td>
                            <?php

                                //escribiendo las notas en columnas
                                $notas = $conn->prepare("select id, nota from notas where id_alumno = ".$alumno['id']." and id_materia = ".$id_materia);
                                $notas->execute();
                                $notas = $notas->fetchAll();

                                foreach ($notas as $eval => $nota) {

                                    echo '<td align="center"><input type="hidden" 
                                            name="nota'.$eval.'" value="'. $nota['nota'] . '" >'. $nota['nota'] . '</td>';

                                }

                            echo '<td align="center">'.number_format($alumno['promedio'], 2).'</td>';
                            //echo '<td><a href="notas.view.php?grado='.$id_grado.'&materia='.$id_materia.'&seccion='.$id_seccion.'">Editar</a> </td>';
                            $promediototal += number_format($alumno['promedio'], 2);
                            echo '<td>'. $alumno['observaciones']. '</td>';
                            ?>

                        </tr>
                    <?php endforeach;?>
                    <td colspan="3">
                        <?php
                        if ($num_alumnos > 0) {
                            for ($i = 0; $i < $num_eval; $i++) {
                                echo '<td><div class="text-center" id="promedio' . $i . '"></div></td>';
                            }
                            echo '<td align="center">' . number_format($promediototal / $num_alumnos, 2) . '</td>';
                        } else {
                            echo '<td colspan="' . ($num_eval + 1) . '">Aun no se han agregado las notas</td>';
                        }
                        ?>
                    </td>
                </table>

                <br>


        <?php
        }
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php
    for($i = 0; $i < $num_eval; $i++) {
        echo 'var values'.$i.' = [];
        var promedio'.$i.';
        var valor'.$i.' = 0;
        var nota'.$i.' = document.getElementsByName("nota'.$i.'");
        for(var i = 0; i < nota'.$i.'.length; i++) {
            valor'.$i.' += parseFloat(nota'.$i.'[i].value);
        }
        promedio'.$i.' = (valor'.$i.' / parseFloat(nota'.$i.'.length));
        document.getElementById("promedio'.$i.'").innerHTML = (promedio'.$i.').toFixed(2);';
    }
    ?>
});
</script>

</html>