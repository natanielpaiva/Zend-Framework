$(document).ready(function() {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    
    $('#cadastro').dialog({
        autoOpen: false,
        minHeight: 300,
        width: 500,
        title: "CADASTRO",
        resizable: false,
        modal:true,
        buttons: {
            "Ok": function() {
                if ($('#title').val() != '') {    
                    $.post("/agenda/incluir", {titulo:$('#title').val(),descricao:$('#descricao').val(), start:$('#start').val()})
                    $(this).dialog("close");
                    location.href="/agenda";
                }else
                    alert('Titulo Obrigatorio!');

            },
            "Cancel": function() {
               $(this).dialog("close");
           }
       }
    });
    
    $('#calendar').fullCalendar({
        theme: true,
        header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
        },
        
        height:(screen.height - 300),
        
        editable: true,
        events: "/agenda/buscaAgenda",

        eventDrop: function(event, delta) {         
            $.post("/agenda/moverEvento", {id: event.id_agenda, delta:delta});            
        },        
        
        dayClick: function(date, allDay) {
            if (allDay) {
                $('#cadastro').dialog('open');                
                $('#start').val(date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate());
                
            }else{
                $('#cadastro').dialog('open');
                $('#start').val(date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate()+' '+date.getHours()+':'+date.getMinutes()+':'+date.getSeconds());
            }
        }           
    });
});