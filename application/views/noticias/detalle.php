<script type="text/javascript">
  $(document).ready(function() {
    $(".fancybox").fancybox({
      helpers: { 
        title: {
          type: 'float'
        }
      }
    });
  });
</script>


<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>



<div id="noticias">
  <div id="gralCycle" data-cycle-fx="scrollHorz" data-cycle-slides="&gt; div" data-cycle-timeout="4000" data-cycle-speed="1000" data-cycle-swipe="true" data-cycle-pager=".cycle-pager" data-cycle-pager-template="&lt;span&gt;&lt;/span&gt;" class="cycle-slideshow">
    {BANNERS}
  </div>
  <div class="cycle-pager pa tac wrapper"></div>
  <div id="gralBox">
    <h1 class="tac">COMUNICADOS DE PRENSA</h1>
    <div class="controls">
     

<div id="inline">
	<h2>Comparte</h2>

	<form id="contact" name="contact" action="#" method="post">
		<p>
			<label for="email">Tu correo</label>
			<input type="text" id="email" name="email" class="txt">
		</p>
		<p>
			<label for="msg">Tu nombre</label>
			<input type="text" id="msg" name="msg"></input>
		</p>
		<p>
			<label for="msg">Correo de destino</label>
			<input type="text" id="destino" name="destino" class="email"></input>
		</p>
		<button class="btn-not dib tar" id="send">Enviar E-mail</button>
		<input type="hidden" value="<?php echo $actual_link ?>" name="url" />
	</form>
</div>

      <div class="clear"></div>
    </div>
    <div class="lrow">
      
      <h3 class="tal h32">Artículos destacados</h3>
      <div class="ml10">
        
		{DESTACADOS}
      </div>
      <h3 class="tal h33">Lo más leído</h3>
      <div class="ml10">
        
		{VISITADO}
      </div>
    </div>
  

    <div id="rrow" class="rrow">
        {NOTICIA}
    </div>
    <div class="clear"></div>
  </div>
  <div class="wrapper tar">
    <a href="{DIR}noticias/{PAGE}" class="lnk-back dib pr">Regresar al listado<span class="pa db"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </div>
  <br />
</div>
<script type="text/javascript">
  function imprSelec(nombre){
    var ficha = document.getElementById(nombre);
    var ventimp = window.open(' ', 'popimpr');
    ventimp.document.write( ficha.innerHTML );
    ventimp.document.close();
    ventimp.print( );
    ventimp.close();
  } 
  </script>



<script type="text/javascript">
	
	$(document).ready(function() {
		$(".modalbox").fancybox();
		
		
		$("#send").on("click", function(){
			 var email = $('#email').val();
       var nombre = $('#msg').val();
       var detino = $('#destino').val();				
				
				$.ajax({
					type: 'POST',
          dataType: "html",
					url: '{DIR}home/sendnew',
					data: 'email='+email+'&nombre='+nombre+'&destino='+destino,
          beforeSend:function(){
            $("#send").replaceWith("<em>Enviando...</em>");
          },
					success: function(data) {
            alert(data);
						/*if(data == "true") {
							$("#contact").fadeOut("fast", function(){
								$(this).before("<p><strong>Su correo ha sido enviado, Gracias.</strong></p>");
								setTimeout("$.fancybox.close()", 1000);
							});
						}*/
					}
				});
			}
		});
	});
</script>