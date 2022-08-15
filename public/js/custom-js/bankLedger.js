$(document).ready(function () {
    $.noConflict();
    var BankLedgerList = $("#BankLedgerList").DataTable({
        dom: "BtftCrltip",
        serverSide: true,
        processing: true,
        responsive: true,
        buttons: [
            {
                extend: "copy",
                text: '<button class="btn copy"><i class="fa fa-copy"></i></button>',
                titleAttr: "Copy Items",
                filename: "account_ledger_list",
            },
            {
                extend: "excel",
                text: '<button class="btn btn-success"><i class="fa-solid fa-file-excel"></i></button>',
                titleAttr: "Export to Excel",
                filename: "account_ledger_list",
            },
            {
                extend: "pdf",
                text: '<button class="btn pdf"><i class="fa-solid fa-file-pdf"></i></button>',
                titleAttr: "Export to PDF",
                filename: "account_ledger_list",
            },
            {
                extend: "csv",
                text: '<button class="btn btn-info"><i class="fa-solid fa-file-csv"></i></button>',
                titleAttr: "Export to CSV",
                filename: "account_ledger_list",
            },
            {
                text: '<button class="btn btn-danger"><i class="fa-brands fa-node-js"></i></button>',
                titleAttr: "Export to JSON",
                filename: "bank_ledger_list",
                action: function (e, dt, button, config) {
                    var data = dt.buttons.exportData();
                    $.fn.DataTable.fileSave(new Blob([JSON.stringify(data)]));
                },
            },
        ],
        ajax: {
            url: "/bankLedger",
            type: "GET",
        },
        columns: [
            { data: "id", visible: false },
            { data: "Bank" },
            { data: "Deposit" },
            { data: "Withdraw" },
            { data: "Date" },
            { data: "Description" },
            { data: "action", name: "action" },
        ],
    });
    $("#AddBtn").on("click", function (e) {
        e.preventDefault();
        $("#BankLedgerModal").modal("show");
    });

    $("#ResetFormBtn").on("click", function (e) {
        e.preventDefault();

        $("#NewBankLedgerForm")[0].reset();
    });

    $("#SubmitBtn").on("click", function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/bankLedger",
            data: $("#NewBankLedgerForm").serializeArray(),
            success: function (data) {
                BankLedgerList.draw(false);
                $("#NewBankLedgerForm")[0].reset();
                $("#BankLedgerModal").modal("hide");
                Swal.fire("Success", "Bank Ledger Successfully", "success");
            },
            error: function (data) {
                colsole.log("Error While Adding New" + data);
            },
        });
    });
    $("body").on("click", "#EditBtn", function (e) {
        e.preventDefault();
        var ID = $(this).data("id");
        // console.log(ID);
        $.ajax({
            type: "GET",
            url: "/bankLedger/" + ID,
            data: $("#EditBankLedgerForm").serializeArray(),
            success: function (data) {
                $("#EditBankLedgerForm")[0].reset();
                $("#IDEdit").val(data["id"]);
                $("#EditBankID").val(data["BankID"]);
                $("#EditDeposit").val(data["Deposit"]);
                $("#EditWithdrow").val(data["Withdraw"]);

                var date = new Date(data["InDate"]);
                var d = date.getDate();
                var m = date.getMonth() + 1;
                var y = date.getFullYear();

                InDate = d + "/" + m + "/" + y;
                // console.log(InDate);
                // $InDate = Date(data['InDate'])->format('d.m.Y H:m:s');
                // $('#EditDate').val(InDate);
                $("#EditDescription").val(data["Description"]);
                $("#EditBankLedgerModal").modal("show");
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
    $("#UpdateBtn").on("click", function (e) {
        e.preventDefault();
        var ID = $("#IDEdit").val();
        $.ajax({
            type: "PATCH",
            url: "/bankLedger/" + ID,
            data: $("#EditBankLedgerForm").serializeArray(),
            success: function (data) {
                BankLedgerList.draw(false);
                $("#EditBankLedgerModal").modal("hide");
                $("#EditBankLedgerForm")[0].reset();
                Swal.fire(
                    "success",
                    "Account Ledger updated",
                    "successfully",
                    "success"
                );
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
    $("body").on("click", "#DeleteBtn", function (e) {
        e.preventDefault();
        var ID = $(this).data("id");
        // console.log(ID);
        Swal.fire({
            icon: "warning",
            title: "Are you sure ?",
            text: "You wont be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes , delete it !",
            footer: '<a href="">Why do I have this issue?</a>',
            footer: '<a href="">Why do I have this issue?</a>',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "/bankLedger/delete/" + ID,
                    success: function (data) {
                        BankLedgerList.draw(false);
                        Swal.fire(
                            "Deleted!",
                            "Your file has been deleted.",
                            "success"
                        );
                    },
                    error: function (data) {
                        Swal.fire("Error!", "Delete failed !", "error");
                        console.log(data);
                    },
                });
            }
        });
    });
    $("#AllDeleteBtn").on("click", function (e) {
        e.preventDefault();

        Swal.fire({
            icon: "warning",
            title: "Are you sure ?",
            text: "You wont be able to revert this!",
            footer: '<a href="">Why do I have this issue?</a>',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "/bankLedger/delete/",
                    success: function (data) {
                        BankLedgerList.draw(false);
                        Swal.fire(
                            "All Deleted!",
                            "Your file has been deleted.",
                            "success"
                        );
                    },
                    error: function (data) {
                        Swal.fire("Error!", "Delete failed !", "error");

                        console.log(data);
                    },
                });
            }
        });
    });
    $("body").on("click", "#ViewBtn", function (e) {
        e.preventDefault();
        var ID = $(this).data("id");
        // console.log(ID);
        $.ajax({
            type: "GET",
            url: "/bankLedger/" + ID,
            success: function (data) {
                $("#ViewBank").text(data["Bank"]);
                $("#ViewDeposit").text(data["Deposit"]);
                $("#ViewWithdraw").text(data["Withdraw"]);
                $("#ViewDescription").text(data["Description"]);
                $("#ShowBankLedgerModal").modal("show");
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
});
