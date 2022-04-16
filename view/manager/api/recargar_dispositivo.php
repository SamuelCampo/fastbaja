
<?php
  // Se prendio esta mrd :v
  session_start();

  // Validamos que exista una session y ademas que el cargo que exista sea igual a 1 (Administrador)
 // if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1){
    /*
      Para redireccionar en php se utiliza header,
      pero al ser datos enviados por cabereza debe ejecutarse
      antes de mostrar cualquier informacion en el DOM es por eso que inserto este
      codigo antes de la estructura del html, espero haber sido claro
    */
   // header('location: ../../index.php');
 // }

?>

<?php require_once('api_mt_include2.php'); ?>
<?php
//////// configura tus datos
$ipRouteros ="10.99.99.1"; //ip_de_tu_API
$Username ="vciapi"; //usuario_API
$Pass ="vci**"; //contrase�a_API
$api_puerto ="8728"; //puerto_API

/// VARIABLES DE FORMULARIO
$plan = $_POST['plan'];
$macaddress = $_POST['mac'];
$customer = $_POST['customer'];
$passuser ="Az15479303**";



if( $macaddress !="" ){
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect($ipRouteros, $Username, $Pass, $api_puerto)) {
       $API->write("/tool/user-manager/user/getall",false);
       $API->write('?username='.$macaddress,true);
       $READ = $API->read(false);
       $ARRAY = $API->parse_response($READ); 
      // print_r($ARRAY);
        if(count($ARRAY)>0){ // si el nombre de usuario "ya existe".
            echo "Recargando Dispositivo";
            echo nl2br(" \n ");
            $API->write("/tool/user-manager/user/create-and-activate-profile",false);
            $API->write('=.id='.$ARRAY[0][".id"],false);
            $API->write('=customer='.$customer,false);
            $API->write('=profile='.$plan,true);
            $READ = $API->read(false);
            $ARRAY = $API->parse_response($READ); 
           // print_r($ARRAY);  
            echo "la recarga del plan $plan en el dipositivo $macaddress, ha sido realizada con exito!.";
            echo nl2br(" \n ");
            echo nl2br(" \n ");
            echo ' <a href="https://vci.fastbaja.com/view/admin/index.php"><button type="button">VOLVER</button></a>';
            //echo '<img src="../img/okicon.png" />';

         }  else{
                echo "Creando y Recargando Dispositivo";
                echo nl2br(" \n ");
                $API->write("/tool/user-manager/user/add",false);
                $API->write('=username='.$macaddress,false);   
                $API->write('=password='.$passuser,false);   
                $API->write('=caller-id='.$macaddress,false);     
                $API->write('=customer='.$customer,true); 
                $READ = $API->read(false);
                $ARRAY = $API->parse_response($READ); 
                //print_r($ARRAY);                      
                echo "El Usuario $name, ha sido creado con exito!.";
                echo nl2br(" \n ");
                echo nl2br(" \n ");
                //echo '<img src="../img/okicon.png" />';


                    if ($API->connect($ipRouteros, $Username, $Pass, $api_puerto)) {
                        $API->write("/tool/user-manager/user/getall",false);
                        $API->write('?username='.$macaddress,true);
                        $READ = $API->read(false);
                        $ARRAY = $API->parse_response($READ); 
                        //print_r($ARRAY);
                        if(count($ARRAY)>0){ // si el nombre de usuario "ya existe".
                            echo "Recargando Dispositivo";
                            echo nl2br(" \n ");
                            $API->write("/tool/user-manager/user/create-and-activate-profile",false);
                            $API->write('=.id='.$ARRAY[0][".id"],false);
                            $API->write('=customer='.$customer,false);
                            $API->write('=profile='.$plan,true);
                            $READ = $API->read(false);
                            $ARRAY = $API->parse_response($READ); 
                         //   print_r($ARRAY);  
                            echo "la recarga del plan $plan en el dipositivo $macaddress, ha sido realizada con exito!.";
                            echo nl2br(" \n ");
                            echo ' <a href="https://vci.fastbaja.com/view/admin/index.php"><button type="button">VOLVER</button></a>';
                        }
                        $API->disconnect();
                    }

            }        
        $API->disconnect();
        
    }
}
?>