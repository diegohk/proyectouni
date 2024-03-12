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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Rubik+Broken+Fax&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesIndex.css">
</head>
<body>
    <!--
    ===========================================================================================
                                    ---[HEADER]---
    ===========================================================================================
    -->
    <header>
        <h2> Sistema de Votacion </h2>
        <nav></nav>
    </header>
    <!--
    ===========================================================================================
                                    ---[MAIN]---
    ===========================================================================================
    -->
    <main>

        <div>
            <form class="form" method="post">
                <label>
                    <span> Ingrese Cedula: </span>
                    <input type="text" name="cedula" placeholder="Cedula" require>
                </label>
                <br>
                <label>
                    <span> Ingrese Contraseña </span>
                    <input type="password" name="password" placeholder="Contraseña" require>
                </label>
                <br>
               <input class="button-sub" type="submit" name="validar"  value="Iniciar">
                <div>
                    <span>
                        <a href="PHP-CODE/registroUsuario.php">
                            Crear cuenta
                        </a>
                    <span>
                </div>
            </form>
            <!--INICIO CODIGO PHP-->
            <?php 
            //El include es para vinvhular una pagina con otra
                //En este caso conecto con la pagina que ya hice la conexion para ahorrar code
            include("PHP-CODE\conexion\conexion.php");
            //Dice si una variable esta definida o es nula 
            if(isset($_POST['validar'])){
                //Aqui guardo los vslores globales cuando se da clic a unas variable locales
                //el trim elimina los espacios en blanco iniciales y finales ejem:" hola " -> "hola"
                $cedulaIngresado = trim($_POST['cedula']);
                $passwordIngresado = trim($_POST['password']);
                //El $_POST ES PARA TOMAR LOS DATOS DEL ARCHIVO QUE TENGAN COMO NAME cedula y password
                //Aqui guardo una consulta MySQl en una variable
                $consultaComparacion = "SELECT * FROM votantes WHERE cedula = '$cedulaIngresado' AND password = '$passwordIngresado'";
                //Uso una variable y guardo un metodo query del objeto conexion, y de parametro paso la consulta  
                $resultado = $conexion ->query($consultaComparacion);
                /* If el resultado de ese metodo es mayo a 0 quiere decir que se3 encontro aunque sea
                una fila con esos datos y aqui puedo poner una condicion 
                */
                if( $cedulaIngresado == "admin" && $passwordIngresado == "admin"){
                    header("Location: PHP-CODE/dbInfo.php");
                    exit();
                }
                if( $resultado ->num_rows > 0){
                    /*
                            [Hacer un usuario]
                    Pasos guardar dato en una variable:
                        1. crea una variable que seleccione una fila de mysql
                        2. unsa una variable que almacene la variable con la que hiciste conexion 
                            y luego usa el metodo query y le pasamos como prametro la variable del paso 1
                        3. hacemos una variable que contenga la variable 2 pero con el metodo fetch_assoc
                        4. en otra variable nueva guarda la variable anterior pero en forma de array tipo
                        laVariableTres['ID'];

                    Pasos hacer una sesion para todo el sitio:
                        1. USAR el metodo session_start();
                        2. Crea un array y usa este para guardar la ultima variable del articulo anterior
                        3. Usa el exit
                    */
                    $consultaUser = "SELECT * FROM votantes WHERE cedula = '$cedulaIngresado'";
                    $consultaUserQuery = $conexion->query($consultaUser);
                    $consultaUserRow = $consultaUserQuery->fetch_assoc();
                    $ID_USER = $consultaUserRow['idVotante'];

                    session_start();
                    $_SESSION['ID'] = $ID_USER;
                    if (isset($_SESSION['ID']) && $_SESSION['ID'] !== null && strlen($_SESSION['ID']) > 0) {
                        header("Location: PHP-CODE/sistemaDeVotacion.php");
                        exit();
                    }            
                }else{

                }
            }
            
            /*
            $sql = "SELECT * FROM usuarios WHERE nombre_usuario='$username' AND contrasena='$password'";
            $result = $conn->query($sql);

            trim, strlen
            */
            ?>
        </div>
        
    </main>
    <!--
    ===========================================================================================
                                    ---[FOOTER]---
    ===========================================================================================
    -->
    <footer>

    </footer>
</body>
</html>
<!--
    $query = "SELECT * FROM votantes WHERE cedula = '$cedulaIngresado'";
                    $result = $conexion->query($query);
                    $row = $result->fetch_assoc();
                    $idVotante = $row['idVotante'];
            
                    session_start(); //Iniciar sesion dentro de el navegador 
                    $_SESSION['ID_USER'] = $idVotante;
                    header("Location: PHP-CODE/sistemaDeVotacion.php");
                    exit(); 
-->