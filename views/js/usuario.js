/*=============================================
VALIDAR EL REGISTRO DE USUSARIO
=============================================*/
function registroUsuario(){
    /*=============================================
    VALIDAR EL NOMBRE
    =============================================*/
    var nombre = $("#regUsuario").val();

    if(nombre != ""){
        
        var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;
        
        if(!expresion.test(nombre)){
            $("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten numeros ni caracteres especiales</div>')
        
            return false; 
        }


    }else{
        $("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
        return false; 
    }
    /*=============================================
    VALIDAR EL EMAIL
    =============================================*/
    var email = $("#reEmail").val();

    if(email != ""){
        
        var expresion =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
        
        if(!expresion.test(email)){

            $("#reEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el formulario</div>')
        
            return false; 
        }


    }else{
        $("#reEmail").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
        return false; 
    }
        
    /*=============================================
    VALIDAR EL PASSWORD
    =============================================*/
    var password = $("#rePassword").val();

    if(password != ""){
        
        var expresion = /^[a-zA-Z0-9]*$/;
        
        if(!expresion.test(password)){

            $("#rePassword").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>No se permiten carecteres especiales</div>')
        
            return false; 
        }


    }else{
        $("#rePassword").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
        return false; 
    }
    
    /*=============================================
    VALIDAR POLITICA DE PRIVACIDAD
    =============================================*/
    var politicas = $("#regPoliticas:checked").val()
    
    if(politicas != "on"){

        $("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Dede aceptar nuestras condiciones de uso y políticas de privacidad</div>')
        
        return false; 
    }
    return true;
    
}