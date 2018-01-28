$(document).on('ready', function(){
	var base_url = $('base').attr('href');
	$('.top-links ul li a').on('click', function(event){
		event.preventDefault(); //evita el href
		var boton= $(this).attr('data-lang');
		$.ajax({
			'url' : base_url + 'system/cambiar_lang',
			'type' : 'POST',
			'dataType' : 'json',
			'data' : {'lenguaje' : boton}
		}).done(function(data){
			if(data.status == 200){
				window.location.reload();
			}
		}).fail(function(response){

		})
	})
})