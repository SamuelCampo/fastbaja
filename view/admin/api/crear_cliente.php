<?php require_once('api_mt_include2.php'); ?>
<?php
$ipRouteros="10.50.48.1";  // tu RouterOS.
$Username="api";
$Pass="api";
$api_puerto=8727;


$address= "192.168.0.5";  // IP Cliente
$name=    "nicolas222";
$ratelimit=    "5M/5M";
$comment= "Este es un ejempo2.";


$status= "true";
$macaddress=    "00:0C:29:6E:1A:FC";
$server= "dhcp1";



if( $macaddress !="" ){
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect($ipRouteros, $Username, $Pass, $api_puerto)) {
       $API->write("/ip/dhcp-server/lease/getall",false);
       $API->write('?mac-address='.$macaddress,true);
       //$API->write('?dynamic='.$status,true)
       $READ = $API->read(false);
       $ARRAY = $API->parse_response($READ); 
       print_r($ARRAY);
        if(count($ARRAY)>0){ // si el nombre de usuario "ya existe".
            echo "Error: El nombre no puede estar duplicado.";
            echo '<img src="../img/icon_error.png" />';


        }else{
            $API->write("/ip/dhcp-server/lease/add",false);
            /// Para editar (en vez de agregar) reemplazar la linea de arriba por estas dos siguientes.
            //$API->write("/ip/dhcp-server/lease/set",false);  
            //$API->write("=.id=".$ARRAY[0]['.id'],false);
            $API->write('=address='.$address,false);   // IP
            $API->write('=mac-address='.$macaddress,false);   // IP
             $API->write('=server='.$server,false);   // IP
            //$API->write('=name='.$name,false);       // nombre
            $API->write('=rate-limit='.$ratelimit,false);   //   2M/2M   [TX/RX]
            $API->write('=comment='.$comment,true);         // comentario
            $READ = $API->read(false);
            $ARRAY = $API->parse_response($READ); 
            print_r($ARRAY);                      
            echo "El Usuario $name, ha sido creado con exito!.";
            echo '<img src="../img/okicon.png" />';
        }        
        $API->disconnect();
    }
}
?>