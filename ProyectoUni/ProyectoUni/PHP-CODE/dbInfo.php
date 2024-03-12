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
    <link rel="stylesheet" type="text/css" href="../CSS-CODE/dbCSS.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Aldrich&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Advent+Pro:wght@100;200;300;400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Rubik+Broken+Fax&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesIndex.css">
</head>
<body>
    <main>
    <a class="returnA" href=".."> Regresar </a>
        <table>
            <thead class="tab-head">
                <tr class="thead-tr">
                    <th colspan="4" class="thead-th thead-th-title"> Candidatos Alacalde</th>
                </tr>
                <tr class="thead-tr">
                    <th class="thead-th">Imagen</th>
                    <th class="thead-th">Nombre</th>
                    <th class="thead-th">Apellido</th>
                    <th class="thead-th">Votos</th>
                </tr>
            </thead>
            <tbody class="tab-body">
                <?php
                    include("conexion\conexion.php");
                    $selectAlcalde = "SELECT * FROM candidatos WHERE puesto = 'alcalde'";
                    $consultaralcaldeQuery = $conexion->query($selectAlcalde);

                    while ($consultaAlcalde = $consultaralcaldeQuery->fetch_assoc()) {
                        $nombreC = $consultaAlcalde['nombre'];
                        $apellidoC = $consultaAlcalde['apellido'];
                        $fotoC = $consultaAlcalde['foto'];
                        $imagenBase64A = base64_encode($fotoC);
                        $voto = $consultaAlcalde['voto'];
                ?>
                    <tr class="datos">
                        <th class="imgTab"> 
                        <img class="alcalde-section__img" src="data: png;base64,<?php echo $imagenBase64A; ?>">
                        </th>
                        <th class="nomTab" >
                            <span class="nomTab-span"> 
                                <?php  echo $nombreC; ?>
                            </span>
                        </th>
                        <th class="apeTab">
                            <span class="apeTab-span"> 
                                <?php  echo $apellidoC; ?>
                            </span>
                        </th>
                        <th class="votoTab">
                            <span class="votoTab-span"> 
                                <?php  echo $voto; ?>
                            </span>
                        </th>
                    </tr>
                    <?php 
                    }
                    ?>
            </tbody>
        </table>

        <br><br><br><br><br>

        <table>
            <thead class="tab-head">
                <tr class="thead-tr">
                    <th colspan="4" class="thead-th thead-th-title"> Candidatos Consejal</th>
                </tr>
                <tr class="thead-tr">
                    <th class="thead-th">Imagen</th>
                    <th class="thead-th">Nombre</th>
                    <th class="thead-th">Apellido</th>
                    <th class="thead-th">Votos</th>
                </tr>
            </thead>
            <tbody class="tab-body">
                <?php
                    include("conexion\conexion.php");
                    $selectConsejal = "SELECT * FROM candidatos WHERE puesto = 'consejal'";
                    $consultarconsejalQuery = $conexion->query($selectConsejal);

                    while ($selectconsejal = $consultarconsejalQuery->fetch_assoc()) {
                        $nombreCc = $selectconsejal['nombre'];
                        $apellidoCc = $selectconsejal['apellido'];
                        $fotoCc = $selectconsejal['foto'];
                        $imagenBase64Ac = base64_encode($fotoCc);
                        $votoc = $selectconsejal['voto'];
                ?>
                    <tr class="datos">
                        <th class="imgTab"> 
                        <img class="alcalde-section__img" src="data: png;base64,<?php echo $imagenBase64Ac; ?>">
                        </th>
                        <th class="nomTab" >
                            <span class="nomTab-span"> 
                                <?php  echo $nombreCc; ?>
                            </span>
                        </th>
                        <th class="apeTab">
                            <span class="apeTab-span"> 
                                <?php  echo $apellidoCc; ?>
                            </span>
                        </th>
                        <th class="votoTab">
                            <span class="votoTab-span"> 
                                <?php  echo $votoc; ?>
                            </span>
                        </th>
                    </tr>
                    <?php 
                    }
                    ?>
            </tbody>
        </table>




    </main>
</body>
</html>