
$("#formUsuario").validate({
       rules:{
           login:{
               required:true,
			   minlength: 3,
			   remote: {
				  url: "UsuarioControlador.php?operacao=verificarLogin&idUsuario="+$( "#idUsuario" ).val(),
				  type: "post",
				  data: {
				     login: function() {
					     return $( "#login" ).val();
				     }
				  }
			   }			   
           }, 		   
           senha:{
               required:true
           }, 
           email:{
               required:true,
			   email: true			   
           }, 
           situacao:{
               required:true
           }, 
           grupoAcesso:{
               required:true
           } 		   
       }, 
       messages:{
           login:{
               required:"Campo obrigatório",
			   minlength:"Por favor, insira pelo menos {0} caracteres",
			   remote:"Já existe um usuário com esse login"
           },
           senha:{
               required:"Campos obrigatório"
           },
           email:{
               required:"Campos obrigatório",
			   email:"E-mail inválido"
           },
           situacao:{
               required:"Campos obrigatório"
           },
           grupoAcesso:{
               required:"Campos obrigatório"
           }		   
       }
});


