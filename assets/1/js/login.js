$(document).ready(function(){
    $('#login_form').validate({


        rules: {

            emaillog: { required: true, email: true },
            passlog: { required: true,  minlength: 6 }
        },
        messages: {
            emaillog: { required: 'Informe o seu email', email: 'Ops, informe um email válido' },
            passlog: { required: 'Informe sua senha', email: 'No mínimo 6 caracteres' }

        },
        submitHandler: function( form ){
            var dados = $( form ).serialize();

            $.ajax({
                type: "POST",
                url: "AjaxControler/ajaxLogin",
                data: dados,
                success: function( data )
                {

                    if(data == 11){
                        window.location.reload();

                    }else{

                        $("#errorlog").html(data);
                    }
                }
            });

            return false;
        }
    });
});