<?php

$server = 'fdb27.125mb.com';
$port = '3306';
$username = '3785630_stressy';
$password = 'Iot2021_01';
$database = '3785630_stressy';

$connect = mysqli_connect($server, $username, $password, $database, $port);

if (!$connect) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}





$user_info = "INSERT INTO data (Usuario, Nombre, Apellido, Genero, Edad, Peso) VALUES ('$_POST[Usuario]', '$_POST[Nombre]', '$_POST[Apellido]', '$_POST[Genero]', '$_POST[Edad]', '$_POST[Peso]')";

if (!mysqli_query($connect, $user_info))
        { 
                die('Error: ' . mysqli_error($connect));
        }

$Usuario = $_REQUEST['Usuario'];
$Nombre = $_REQUEST['Nombre'];
$Apellido = $_REQUEST['Apellido'];
$Sexo = $_REQUEST['Genero'];
$Edad = $_REQUEST['Edad'];
$Peso = $_REQUEST['Peso'];

//echo $Usuario, ' ', $Nombre, ' ',$Apellido, ' ', $Sexo, ' ', $Edad, ' ', $Peso ;

/*
$sql = "SELECT data_id, Usuario, Edad  FROM data";
$result = mysqli_query($connect, $sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "id: " . $row["data_id"]. " - Name: " . $row["Usuario"]. " " . $row["Edad"]. "<br>";
  }
} else {
  echo "0 results";
}
*/

//echo "<script> myfunction($Edad); </script>";

mysqli_close($connect); 


?>
<html>
        <body>
                <script type="text/javascript">
                
                var Usuario = '<?php echo $Usuario; ?>';
                var Nombre = '<?php echo $Nombre; ?>';
                var Apellido = '<?php echo $Apellido; ?>';
                var Edad= '<?php echo $Edad; ?>';
                var Sexo= '<?php echo $Sexo; ?>';
                var Peso= '<?php echo $Peso; ?>';
                
                var Falta = "Faltan los datos de:\n";
                
                //alert(Edad);
                
                var ts_req = new XMLHttpRequest();
                var req_srt = "https://api.thingspeak.com/update?api_key=VTC2L7OBWWJXTXH1&field2="+Edad+"&field3="+Sexo+"&field4="+Peso+"&field6="+Usuario;
                ts_req.open("GET", req_srt, true);
                ts_req.send(null);
                
                if((Edad)&&(Sexo)&&(Peso)&&(Usuario)&&(Nombre)&&(Apellido))
                {
                        alert("Sus datos fueron ingresados");
                }
                else
                {
                        if(!Usuario)
                        {
                                Falta = Falta + "*Usuario\n";
                        }
                        
                        if(!Nombre)
                        {
                                Falta = Falta + "*Nombre\n";
                        }
                        
                        if(!Apellido)
                        {
                                Falta = Falta + "*Apellido\n";
                        }
                        
                        if(!Edad)
                        {
                                Falta = Falta + "*Edad\n";
                        }
                        
                        if(!Sexo)
                        {
                                Falta = Falta + "*Sexo\n";
                        }
                        
                        if(!Peso)
                        {
                                Falta = Falta + "*Peso\n";
                        }
                        
                        
                        alert(Falta);
                }
                
                
                //sleep(2000);
                window.location.replace('/Carpeta-pruebas-dashboard/user.html');
                


                </script>
        </body>
</html>

