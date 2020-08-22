function deleteRow(row) {
    var i = row.parentNode.parentNode.rowIndex;
    document.getElementById('billdet').deleteRow(i);
}


function insRow() {
    var x = document.getElementById('billdet');
    // deep clone the targeted row
    var new_row = x.rows[1].cloneNode(true);
    // get the total number of rows
    var len = x.rows.length;
    // set the innerHTML of the first row 
    new_row.cells[0].innerHTML = len;

    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';

    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
    var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';
    /* var inp4 = new_row.cells[4].getElementsByTagName('input')[0];
    inp4.id += len;
    inp4.value = ''; */

    // append the new row to the table
    x.appendChild(new_row);
}



