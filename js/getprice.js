$('#prodname').on('change', function () {
    var dataValue = $('option:selected', this).attr('data-value'); //getting the value from the attribute
    $('#price').val(dataValue); //add the value to input box
});



