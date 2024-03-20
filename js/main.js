document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: []
    });
    calendar.render();

    document.getElementById('salvarEvento').addEventListener('click', function() {
        var titulo = document.getElementById('titulo').value;
        var descricao = document.getElementById('descricao').value;
        var data = document.getElementById('date').value;
        var categoria = document.getElementById('categoria').value;

        if (!titulo || !data || !categoria) {
            alert('Por favor, preencha todos os campos obrigatórios.');
            return;
        }

        var evento = {
            title: titulo,
            start: data,
            extendedProps: {
                descricao: descricao,
                categoria: categoria
            }
        };

        calendar.addEvent(evento);
        clearInputs();
    });

    function clearInputs() {
        document.getElementById('titulo').value = '';
        document.getElementById('descricao').value = '';
        document.getElementById('date').value = '';
    }


    $('#salvarEvento').click(function(){
        var titulo = $('#titulo').val();
        var descricao = $('#descricao').val();
        var data = $('#date').val();
        var categoria_id = $('#categoria').val(); // Agora estamos pegando o valor do ID da categoria

        salvarEvento(titulo, descricao, data, categoria_id);
    });
        
    function salvarEvento(titulo, descricao, data, categoria_id) {
        $.ajax({
            url: 'db_connection.php',
            type: 'POST',
            data: {
                titulo: titulo,
                descricao: descricao,
                data: data,
                categoria_id: categoria_id // Agora estamos enviando o ID da categoria
            },
            success: function(response){
                alert(response);
            }
        });
    }
});
