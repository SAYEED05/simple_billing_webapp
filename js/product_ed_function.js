$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'action.php',
        columns: {
            identifier: [0, "prod_id"],
            editable: [[1, 'prod_name'], [2, 'price']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id).remove();
            }
        }
    });

});


$(document).ready(function () {
    $('#billtable').Tabledit({
        url: 'actiontwo.php',
        columns: {
            identifier: [0, "s_no"],
            editable: [[3, 'price'], [4, 'qty'], [5, 'total']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id).remove();
            }
        }
    });

});  