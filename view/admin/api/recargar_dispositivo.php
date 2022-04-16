
<?php

session_start();

require_once('api_mt_include2.php');



if (isset($_POST["g-recaptcha-response"])) {
  $captchasecret = "6LfLTrQeAAAAAOwcLwJHn6LCjbanf9_p7mkLrp-2";
  $captcharesponse = $_POST["g-recaptcha-response"];
  //$ip = $_SERVER['REMOTE_ADDR'];
  $captchafinalResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$captchasecret&response=$captcharesponse");
  $captchajsonResponse = json_decode($captchafinalResponse);
  if ($captchajsonResponse->success) {
        //////// configura tus datos
    $ipRouteros = "10.99.99.1"; //ip_de_tu_API
    $Username = "vciapi"; //usuario_API
    $Pass = "vci**"; //contrase�a_API
    $api_puerto = "8728"; //puerto_API
    /// VARIABLES DE FORMULARIO
    $plan = $_POST['plan'];
    $macaddress = $_POST['mac'];
    $customer = $_POST['customer'];
    $passuser = "Az15479303**";
    $notificaciton = "0";
    if ($macaddress != "") {
      $API = new routeros_api();
      $API->debug = false;
      if ($API->connect($ipRouteros, $Username, $Pass, $api_puerto)) {
        $API->write("/tool/user-manager/user/getall", false);
        $API->write('?username=' . $macaddress, true);
        $READ = $API->read(false);
        $ARRAY = $API->parse_response($READ);
        // print_r($ARRAY);
        if (count($ARRAY) > 0) { // si el nombre de usuario "ya existe".
          //echo "Recargando Dispositivo, espere un momento";
          //echo nl2br(" \n ");
          $API->write("/tool/user-manager/user/create-and-activate-profile", false);
          $API->write('=.id=' . $ARRAY[0][".id"], false);
          $API->write('=customer=' . $customer, false);
          $API->write('=profile=' . $plan, true);
          $READ = $API->read(false);
          $ARRAY = $API->parse_response($READ);
          // print_r($ARRAY);  
          //echo "la recarga del plan: <br>$plan <br>en el dipositivo: <br>$macaddress <br>ha sido realizada con exito!.";
          //echo nl2br(" \n ");
          //echo nl2br(" \n ");
         // echo ' <a href="https://vci.fastbaja.com/view/admin/index.php"><button type="button">VOLVER</button></a>';
          //echo '<img src="../img/okicon.png" />';
        } else {
         // echo "Creando y Recargando Dispositivo<br>";
          //echo nl2br(" \n ");
          $API->write("/tool/user-manager/user/add", false);
          $API->write('=username=' . $macaddress, false);
          $API->write('=password=' . $passuser, false);
          $API->write('=caller-id=' . $macaddress, false);
          $API->write('=customer=' . $customer, true);
          $READ = $API->read(false);
          $ARRAY = $API->parse_response($READ);
          //print_r($ARRAY);                      
         // echo "El Usuario: <br>$name <br>ha sido creado con exito!.";
         // echo nl2br(" \n ");
         // echo nl2br(" \n ");
          if ($API->connect($ipRouteros, $Username, $Pass, $api_puerto)) {
            $API->write("/tool/user-manager/user/getall", false);
            $API->write('?username=' . $macaddress, true);
            $READ = $API->read(false);
            $ARRAY = $API->parse_response($READ);
            //print_r($ARRAY);
            if (count($ARRAY) > 0) { // si el nombre de usuario "ya existe".
              //echo "Recargando Dispositivo";
             // echo nl2br(" \n ");
              $API->write("/tool/user-manager/user/create-and-activate-profile", false);
              $API->write('=.id=' . $ARRAY[0][".id"], false);
              $API->write('=customer=' . $customer, false);
              $API->write('=profile=' . $plan, true);
              $READ = $API->read(false);
              $ARRAY = $API->parse_response($READ);
              //   print_r($ARRAY);  
              //echo "la recarga del plan: <br>$plan <br>en el dipositivo: <br>$macaddress <br>ha sido realizada con exito!.";
              //echo nl2br(" \n ");
              //echo ' <a href="https://vci.fastbaja.com/view/admin/index.php"><button type="button">VOLVER</button></a>';
            }
            $API->disconnect();
          }
        }
        $API->disconnect();
      }
    }
  }
} else {
  echo "CAPTCHA NO VALIDO , Verificar<br>";
}

//$template = file_get_contents(../../index.php);
//echo $template;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="recarresultpa">
  <table>
    <tr>
    <td class="recarresulthi" ><span >
    <?php echo "la recarga del plan: <br>$plan <br>en el dipositivo: <br>$macaddress <br>ha sido realizada con exito!." ?>
    </span></td>
    
    <tr>
  <td><a href="https://vci.fastbaja.com/view/admin/index.php"><button type="button">VOLVER</button></a></td>
  </tr>
</tr>
</table>
</div>
</body>
</html>