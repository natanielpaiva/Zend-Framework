$(document).ready(function() {
    $("#uf_id").change(function(){
        $.ajax({
            type: "POST",
            url: "/cidade/consulta-cidade",
            data: "uf_id="+$("#uf_id").val(),
            success: function(msg){
                $("#name").html(msg);
            }
        });
    });
});