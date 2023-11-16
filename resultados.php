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
        <h2> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  Usuario:  <?php echo $_SESSION["username"] ?></h2></h1></div>
        <div class="box"><img class="logo2header" src="logogob.png"></div>         
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li class="active"><a href="resultados.php">Consulta de Notas</a> </li>
        <?php
            if ($_SESSION['rol'] == 'Administrador') {
                // Imprimir las etiquetas <li>
                echo '<li><a href="listadonotas.view.php">Consulta de Notas</a> </li>';
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
    <center><h1>Jorge Eduardo Treminio Cruz</h1> <h2>Carrera: Técnico General en Contabilidad</h2></center>

    <table class="table" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        </th><th>Componentes</th>
                        <th>I Parcial</th><th>II Parcial</th><th>III Parcial</th><th>IV Parcial</th><th>Nota final</th>
                        <th>Observaciones</th>
                    </tr>
                                            <!-- campos ocultos necesarios para realizar el insert-->
                        <tr>
                            <td>Adaptación al cambio climático</td>
                            <td align="center"><input type="hidden" name="nota0" value="78">78</td><td align="center"><input type="hidden" name="nota1" value="89">89</td><td align="center"><input type="hidden" name="nota2" value="90">90</td><td align="center"><input type="hidden" name="nota3" value="67">67</td><td align="center">81</td><td></td>
                        </tr>
                                            <!-- campos ocultos necesarios para realizar el insert-->
                        <tr>
                            <td>Cultura Emprendedora</td>
                            <td align="center"><input type="hidden" name="nota0" value="56">56</td><td align="center"><input type="hidden" name="nota1" value="45">45</td><td align="center"><input type="hidden" name="nota2" value="67">67</td><td align="center"><input type="hidden" name="nota3" value="78">78</td><td align="center">61.5</td><td>Hay que mejorar</td>
                        </tr>
                                            <!-- campos ocultos necesarios para realizar el insert-->
                        <tr>
                            <td>Gestión de Calidad</td>
                            <td align="center"><input type="hidden" name="nota0" value="60">60</td><td align="center"><input type="hidden" name="nota1" value="70">70</td><td align="center"><input type="hidden" name="nota2" value="80">80</td><td align="center"><input type="hidden" name="nota3" value="90">90</td><td align="center">75</td><td></td>
                        </tr>
                                            <!-- campos ocultos necesarios para realizar el insert-->
                        <tr>
                            <td>Higiene y seguridad del trabajo</td>
                            <td align="center"><input type="hidden" name="nota0" value="89">89</td><td align="center"><input type="hidden" name="nota1" value="67">67</td><td align="center"><input type="hidden" name="nota2" value="78">78</td><td align="center"><input type="hidden" name="nota3" value="56">56</td><td align="center">72.5</td><td></td>
                        </tr>
                                            <!-- campos ocultos necesarios para realizar el insert-->
                        <tr>
                            <td>Orientación laboral</td>
                            <td align="center"><input type="hidden" name="nota0" value="77">77</td><td align="center"><input type="hidden" name="nota1" value="75">75</td><td align="center"><input type="hidden" name="nota2" value="67">67</td><td align="center"><input type="hidden" name="nota3" value="89">89</td><td align="center">77</td><td></td>
                        </tr>
                        </tbody></table>

                        <center><h2><p>Indice Academico: 73.4 </p></h2></center>
    </div>
    
        
        <?php
        if(isset($_GET['err'])){
            echo '<h3 class="error text-center">ERROR: Usuario no autorizado</h3>';
        }
        ?>
        <button id="printButton" onclick="imprimirPagina()">Imprimir</button>

    <script>
        function imprimirPagina() {
        window.print();
        }
</script>
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