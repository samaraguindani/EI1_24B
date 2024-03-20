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

    $('#salvarEvento').click(function(){
        var titulo = $('#titulo').val();
        var descricao = $('#descricao').val();
        var data = $('#date').val();
        var categoria_id = $('#categoria').val();

        salvarEvento(titulo, descricao, data, categoria_id);
    });
        
    function clearInputs() {
        document.getElementById('titulo').value = '';
        document.getElementById('descricao').value = '';
        document.getElementById('date').value = '';
    }
    
    function salvarEvento(titulo, descricao, data, categoria_id) {
        $.ajax({
            url: 'db_connection.php',
            type: 'POST',
            data: {
                titulo: titulo,
                descricao: descricao,
                data: data,
                categoria_id: categoria_id
            },
            success: function(response){
                alert(response);
            }
        });
    }

    // function enviarDados() {
    //     var formulario = document.getElementById("meuFormulario");
    //     var formData = new FormData(formulario);
    
    //     fetch('verifica_dados.php', {
    //         method: 'POST',
    //         body: formData
    //     })
    //     .then(response => {
    //         if (!response.ok) {
    //             throw new Error('Erro ao enviar dados');
    //         }
    //         return response.text();
    //     })
    //     .then(data => {
    //         console.log(data);
    //         // Faça o que quiser com a resposta do servidor
    //     })
    //     .catch(error => {
    //         console.error('Erro:', error);
    //     });
    // }
    
});
