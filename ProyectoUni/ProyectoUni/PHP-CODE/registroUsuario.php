<!DOCTYPE html>
<html lang="es-col">
<head>
    <!-- Title -->
    <title>Votación</title>
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
    <link rel="stylesheet" type="text/css" href="../stylesIndex.css">
    <style>
        .header__h2{
            font-size:2.13rem;
        }
    </style>
</head>
<body>
    
    <header class="header">
        <div class="header__div-h2">
            <h2 class="header__h2">Sistema de Votación</h2>
        </div>   
    </header>
    
    <!--  ----[Main]----  -->
    <main>
        <br><br>
        <form class="form" name="votanteR" method="post" action="">
            <h2 class="header__h2"> REGISTRAR VOTANTE </h2>
            <input class="inputRegistro" type="text" name="nombre" placeholder="Nombre" required> <br><br>
            <input class="inputRegistro" type="text" name="cedula" placeholder="Cédula" required> <br><br>
            <input class="inputRegistro" type="password" name="password" placeholder="Contraseña" required><br><br>
            <input class="inputRegistro-IMG" type="file" id="imagen" name="imagen" accept="image/*"><br><br>
            <input class="inputRegistro-submit" type="submit" name="votanteSubmit" class="button-sub">
        </form>
        <br><br><br><br>
        <form class="form" name="postulanteR" method="post" action="">
            <h2 class="header__h2"> REGISTRAR CANDIDATO </h2>
            <input class="inputRegistro" class="" type="text" name="nombre" placeholder="Nombre" required> <br><br>
            <input class="inputRegistro" class="" type="text" name="apellido" placeholder="Apellido" required> <br><br>
            <select class="inputRegistro-select" name="tipoCuenta"> 
                <option value="alcalde"> Postulante a Alcalde</option>
                <option value="consejal"> Postulante a Concejal</option>
            </select> <br><br>
            <input class="inputRegistro-IMG" type="file" id="imagen" name="imagen" accept="image/*"> <br><br>
            <input class="button-sub inputRegistro-submit" type="submit" name="postulanteSubmit">
        </form>

        <?php
        // Incluir el archivo de conexión a la base de datos
        include("conexion/conexion.php");

        // Procesar formulario de registro de votante
        if(isset($_POST['votanteSubmit'])) {
            // Recoger los datos del formulario de registro de votante
            $nombreVotante = $_POST['nombre'];
            $cedulaVotante = $_POST['cedula'];
            $password = $_POST['password'];

            // Verificar si se subió una imagen
            if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
                // Procesar la imagen subida
                $nombreImagenVotante = $_FILES['imagen']['name'];
                $rutaImagenVotante = "ruta/donde/guardar/imagenes/votantes/" . $nombreImagenVotante;
                // Mover la imagen al directorio de destino
                move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagenVotante);
            } else {
                // Si no se subió una imagen, asignar una ruta por defecto
                $rutaImagenVotante = "ruta/donde/guardar/imagenes/votantes/default.jpg";
            }

            // Contraseña sin cifrar
            $hashed_password = $password;

            // Sentencia SQL para insertar en la tabla de votantes
            $insertarVotante = "INSERT INTO votantes (nombre, cedula, password, foto) VALUES ('$nombreVotante', '$cedulaVotante', '$hashed_password', '$rutaImagenVotante')";

            // Ejecutar la consulta
            if ($conexion->query($insertarVotante) === TRUE) {
                echo "Votante registrado correctamente.";
            } else {
                echo "Error al registrar el votante: " . $conexion->error;
            }
        }

        // Procesar formulario de registro de candidato
        if(isset($_POST['postulanteSubmit'])) {
            // Recoger los datos del formulario de registro de candidato
            $nombreCandidato = $_POST['nombre'];
            $apellidoCandidato = $_POST['apellido'];
            $tipoCuenta = $_POST['tipoCuenta'];

            // Verificar si se subió una imagen
            if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
                // Procesar la imagen subida
                $nombreImagenCandidato = $_FILES['imagen']['name'];
                $rutaImagenCandidato = "ruta/donde/guardar/imagenes/candidatos/" . $nombreImagenCandidato;
                // Mover la imagen al directorio de destino
                move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagenCandidato);
            } else {
                // Si no se subió una imagen, asignar una ruta por defecto
                $rutaImagenCandidato = "ruta/donde/guardar/imagenes/candidatos/default.jpg";
            }

            // Sentencia SQL para insertar en la tabla de candidatos
            $insertarCandidato = "INSERT INTO candidatos (nombre, apellido, puesto, foto) VALUES ('$nombreCandidato', '$apellidoCandidato', '$tipoCuenta', '$rutaImagenCandidato')";

            // Ejecutar la consulta
            if ($conexion->query($insertarCandidato) === TRUE) {
                echo "Candidato registrado correctamente.";
            } else {
                echo "Error al registrar el candidato: " . $conexion->error;
            }
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
        ?>
    </main>
    <br>
    <br> <br> <br>
    <a class="returnA" href=".."> Regresar </a>
</body>
</html>
