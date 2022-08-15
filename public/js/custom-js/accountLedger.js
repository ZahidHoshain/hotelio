$(document).ready(function() {

    $.noConflict();
    var AccountLedgerList = $('#accountLedgerList').DataTable({
        dom: 'BtftCrltip',
        processing: true,
        serverSide: true,
        responsive: true,
        colReorder: true,
        stateSave: true,
        buttons: [{
                extend: 'copy',
                text: '<button class="btn copy"><i class="fa fa-copy"></i></button>',
                titleAttr: 'Copy Items',
                filename: 'account_ledger_list',

            },
            {
                extend: 'excel',
                text: '<button class="btn btn-success"><i class="fa-solid fa-file-excel"></i></button>',
                titleAttr: 'Export to Excel',
                filename: 'account_ledger_list',
            },
            {
                extend: 'pdf',
                text: '<button class="btn pdf"><i class="fa-solid fa-file-pdf"></i></button>',
                titleAttr: 'Export to PDF',
                filename: 'account_ledger_list',
            },
            {
                extend: 'csv',
                text: '<button class="btn btn-info"><i class="fa-solid fa-file-csv"></i></button>',
                titleAttr: 'Export to CSV',
                filename: 'account_ledger_list',
            },
            {
                // extend:'JSON',
                text: '<button class="btn btn-danger"><i class="fa-brands fa-node-js"></i></button>',
                titleAttr: 'Export to JSON',
                filename: 'account_ledger_list',
                action: function(e, dt, button, config) {
                    var data = dt.
                    buttons.exportData();
                    $.fn.dataTable.
                    fileSave(
                        new Blob([JSON.
                            stringify(data)
                        ])
                    );
                },

            },

        ],
        ajax: {
            url: '/acount/ledger',
            type: 'GET',
        },
        columns: [{data: 'id',visible:false},
            { data: 'Debit'},
            {data: 'Credit'},
            {data: 'Date'},
            {data: 'Method'},
            {data: 'Description'},
            {data: 'action',name: 'action'},
        ],
    });


    $('#AddNewBtn').on('click', function(e) {
        e.preventDefault();
        $('#AccountLedgerModal').modal('show');
    });

    $('#ResetFormBtn').on('click', function(e) {
        e.preventDefault();
        $('#NewAccountLedgerForm')[0].reset();
    });

    $('#SubmitBtn').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/acount/ledger',
            data: $('#NewAccountLedgerForm').serializeArray(),
            success: function(data) {
                AccountLedgerList.draw(false);
                $('#NewAccountLedgerForm')[0].reset();
                $('#AccountLedgerModal').modal('hide');
                Swal.fire(
                    'success',
                    'Tax updated successfully',
                    'success'
                );
            },
            error: function(data) {
                console.log('Error While Adding New' + data);
            }
        });
    });

    // $('.EditBtn').on('click', function(e) {
    //     e.preventDefault();
    //     var ID = $(this).val();
    //     $.ajax({
    //         type: 'GET',
    //         url: '/acount/ledger/' + ID,
    //         data: $('#EditForm').serializeArray(),
    //         success: function(data) {
    //             $('#EditForm')[0].reset();
    //             $('#IDEdit').val(data['id']);
    //             $('#DebitEdit').val(data['Debit']);
    //             $('#CreditEdit').val(data['Credit']);
    //             $('#DateEdit').val(data['Date']);
    //             $('#MethodEdit').val(data['Method']);
    //             $('#DescriptionEdit').val(data['Description']);
    //             $('#EditAccountLedgerModal').modal('show');
    //         }
    //     });
    // });
    $('body').on('click', '#EditBtn', function(e) {
        // alert('hello word');
        var ID = $(this).data('id');

        $.ajax({
            type: 'GET',
            url: '/acount/ledger/' + ID,
            success: function(data) {
                $('#EditForm')[0].reset();
                $('#IDEdit').val(data['id']);
                $('#DebitEdit').val(data['Debit']);
                $('#CreditEdit').val(data['Credit']);
                $('#DateEdit').val(data['Date']);
                $('#MethodEdit').val(data['Method']);
                $('#DescriptionEdit').val(data['Description']);
                $('#EditAccountLedgerModal').modal('show');
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
    $('#UpdateBtn').on('click', function(e) {
        e.preventDefault();
        var ID = $('#IDEdit').val();
        $.ajax({
            type: 'PATCH',
            url: '/acount/ledger/' + ID,
            data: $('#EditForm').serializeArray(),
            success: function(data) {
                AccountLedgerList.draw(false);
                $('#EditAccountLedgerModal').modal('hide');
                $('#EditForm')[0].reset();
                Swal.fire(
                    'success',
                    'Account Ledger updated', 'successfully',
                    'success'
                );
            },
            error: function(data) {
                console.log(data);
            },
        });
    });

    // $('.DeleteBtn').on('click', function(e) {
    //     e.preventDefault();
    //     var ID = $(this).val();

    //     Swal.fire({
    //         icon: 'error',
    //         title: 'Are you sure ?',
    //         text: 'You wont be able to revert this!',
    //         footer: '<a href="">Why do I have this issue?</a>'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 type: 'GET',
    //                 url: '/acount/ledger/delete/' + ID,
    //                 success: function(data) {
    //                     Swal.fire(
    //                         'Deleted!',
    //                         'Your file has been deleted.',
    //                         'success'
    //                     );
    //                 },
    //                 error: function(data) {
    //                     Swal.fire(
    //                         'Error!',
    //                         'Delete failed !',
    //                         'error'
    //                     );

    //                     console.log(data);
    //                 },
    //             });
    //         }
    //     });
    // });
    $('body').on('click','#DeleteBtn', function(e) {
        e.preventDefault();
        var ID = $(this).data('id');
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure ?',
            text: 'You wont be able to revert this!',
            showCancelButton : true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor : '#d33',
            confirmButtonText : 'Yes , delete it !',
            footer: '<a href="">Why do I have this issue?</a>'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: '/acount/ledger/delete/'+ID,
                    success: function(data) {
                AccountLedgerList.draw(false);
                        Swal.fire(
                            'success',
                            'Your file has been deleted.',
                            'success'
                        );
                    },
                    error: function(data) {
                        Swal.fire(
                            'Error!',
                            'Delete failed !',
                            'error'
                        );

                        console.log(data);
                    },
                });
            }
        });
    });

    $('#AllDeleteBtn').on('click', function(e) {
        e.preventDefault();

        Swal.fire({
            icon: 'warning',
            title: 'Are you sure ?',
            text: 'You wont be able to revert this!',
            showCancelButton : true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor : '#d33',
            confirmButtonText : 'Yes , delete it !',
            footer: '<a href="">Why do I have this issue?</a>'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: '/acount/ledger/delete',
                    success: function(data) {
                        AccountLedgerList.draw(false);
                        Swal.fire(
                            'All Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    },
                    error: function(data) {
                        Swal.fire(
                            'Error!',
                            'Delete failed !',
                            'error'
                        );
                        console.log(data);
                    },
                });
            }
        });
    });
   
});