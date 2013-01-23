$(document).ready(function() {
    $("#salvar").click(function(){

        var params = $('#form-tipo-noticia').serialize();
        $.ajax({
            type: "POST",
            url: "/tipo-noticia/add",
            data: params,
            dataType: 'json',
            success: function(msg){
                alert( "Retorno: " + msg.retorno );
            }
        });

    })
});