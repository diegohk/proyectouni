<!DOCTYPE html>
<html lang="es-col">
<head>
   
    <!-- Title -->
    <title>Votacion</title>
    <!-- Metadatos -->
    <meta charset="utf-8">
    <meta name="author" content="---">
    <meta name="copyright" content="---">
    <meta name="keywords" content="---">
    <meta name="description" name="---">
    <!-- link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS-CODE/stylesGlobals.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Aldrich&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Advent+Pro:wght@100;200;300;400;500;600;700;800&display=swap">
    <style>
        .header__h3-mar{
            margin-left:30px;
        }
    </style>
</head>
<body class="body">
<?php
    include("conexion\conexion.php");
    session_start();
        echo $_SESSION['ID'];
        $ID = $_SESSION['ID'];    
        $consultaDatos = "SELECT * FROM votantes WHERE idVotante = '$ID' ";
            $queryDatos = $conexion->query($consultaDatos);
            $datoUser = $queryDatos->fetch_assoc();
            $nombreUser = $datoUser['nombre'];
            $cedulaUser = $datoUser['cedula'];
            $voto = $datoUser['voto'];
            $foto = $datoUser['foto'];  
            $imagenBase64 = base64_encode($foto);
       
    ?>
    <header class="header">
    <a class="returnA" href=".."> Regresar </a>
    <div class="header__div-h2">
        <h2 class="header__h2">Sistema de Votacion</h2>
    </div>  
    <div class="header__div-perfil">
        <img class="header__img" src="data: png;base64,<?php echo $imagenBase64; ?>">
        <?php echo "<h3 class='header__h3'>".$nombreUser."</h3>";?>
    </div>
    <hr class="style__hr">
    </header>
    <main class="main">
    <h2 class="header__h3 header__h3-mar"> Alcaldes </h2>
    <section class="section-alcalde">
    <div class="alcalde-section__div">
       
        <?php
        $consultaralcalde = "SELECT * FROM candidatos WHERE puesto = 'alcalde'";
        $consultaralcaldeQuery = $conexion->query($consultaralcalde);
        while ($consultaFilas = $consultaralcaldeQuery->fetch_assoc()) {
            $IDC = $consultaFilas['id'];
            $nombreC = $consultaFilas['nombre'];
            $apellidoC = $consultaFilas['apellido'];
            $fotoC = $consultaFilas['foto'];
            $imagenBase64A = base64_encode($fotoC);
        ?>


        <div class="alcalde-section__div-indiv">
            <img class="alcalde-section__img" src="data: png;base64,<?php echo $imagenBase64A; ?>">
            <br>
            <h4 class="alcalde-section__h4-n"> <?php echo $nombreC . " " . $apellidoC ?> </h4>
            <br>
            <form method="post">
                <input type="hidden" name="candidato_id" value="<?php echo $IDC; ?>">
                <input class="alcalde-section__input" type="submit" name="votar_alcalde_<?php echo $IDC; ?>" value="Votar">
            </form>
            <?php
            if (isset($_POST['votar_alcalde_'.$IDC])) {
                // Verificar si el usuario ya votó por un alcalde
                $consultaVotoAlcalde = "SELECT COUNT(*) as total FROM votos WHERE idVotante = '$ID' AND tipo = 'alcalde'";
                $queryVotoAlcalde = $conexion->query($consultaVotoAlcalde);
                $datoVotoAlcalde = $queryVotoAlcalde->fetch_assoc();
                $votoAlcalde = $datoVotoAlcalde['total'];

                if ($votoAlcalde == 0) {
                    // Insertar voto del alcalde
                    $insertarVotoAlcalde = "INSERT INTO votos (idVotante, candidato_id, tipo) VALUES ('$ID', '$IDC', 'alcalde')";
                    if ($conexion->query($insertarVotoAlcalde) === TRUE) {
                        // Consulta para incrementar el voto del candidato seleccionado
                        $incrementarVoto = "UPDATE candidatos SET voto = voto + 1 WHERE id = '$IDC'";
                       
                        // Ejecutar la consulta para incrementar el voto
                        if ($conexion->query($incrementarVoto) === TRUE) {
                            echo "<h1>Votaste por: $nombreC $apellidoC </h1>";
                        } else {
                            echo "Error al votar: " . $conexion->error;
                        }
                    } else {
                        echo "Error al votar: " . $conexion->error;
                    }
                } else {
                    echo "<p>Solo puedes votar por un alcalde.</p>";
                }
            }
            ?>
        </div>


        <?php
        }
        ?>
    </div>
</section>


        <br><br>
        <hr class="style__hr">
        <br><br>
        <!--
            =========================================================================================
            =========================================================================================      
        -->
        <h2 class="header__h3 header__h3-mar"> Consejal </h2>
        <section class="section-alcalde section-alcalde-concejal">
            <div class="alcalde-section__div">
           
                <?php
                $consultarconsejal = "SELECT * FROM candidatos WHERE puesto = 'consejal'";
                $consultarconsejalQuery = $conexion->query($consultarconsejal);
                while ($consultaFilas2 = $consultarconsejalQuery->fetch_assoc()) {
                    $IDCo = $consultaFilas2['id'];
                    $nombreCo = $consultaFilas2['nombre'];
                    $apellidoCo = $consultaFilas2['apellido'];
                    $fotoCo = $consultaFilas2['foto'];
                    $imagenBase64AC = base64_encode($fotoCo);
                ?>


                <div class="alcalde-section__div-indiv alcalde-section__div-indiv-con">
                    <img class="alcalde-section__img" src="data: png;base64,<?php echo $imagenBase64AC; ?>">
                    <br>
                    <h4 class="alcalde-section__h4-n"> <?php echo $nombreCo . " " . $apellidoCo ?> </h4>
                    <br>
                    <form method="post">
                        <input type="hidden" name="candidato_id_con" value="<?php echo $IDCo; ?>">
                        <input class="alcalde-section__input" type="submit" name="votar_concejal_<?php echo $IDCo; ?>" value="Votar">
                    </form>
                    <?php
                    if (isset($_POST['votar_concejal_'.$IDCo])) {
                        // Verificar si el usuario ya votó por un concejal
                        $consultaVotoConcejal = "SELECT COUNT(*) as total FROM votos WHERE idVotante = '$ID' AND tipo = 'concejal'";
                        $queryVotoConcejal = $conexion->query($consultaVotoConcejal);
                        $datoVotoConcejal = $queryVotoConcejal->fetch_assoc();
                        $votoConcejal = $datoVotoConcejal['total'];

                        if ($votoConcejal == 0) {
                            // Insertar voto del concejal
                            $insertarVotoConcejal = "INSERT INTO votos (idVotante, candidato_id, tipo) VALUES ('$ID', '$IDCo', 'concejal')";
                            if ($conexion->query($insertarVotoConcejal) === TRUE) {
                                // Consulta para incrementar el voto del candidato seleccionado (Concejal)
                                $incrementarVotoConcejal = "UPDATE candidatos SET voto = voto + 1 WHERE id = '$IDCo'";
                                
                                // Ejecutar la consulta para incrementar el voto (Concejal)
                                if ($conexion->query($incrementarVotoConcejal) === TRUE) {
                                    echo "<h1>Votaste por: $nombreCo $apellidoCo </h1>";
                                } else {
                                    echo "Error al votar: " . $conexion->error;
                                }
                            } else {
                                echo "Error al votar: " . $conexion->error;
                            }
                        } else {
                            echo "<p>Solo puedes votar por un concejal.</p>";
                        }
                    }
                    ?>
                </div>


                <?php
                }
                ?>
            </div>
        </section>
    </main>
    <?php
    ?>
</body>
</html>
