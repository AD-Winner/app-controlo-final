$('table').DataTable( {
    language: {
                "sEmptyTable": "Nenhuma informação disponivel ",
                "sInfo": "Mostrar elemento de _START_ à _END_ de _TOTAL_ elementos",
                "sInfoEmpty": "Mostrar elemento de 0 à 0 de 0 elementos",
                "sInfoFiltered": "(filtrado à partir de _MAX_ elementos ao total)",
                "sInfoThousands": ",",
                "sLengthMenu": "Mostrar _MENU_ elementos",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Tratamento...",
                "sSearch": "Pesquisar :",
                "sZeroRecords": "Nenhum elemento correspondante encontrado",
                "oPaginate": {
                "sFirst": "Primeiro",
                "sLast": "Ultimo",
                "sNext": "Seguinte",
                "sPrevious": "Anterir"
                },
                "oAria": {
                "sSortAscending": ": activar para ordenar a coluna em ordem crescente",
                "sSortDescending": ": activar para ordenar a coluna em ordem decrescente"
                },
                "select": {
                "rows": {
                "0": "Nenhuma linha selecionada",
                "1": "1 linha selecionada",
                "_": "%d linhas selecionadas"
                }
                }
                    },
                    "lengthMenu": [[ 10, 25, 100, -1], [10, 25, 100, "Todo"]],
                    "ordering": false,
                }
 );
