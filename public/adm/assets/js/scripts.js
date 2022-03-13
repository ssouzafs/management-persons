$(function () {

    // DATATABLES
    $('#dataTable').DataTable({
        responsive: true,
        "pageLength": 5,
        paging: true,
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
    });

    let action;
    let content;

    /** Evento de click que após carregar a DOM, abre a modal com conteúdo já inserido  */
    $(document).on('click', '.ajax_delete', function (event) {
        event.preventDefault();

        const button = $(this);
        content = button.data('id');
        action = button.data('action');
        $('#modal').modal();
        $('.show_content_option').text(content);
    });

    /** Evento de Click de confirmação de exclusão de registro  presente na modal */
    $(document).on('click', '.btn_confirmed', function (event) {
        event.preventDefault();

        $.ajax({
            url: action,
            type: "DELETE",
            dataType: 'json',
            success: function (response) {
                if (response.fail) {
                    ajax_message(response.fail);
                }

                if (response.success) {
                    $('#modal').modal('hide');
                    ajax_message(response.success);
                    ManagerTable.refreshTable();
                }
            }
        });
    });

    // MOSTRAR NOTIFICAÇÃO
    function ajax_message(message) {
        const ajax_message = $(message);
        $(".trigger_message").html(ajax_message);
        $(".trigger").effect("bounce");
    }

    // SUMIR COM A DIV DE NOTIFICAÇÃO APÓS O CLICK
    $(".trigger_message").on("click", ".trigger", function (e) {
        $(this).effect("bounce").fadeOut(1);
    });
});
