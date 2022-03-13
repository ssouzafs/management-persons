let route;
let datatable;
let columnsDatabase;
let pageLength = 5;
let lengthMenu = [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, "Todos"]];
let pagingType = "full";

let arrayColumns = new Array();

let SetupDataTable = function (tableElement)  {
    datatable = $(tableElement).DataTable({
        "responsive": true,
        "pageLength": pageLength,
        "lengthMenu": lengthMenu,
        "pagingType": pagingType,
        "serverSide": true,
        "processing": true,
        "ajax": route,
        "columns": columnsDatabase,
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registro(s)",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "de um total de _MAX_ registros",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro foi encontrado",
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
};

// Controlando datatable (popular setup do datatable)
let ManagerTable = function () {
    let table;

    return {

        // Setar nome da tabela
        setName: function (name) {
            return table = name
        },

        // Setar colunas
        setColumns: function (columns) {
            for (let i in columns) {
                arrayColumns.push({data: columns[i]})
            }
            return columnsDatabase = arrayColumns;
        },

        // Setar botões de ação
        setButton: function (orderable = false, searchable = false) {
            return arrayColumns.push({data: 'action', orderable: orderable, searchable: searchable});
        },

        // Setar a Rota
        setRoute: function (name) {
            return route = name;
        },

        // Setar page lenght
        setPageLenght: function (value) {
            return pageLength = value
        },

        // Setar paging type
        setPagingType: function (value) {
            return pagingType = value;
        },

        // Invocar o setup para renderizar a tabela na tela
        render: function () {
            return SetupDataTable(table);
        },

        // Recarregar tabela sem refresh da página inteira
        refreshTable: function () {
            return datatable.ajax.reload(null, false);
        }
    };
}();
