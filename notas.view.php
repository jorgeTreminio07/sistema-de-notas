<!DOCTYPE html>
<?php
require 'functions.php';
//arreglo de permisos
$permisos = ['Administrador','Profesor'];
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
        <li><a href="listadonotas.view.php">Consulta de Notas</a> </li>
        <li><a href="alumnos.view.php">Registro de Alumnos</a> </li>
        <li><a href="listadoalumnos.view.php">Listado de Alumnos</a> </li>
        <li class="active"><a href="notas.view.php">Registro de Notas</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>

    </ul>
</nav>

<div class="body">
    <div class="panel">
    <h3>
        <?php
        if(isset($_GET['revisar'])){
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

            echo "<h2>Registro y Modificación de Notas</h2> <br>-Tecnico: " . $gradoSeleccionado . "<br>-Materia: " . $materiaSeleccionada . "<br>-Sección: " . $seccionSeleccionada;
        } else {
            echo "Registro y Modificación de Notas";
        }
        ?>
    </h3>
           <?php
           if(!isset($_GET['revisar'])){
               ?>

            <form method="get" class="form" action="notas.view.php">
                <label>Seleccione la Carrera Técnica</label><br>
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
                <label>Seleccione la Sección</label><br>

                <?php foreach ($secciones as $seccion):?>
                    <input type="radio" name="seccion" required value="<?php echo $seccion['id'] ?>">Sección <?php echo $seccion['nombre'] ?>
                <?php endforeach;?>

                <br><br>
                <button type="submit" name="revisar" value="1">Ingresar Notas</button> <a class="btn-link" href="listadonotas.view.php">Consultar Notas</a>
                <br><br>
            </form>
        <?php
           }
        ?>
        <hr>

        <?php
        if(isset($_GET['revisar'])){
            $id_materia = $_GET['materia'];
            $id_grado = $_GET['grado'];
            $id_seccion = $_GET['seccion'];

            //extrayendo el numero de evaluaciones para esa materia seleccionada
            $num_eval = $conn->prepare("select num_evaluaciones from materias where id = ".$id_materia);
            $num_eval->execute();
            $num_eval = $num_eval->fetch();
            $num_eval = $num_eval['num_evaluaciones'];


            //mostrando el cuadro de notas de todos los alumnos del grado seleccionado
            $sqlalumnos = $conn->prepare("select a.id, a.num_lista, a.apellidos, a.nombres, b.nota, avg(b.nota) as promedio, b.observaciones from alumnos as a left join notas as b on a.id = b.id_alumno
 where id_grado = ".$id_grado." and id_seccion = ".$id_seccion." group by a.id");
            $sqlalumnos->execute();
            $alumnos = $sqlalumnos->fetchAll();
            $num_alumnos = $sqlalumnos->rowCount();

            ?>
            <br>
            <form action="notas.view.php">
                <button type="submit" class="btn"><-Volver</button>
            </form>
            <br>
            <br>
                <form action="procesarnota.php" method="post">

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
                    <th>Eliminar</th>
                </tr>
                <?php foreach ($alumnos as $index => $alumno) :?>
                    <!-- campos ocultos necesarios para realizar el insert-->
                    <input type="hidden" value="<?php echo $num_alumnos ?>" name="num_alumnos">
                    <input type="hidden" value="<?php echo $alumno['id'] ?>" name="<?php echo 'id_alumno'.$index ?>">
                    <input type="hidden" value="<?php echo $num_eval ?>" name="num_eval">
                     <!-- campos para devolver los parametros en el get y mantener los mismos datos al hacer el header location-->
                    <input type="hidden" value="<?php echo $id_materia ?>" name="id_materia">
                    <input type="hidden" value="<?php echo $id_grado ?>" name="id_grado">
                    <input type="hidden" value="<?php echo $id_seccion ?>" name="id_seccion">
                    <tr>
                        <td align="center"><?php echo $alumno['num_lista'] ?></td><td><?php echo $alumno['apellidos'] ?></td>
                        <td><?php echo $alumno['nombres'] ?></td>
                        <?php
                           if(existeNota($alumno['id'],$id_materia,$conn) > 0){
                                //ya tiene notas registradas
                                $notas = $conn->prepare("select id, nota from notas where id_alumno = ".$alumno['id']." and id_materia = ".$id_materia);
                                $notas->execute();
                                $registrosnotas = $notas->fetchAll();
                                $num_notas = $notas->rowCount();
                                foreach ($registrosnotas as $eval => $nota){
                                    echo '<input type="hidden" value="'.$nota['id'].'" name="idnota' . $eval .'alumno' . $index . '">';
                                    echo '<td><input type="text" maxlength="5" value="'.$nota['nota'].'" name="evaluacion' . $eval . 'alumno' . $index . '" class="txtnota"></td>';
                                }
                                if($num_eval > $num_notas){
                                    $dif = $num_eval - $num_notas;

                                    for($i = $num_notas; $i < $dif + $num_notas; $i++) {
                                        echo '<input type="hidden" value="'.$nota['id'].'" name="idnota' . $i .'alumno' . $index . '">';
                                        echo '<td><input type="text" maxlength="5" value="'.$nota['nota'].'" name="evaluacion' . $i . 'alumno' . $index . '" class="txtnota"></td>';
                                    }
                                }


                            }else {
                                //extrayendo el numero de evaluaciones para esa materia seleccionada
                                for($i = 0; $i < $num_eval; $i++) {
                                    echo '<td><input type="text" maxlength="5" name="evaluacion' . $i . 'alumno' . $index . '" class="txtnota"></td>';
                                }
                            }

                            echo '<td align="center">'.number_format($alumno['promedio'], 2).'</td>';

                            if(existeNota($alumno['id'],$id_materia,$conn) > 0){
                                echo '<td><input type="text" maxlength="100" value="'.$alumno['observaciones'].'" name="observaciones' . $index . '" class="txtnota"></td>';
                            }else {
                                echo '<td><input type="text" name="observaciones' . $index . '" class="txtnota"></td>';
                            }

                        if(existeNota($alumno['id'],$id_materia,$conn) > 0){
                            echo '<td><a href="notadelete.php?idalumno='.$alumno['id'].'&idmateria='.$id_materia.'">Eliminar</a> </td>';
                        }else{
                            echo '<td>Sin notas</td>';
                        }
                        ?>
                    </tr>
                <?php endforeach;?>
                <tr></tr>
            </table>
                <br>
                <button type="submit" name="insertar">Guardar</button> <button type="reset">Limpiar</button> <a class="btn-link" href="listadonotas.view.php">Consultar Notas</a>
                <br>
            </form>
        <?php }

        ?>
                <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al almacenar el registro</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Registro almacenado correctamente!</span>';
                ?>

            </form>
        <?php
        if(isset($_GET['err']))
            echo '<span class="error">Error al guardar, Nota invalida parcial 1</span>';
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