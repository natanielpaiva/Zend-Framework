$(document).ready(function() { 
        $('.dataTable').dataTable({
            "sPaginationType": "full_numbers",
            "bInfo": false,
            "oLanguage": {
                "sProcessing": "Aguarde enquanto os dados são carregados ...",
                "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                "sZeroRecords": "Nenhum registro correspondente a busca foi encontrado",
                "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
                "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
                "sInfoFiltered": "",
                "sSearch": "Procurar",
                "oPaginate": {
                   "sFirst":    "Primeiro",
                   "sPrevious": "Anterior",
                   "sNext":     "Proximo",
                   "sLast":     "Ultimo"
                }
             } 
        });
        
        $(".excluir").click(function(){
            decisao = confirm('Realmente gostaria de excluir o registro ?');
            if (decisao == true)
                return true;
            else
                return false;
        })
}); 

