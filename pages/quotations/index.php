<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Transactions</a></div>
            <div class="breadcrumb-item">Quotations</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon bg-secondary" style="border: 1px dashed gray;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Quotations</div>
                Manage quotations here.
            </div>
            <div>
                <a href="#" class="btn btn-icon icon-left btn-primary" onclick="addModal()"><i class="fas fa-plus"></i> Add</a>
                <a href="#" class="btn btn-icon icon-left btn-danger" onclick='deleteEntry()'><i class="fas fa-trash"></i> Delete</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dt_entries" class="table table-striped">
                                <thead class="">
                                    <tr>
                                        <th style="width:10px;">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1" onchange="checkAll(this, 'dt_id')">
                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th></th>
                                        <th>Quotation No.</th>
                                        <th>Client</th>
                                        <th>Description</th>
                                        <th>Quote Date</th>
                                        <th>Valid Until</th>
                                        <th>Date Modified</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "modal_quotations.php"; ?>
<script type="text/javascript">
    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [
                {
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.quotation_id + '" value=' + row.quotation_id + '><label for="checkbox-b' + row.quotation_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><a href='#' class='button-custom-style' onclick='getEntryDetails(" + row.quotation_id + ")'><span class='fa fa-edit'></span></a></center>";
                    }
                },
                {
                    "data": "quotation_id"
                },
                {
                    "data": "client_name"
                },
                {
                    "data": "quotation_description"
                },
                {
                    "data": "quotation_date"
                },
                {
                    "data": "quotation_valid_until"
                },
                {
                    "data": "date_modified"
                }
            ]
        });
    }

    function getEntries2() {

        var hidden_id_2 = $("#hidden_id_2").val();
        var param = "quotation_id = '" + hidden_id_2 + "'";

        $("#dt_entries_2").DataTable().destroy();
        $("#dt_entries_2").DataTable({
            "processing": true,
            "order": [
                [3, 'desc']
            ],
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show_detail",
                "dataSrc": "data",
                "type": "POST",
                "data": {
                    input: {
                        param: param
                    }
                }
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id_2" id="checkbox-c' + row.quotation_detail_id + '" value=' + row.quotation_detail_id + '><label for="checkbox-c' + row.quotation_detail_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "data": "quotation_detail_description"
                },
                {
                    "data": "quotation_detail_unit"
                },
                {
                    "data": "quotation_detail_amount"
                },
                {
                    "data": "date_added"
                }
            ]
        });
    }

    function deleteQuoteDetails() {

        var count_checked = $("input[name='dt_id_2']:checked").length;

        if (count_checked > 0) {

            $("#btn_delete_qd").prop("disabled", true);
            $("#btn_delete_qd").html("<span class='fa fa-spinner fa-spin'></span>");
            swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover these entries!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var checkedValues = $("input[name='dt_id_2']:checked").map(function() {
                            return this.value;
                        }).get();

                        $.ajax({
                            type: "POST",
                            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=deleteQuoteDetails",
                            data: {
                                input: {
                                    ids: checkedValues
                                }
                            },
                            success: function(data) {
                                getEntries2();
                                var json = JSON.parse(data);
                                console.log(json);
                                if (json.data == 1) {
                                    swal("Success!", "Successfully deleted details!", "success");
                                } else {
                                    failed_query(json);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                errorLogger('Error:', textStatus, errorThrown);
                            }
                        });
                    } else {
                        swal("Cancelled", "Entries are safe :)", "error");
                    }
                    $("#btn_delete_qd").prop('disabled', false);
                    $("#btn_delete_qd").html('<i class = "fas fa-trash"> </i> Delete');
                });
        } else {
            swal("Cannot proceed!", "Please select entries to delete!", "warning");
        }
    }

    $(document).ready(function() {
        getSelectOption('Clients', 'client_id', 'client_name');
        getEntries();
    });
</script>