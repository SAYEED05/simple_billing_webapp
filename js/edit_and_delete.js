//PRODUCT EDIT AND DELETE
$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'product_edit_delete.php',
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

//BILL EDIT AND DELETE
$(document).ready(function () {
    $('#billtable').Tabledit({
        url: 'bill_edit_delete.php',
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


//CUSTOMER INFO EDIT AND DELETE
$(document).ready(function () {
    $('#custdet').Tabledit({
        url: 'customer_edit_delete.php',
        columns: {
            identifier: [0, "id"],
            editable: [[1, 'customer_name'], [2, 'mobile_no'], [3, 'email_id']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id).remove();
            }
        }
    });

});

//BILL TABLE DELETE ALL
$(document).ready(function () {
    $('.delall').click(function () {
        var clickbtnvalue = $(this).val();
        var ajaxurl = 'bill_edit_delete.php',
            data = { 'act': clickbtnvalue };
        $.post(ajaxurl, data, function (response) {
            //alert("Deleted All");
            location.reload();
        });
    });
});
