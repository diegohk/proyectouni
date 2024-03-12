<!--Abrir EQTIQUETAS PARA INGRESAE CODIGO PHP-->
<?php

//Crear variables que guardan contenido de la conexiojn
$server = "localhost";
$user= "root";
$password = "";
$db = "votacion";
//Crear objeto y pasar los parametros al constructor
$conexion = new mysqli($server, $user, $password, $db);

//Verificar que el objto haga conexxion
if($conexion -> connect_error){
    //Texto por si falla conexion
}else{
    //Texco conexion estable
}



/*
[COMO FUNCIONA]
 
Mira relativamente es facil hacer la conexxion, simplmente es crear un objeto, 
tal cual como en java, recuerdas el " Scanner scanerUno = new Scanner(System.io)".
Ya ves?, no se te hace familiar eso a comparacion de lo que se hace en esta pagina,
practicamente es lo que se hace, creas un objeto, le pasas los parametros y checas que
ese objeto haga una conexion 

*/
?>