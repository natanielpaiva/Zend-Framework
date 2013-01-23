$(document).ready(function(){
    $('#dialog').dialog({
        autoOpen: false,
        minHeight: 100,
        width: 350,
        title: "Esqueci minha Senha",
        resizable: false,
        modal:true,
        buttons: {
            "Ok": function() {
                $.post("/index/EsqueciSenha", {cpf:$('#txtCPF').val()}, function(data){
                    alert(data);
                });
                $(this).dialog("close");
            },
            "Cancel": function() {
                   $(this).dialog("close");
           }
       }       
   });
   
   $('#senhaNova').dialog({
        autoOpen: false,
        width: 350,
        title: "Criar Senha",
        resizable: false,
        modal:true,
        close:function(){
            location.href="/home";
        },
        buttons: {
            "Ok": function() {
                if ($('#txtNovaSenha').val() != "" && $('#txtConfirmacao').val() != ""){    
                    if ($('#txtNovaSenha').val() == $('#txtConfirmacao').val()) {
                        $.post("/index/NovaSenha", {novaSenha:$('#txtNovaSenha').val(), confirmacao:$('#txtConfirmacao').val()}, function(){
                            alert ("Senha Atualizada com sucesso");
                            location.href="/home";
                        });
                    }else
                        alert("Senhas não Conferem");                    
                 }else{
                     if ($('#txtNovaSenha').val() == ""){
                         alert("Nova senha Obrigatorio!");
                         $('#txtNovaSenha').focus();
                         end();
                     }
                     else if ($('#txtConfirmacao').val() == ""){
                        alert("Confirmação de senha Obrigatorio!");
                        $('#txtConfirmacao').focus();
                        end();
                     }
                 }
            },            
            "Cancel": function() {
                   $(this).dialog("close");
            }
        }       
   });
   
   //Evento do Botão Esqueci a Senha
   $('#btnEsqueci').click(function(){
       $('#dialog').dialog('open');
   })
   
   //Evento do Botão Logar
   $('#btnLogar').click(function(){
       if ($('#txtUsuario').val() != "" && $('#txtSenha').val() != "") {
           $.post("/index/Logar", {loguin:$('#txtUsuario').val(), senha:$('#txtSenha').val()}, function(data){
                   if (data == false)
                       $('#senhaNova').dialog('open');
                   else if (data == true)
                       location.href="/home";
                   else
                       alert(data);
           })
       }else{
           if ($('#txtUsuario').val() == ""){
               alert("Usuário Obrigatorio!");
               $('#txtUsuario').focus();
               return false;
           }
           else if ($('#txtSenha').val() == ""){
               alert("Senha Obrigatorio!");
               $('#txtSenha').focus();
               return false;
           }
       }
   })
})

function Enter(event){
   if (event==13) {
        $('#btnLogar').click();
   }    

}