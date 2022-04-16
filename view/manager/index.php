<?php
  // Se prendio esta mrd :v
  session_start();

  // Validamos que exista una session y ademas que el cargo que exista sea igual a 1 (Administrador)
  if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 3){
    /*
      Para redireccionar en php se utiliza header,
      pero al ser datos enviados por cabereza debe ejecutarse
      antes de mostrar cualquier informacion en el DOM es por eso que inserto este
      codigo antes de la estructura del html, espero haber sido claro
    */
    header('location: ../../index.php');
  }

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="test api mikrotik">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
                     
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">Estas usando una version <strong>desactualizada</strong> del navegador. Por favor <a href="http://browsehappy.com/">actualizalo</a> o <a href="http://www.google.com/chromeframe/?redirect=true">o habilite Google chrome Frame</a> para mejorar su experiencia.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <h1 class="title">Portal de Administración VCI</h1>
                <nav>
                    <ul>
                        <li><a href="#" id="call_bindings"></a></li>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                    </ul>
                </nav>
            </header>
        </div>

        <div class="main-container">
            <div class="main wrapper clearfix">

                <article>
                  <section>
                    <h3>Dispositivos Conectados</h3>
                    <div id="bar_buttons">
					 <ul>
                    	<!--<li id="btn_add" title="Agregar">&nbsp;</li>-->
                        <!--<li id="btn_del" title="Eliminar">&nbsp;</li>-->
                        <!--<li id="btn_ena" title="Activar">&nbsp;</li>-->
                        <!--<li id="btn_dis" title="Desactivar">&nbsp;</li>-->
                      </ul>
                      <div id="ajax_botones"></div>  
                    </div>
                    <input type="hidden" id="idh" name="idh" value="" />
                    
                  	<div id="div_bindings"></div>
                   
                  </section>
             			<a href="index.php"> <button type="button" name="button">Actualizar Lista</button></a> 
                </article>

                <aside>
                    <h3>Administración Dispositivo <?php echo ($_SESSION['nombre']); ?></h3>
    
                    <h3>Equipo Administrativo <?php echo ($_SESSION['router']); ?></h3>
                     <table>
<td align="center" valign="middle">
<!--Formulario-->
<FORM id="recargar_dispositivo" name="recargar_dispositivo" action="./api/recargar_dispositivo.php" method="POST">
    <p><label>codigo asociado:<input name="customer" type="text"  id="customer" size="20" value="<?= $_SESSION['customer']?>" /></label></p>
<p><label>dispositivo a registrar:<input name="mac" type="text" id="mac" size="20" value=""  /></label></p>

      <p><label for="plan" >tipo de registro de dispositivo:</label></p>
          <select name="plan" id="plan" class="planselect" required>
    <option></option>
    <option>vci-dispositivos</option>
    <option>VCI-Residenciales</option>

    </select><br>

<p><input type="submit" name="Submit" value="Enviar"/></p>
</FORM>
 
 
</td>
</table>
<a href="../../controller/cerrarSesion.php">
      <button type="button" name="button">Cerrar sesion</button>
    </a>
                </aside>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
                <h3>Cesar Araujo</h3>
            </footer>
        </div>





        <script src="js/vendor/jquery-1.9.1.js"></script>
		<script src="js/vendor/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="js/main.js"></script>
        <script>
           $.ajaxSetup ({  
				cache: false  
			});
			
			// cargo la lista de ip-bindings
			var ajax_load = "<img src='img/indicator_white_small.gif' alt='loading...' />";  
			var loadUrl = "api/hotspot-host-all.php";  
			$("#call_bindings").click(function(){  
				$("#div_bindings").html(ajax_load).load(loadUrl);  
			}); 
			$("#div_bindings").html(ajax_load).load(loadUrl);
			
			// pinta el registro seleccionado y despinta el resto
			$("div").on("click", ".div_row_repeat", function() {
				$('.highlight').removeClass('highlight');
				var id = this.id;
				$(".tabla div.div_row_repeat").children().each(function(index , Elem) {
					if($(Elem).parent().attr('id')==id){ 
						$(Elem).addClass('highlight');
						$("#mac").val(id); 
					}
				});
			});
			
			// $("#btn_add").click(function(){
				
			// });
			
			// $("#btn_del").click(function(){
			// 	id=$('input[name=idh]').val(); // id seleccionado
			// 	if(id!=""){ //si hay algun registro seleccionado				
			// 		var loadUrl = "api/hotspot_general.php?ac=delete&id="+id; // paso parametro accion e id
			// 		$("#ajax_botones").html(ajax_load).load(loadUrl); // ejecuto
			// 		setTimeout(function(){ // refresco ip-bindings dentro de 2 segundos
			// 		  $("#div_bindings").html(ajax_load).load("api/hotspot-host-all.php");
			// 		}, 2000);
			// 		$('input[name=idh]').val(""); //blanqueo la seleccion
			// 	}
			// });
			
			// $("#btn_ena").click(function(){
			// 	id=$('input[name=idh]').val(); // id seleccionado
			// 	if(id!=""){ //si hay algun registro seleccionado
			// 		var loadUrl = "api/hotspot_general.php?ac=enable&id="+id; // paso parametro accion e id
			// 		$("#ajax_botones").html(ajax_load).load(loadUrl); // ejecuto
			// 		setTimeout(function(){ // refresco ip-bindings dentro de 2 segundos
			// 		  $("#div_bindings").html(ajax_load).load("api/hotspot-host-all.php");
			// 		}, 2000);
			// 		$('input[name=idh]').val(""); //blanqueo la seleccion
			// 	}
			// });
			
			// $("#btn_dis").click(function(){
			// 	id=$('input[name=idh]').val(); // id seleccionado
			// 	if(id!=""){ //si hay algun registro seleccionado				
			// 		var loadUrl = "api/hotspot_general.php?ac=disable&id="+id; // paso parametro accion e id
			// 		$("#ajax_botones").html(ajax_load).load(loadUrl); // ejecuto
			// 		setTimeout(function(){ // refresco ip-bindings dentro de 2 segundos
			// 		  $("#div_bindings").html(ajax_load).load("api/hotspot-host-all.php");
			// 		}, 2000);
			// 		$('input[name=idh]').val(""); //blanqueo la seleccion
			// 	}
			// });
			
        </script>

    </body>
</html>
