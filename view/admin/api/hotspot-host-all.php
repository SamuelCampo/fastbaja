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
$ipRouteros=($_SESSION['router']);  // tu RouterOS.
$Username="vciapi";
$Pass="Rtl900ip**";
$api_puerto=8728;


		echo '<div class="tabla">';
			echo '<div class="div_titulo_row">';
				echo '<div class="div_titulo" style="width:13%;">&nbsp;#</div>';	
				echo '<div class="div_titulo" style="width:83%;">&nbsp;Mac-Address</div>';	
				//echo '<div class="div_titulo" style="width:22%;">&nbsp;Address</div>';	
				//echo '<div class="div_titulo" style="width:22%;">&nbsp;To Address</div>';	
				//echo '<div class="div_titulo" style="width:10%;">&nbsp;Server</div>';
				//echo '<div class="div_titulo" style="width:63%;">&nbsp;Type</div>';	
			echo '</div>';	

    $API = new routeros_api();		
    $API->debug = false;
    if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {
       $API->write("/ip/hotspot/host/getall",true);   
       $READ = $API->read(false);
       $ARRAY = $API->parse_response($READ);
        if(count($ARRAY)>0){   // si hay mas de 1 dispositivo.
				for($x=0;$x<count($ARRAY);$x++){			
						//echo '<div class="div_comment">';
							//echo '&nbsp;&nbsp; ;;;&nbsp;'.$ARRAY[$x]["comment"];
						//echo '</div>';
						if ($ARRAY[$x]["disabled"]=="false"){  $clase="class='div_row_child'"; }else{ $clase="class='div_row_child div_row_disabled'"; }
						echo '<div class="div_row_repeat" id="'.$ARRAY[$x]["mac-address"].'">';
							echo '<div class="div_row_child div_row_child_img" style="width:13%;">&nbsp;</div>';	
							echo '<div '. $clase .' style="width:83%;">&nbsp;'.$ARRAY[$x]["mac-address"].'</div>';	
							//echo '<div '. $clase .' style="width:22%;">&nbsp;'.$ARRAY[$x]["address"].'</div>';	
							//echo '<div '. $clase .' style="width:10%;">&nbsp;'.$ARRAY[$x]["server"].'</div>';
							//echo '<div '. $clase .' style="width:63%;">&nbsp;'.$ARRAY[$x]["type"].'</div>';
                            echo '</div>';
				}
        }else{ // si no hay ningun dispositivo
            echo "No hay ningun dispositivo conectado. //<br/>";
        } 
       $API->disconnect();
    }
	echo '</div>';
?>
                   