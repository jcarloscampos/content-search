$(function(){
	$('#search').focus();
	$('#search-form').submit(function(e){ //para desabilitar el sumit (enter)
		e.preventDefault();
	})

	$('#search').keypress(function(e){ //se ejecuta cuando la tecla es presionada
		var envio = $('#search').val();
		//agregar elementon en el div resultados antes que llege la consulta
		$('#logo').html('<img src="images/browser.svg" width="50px" alt="Solquick" title="Solquick" />');
		// $('#resultados').html('<h5><img src="../images/load.gif" width="30" alt="" >Buscando</h5>'); 
		if(e.which == 13){ 
		$.ajax({
			type: 'POST',
			url: 'php/buscador.php',
			data: 'search='+envio,
			
			success:function(resp){
				if(resp!=""){
					$('#resultados').html(resp);
				}
			}
		})
	}
	})
})

