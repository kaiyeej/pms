<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Transactions</a></div>
            <div class="breadcrumb-item">Clients</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon bg-secondary" style="border: 1px dashed gray;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Payment</div>
                Manage payment here.
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
                                        <th>Project</th>
                                        <th>Payment Date</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                        <th>Date Added</th>
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
<?php include "modal_payment.php"; ?>
<script type="text/javascript">
    function updateAcknowledgementReceiptAmount(){
        var amount = $("#ack_amount").val()*1;
        var payment_id = $("#ack_payment_id").val();

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=update_acknowledgement_receipt_amount",
            data: {
              input: {
                id: payment_id,
                amount:amount
              }
            },
            success: function(data) {
                var json = JSON.parse(data);
                if (json.data == 1) {
                   success_update();
                }else{
                    failed_query(json);
                }
            }
        });
    }


    function viewAcknowledgementReceipt(id){
        $.ajax({
        type: "POST",
        url: "controllers/sql.php?c=" + route_settings.class_name + "&q=view_acknowledgement_receipt",
        data: {
          input: {
            id: id
          }
        },success: function(data) {
            var jsonParse = JSON.parse(data);
            const json = jsonParse.data;

            $('.input-item').map(function() {
                const id_name = this.id;
                this.value = json[id_name];
                $("#" + id_name).val(json[id_name]).trigger('change');
            });
        }
        });
        $("#modalEntryAcknowledgement").modal('show');
    }

    function printAckowledgementReceipt(id){
        $.ajax({
        type: "POST",
        url: "controllers/sql.php?c=" + route_settings.class_name + "&q=view_acknowledgement_receipt",
        data: {
          input: {
            id: id
          }
        },success: function(data) {
            var jsonParse = JSON.parse(data);
            const json = jsonParse.data;
            $("#print_acknowledgement_date").html(json.print_acknowledgement_date);
            $("#print_acknowledgement_address").html(json.print_acknowledgement_address);
            $("#print_acknowledgement_client").html(json.print_acknowledgement_client);
            $("#print_acknowledgement_amount").html(json.print_acknowledgement_amount);
            $("#print_acknowledgement_project_name").html(json.print_acknowledgement_project_name);
            $("#print_acknowledgement_payment_date").html(json.print_acknowledgement_payment_date);
        }
        });

        $("#modalEntryAcknowledgementPrint").modal('show');
    }

    document.getElementById("btnPrint").onclick = function () {
        printElement(document.getElementById("printAcknowledgementReceiptDiv"));
    }

    function printElement(elem) {
        var domClone = elem.cloneNode(true);
        
        var $printSection = document.getElementById("printSection");
        
        if (!$printSection) {
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            document.body.appendChild($printSection);
        }
        
        $printSection.innerHTML = "";
        $printSection.appendChild(domClone);
        window.print();
    }

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.payment_id + '" value=' + row.payment_id + '><label for="checkbox-b' + row.payment_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return '<div class="dropdown d-inline"><a class="button-custom-style" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span class="fa fa-cog"></span></a><div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"><a class="dropdown-item has-icon" href="#" onclick="getEntryDetails('+row.payment_id+')"><i class="far fa-edit"></i> Update payment</a><a class="dropdown-item has-icon" href="#" onclick="printAckowledgementReceipt('+row.payment_id+')"><i class="fa fa-print"></i> Print Acknowledgement Receipt</a><a class="dropdown-item has-icon" href="#" onclick="viewAcknowledgementReceipt('+row.payment_id+')"><i class="far fa-eye"></i>  View Acknowledgement Receipt</a></div> </div>';
                    }
                },
                {
                    "data": "project"
                },
                {
                    "data": "payment_date"
                },
                {
                    "data": "total"
                },
                {
                    "data": "payment_remarks"
                },
                {
                    "data": "date_added"
                }
            ]
        });
    }

    $(document).ready(function() {
        getEntries();
        getSelectOption('Projects', 'project_id', 'project_name');
    });
</script>