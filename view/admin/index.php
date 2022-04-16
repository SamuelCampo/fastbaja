<?php
  session_start();
  if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1){
    header('location: ../../index.php');
  }



?>

<!DOCTYPE html>

    <head>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
                     
    </head>
    <body>


        <div class="header-container">
            <header class="wrapper clearfix">
                <h1 class="title">Portal de Recargas VCI</h1>
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

					<br>
                  <a href="index.php"> <button type="button" name="button">Actualizar Lista</button></a> 

                </article>

                <aside>
                    <h3>Recargar Dispositivo <?php echo ($_SESSION['nombre']); ?></h3>
    
                    <h3>equipo administrativo <?php echo ($_SESSION['router']); ?></h3>
                     <table>
<td align="center" valign="middle">
<!--Formulario-->
<FORM id="recargar_dispositivo" name="recargar_dispositivo" action="./api/recargar_dispositivo.php" method="POST">
    <p><label>codigo asociado:<input name="customer" type="text"  id="customer" size="20" value="<?= $_SESSION['customer']?>" /></label></p>
<p><label>dispositivo cliente:<input name="mac" type="text" id="mac" size="20" value=""  /></label></p>

      <p><label for="plan" >Recarga a Aplicar:</label></p>
            <select name="plan" id="plan" class="planselect" required>
                <option></option>
                <option>WIFI-HORA</option>
                <option>WIFI-DIA</option>
                <option>WIFI-1</option>
                <option>WIFI-10</option>
                <option>vci-prueba</option>
            </select>
	<br><br>
	<div class="g-recaptcha" data-sitekey="6LfLTrQeAAAAAMueu1XICBK2dckd3emU-mHtmJrY"></div>

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
			
			
        </script>

    </body>
</html>
