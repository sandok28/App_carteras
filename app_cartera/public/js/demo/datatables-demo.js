// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable(
        {
            dom: 'Bfrtip',
            buttons: [
                'selected',
                'selectedSingle',
                'selectAll',
                'selectNone',
                'selectRows',
                'selectColumns',
                'selectCells'
            ],
            select: true
        } 

    );
});

$(document).ready(function() {
    $('#dataTableActivity').DataTable({
        "order": [[ 0, 'desc' ]]
    });
});
