$(function(){
	$('#username').on('blur', function(){
    	$(this).prop('style', false);
    	$('#error-message-user').remove();

    	$.ajax({
            type: 'post',
            url: "./buscar/"+$(this).val(),
            async: false,
            dataType: 'json',
            headers : {
                    'X-CSRF-Token': csrf
                },
            success:function(resp){
                if(resp.exist){
                	$('#username').css('border-color','red').after($('<span></span>',{text:'El nombre de usuario no está disponible, intente con otro nuevamente', style:'color:red;', id:'error-message-user'}));
                }
            },
            error:function(error){
                alert('Error al procesar la solicitud');
                console.log(error);
            }
        });
    }).on('focus', function(){
    	$(this).prop('style', false);
    	$('#error-message-user').remove();
    });

    $('#password').on('keyup', function(){
    	$(this).prop('style', false);
    	$('#error-message-password').remove();

    	let pass = $(this).val();
    	let txt = [];

    	if(pass == ''){
            $(this).css('border-color','red').after($('<span></span>',{text:'La contraseña no puede estar vacía', style:'color:red;', id:'error-message-password'}));
            return false;
        }

        if(pass.length < 6){
            txt.push('Debe de contener al menos 6 caracteres');
        }
        
        if (!/[A-Z]/.test(pass)) {
            txt.push('Debe de contener al menos un caracter en mayúscula');
        }

        if (!/[a-z]/.test(pass)) {
            txt.push('Debe de contener al menos un caracter en minúscula');
        }

        if (!/\d/.test(pass)) {
            txt.push('Debe de contener al menos un caracter en minúscula');
        }

        if (!/[^\w]/.test(pass)) {
            txt.push('Debe de contener al menos un caracter especial');
        }

        if(txt.length){
            $(this).css('border-color','red').after($('<span></span>',{html:txt.join(' <br> '), style:'color:red;', id:'error-message-password'}));
            return false;
        }

        return true;
    });

	$('#confirm-password').on('keyup', function(){
		let passVal = $('#password').val();
		let confPass = $(this).val();
		let color = 'lightgreen';

		if(confPass !== passVal){
			color = 'orange';
		}

		$(this).css('border-color', color);
	});

});