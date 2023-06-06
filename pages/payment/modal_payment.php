<form method='POST' id='frm_submit'>
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><span class='ion-compose'></span> Add Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[payment_id]">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Project</label>
                            <select class="form-control input-item select2" name="input[project_id]" id="project_id" style="width:100%" autocomplete="off" required></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Amount</label>
                            <input type="number" step="0.1" class="form-control input-item" placeholder="Payment amount" name="input[payment_amount]" autocomplete="off" id="payment_amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date</label>
                            <input type="date" class="form-control input-item" name="input[payment_date]" id="payment_date" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Remarks</label>
                            <textarea class="form-control" class="form-control input-item" placeholder="Payment remarks" name="input[payment_remarks]" id="payment_remarks" autocomplete="off"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="modal fade" id="modalEntryAcknowledgement" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"><span class='ion-compose'></span> Acknowledgement Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hidden_id" name="input[payment_id]">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Date</label>
                        <input type="text" class="form-control input-item" name="ack_date" id="ack_date" readonly>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Project</label>
                       <input type="text" class="form-control input-item" name="ack_project" id="ack_project" readonly>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Customer</label>
                        <input type="text" class="form-control input-item" name="ack_customer" id="ack_customer" readonly>
                    </div>

                    <div class="form-group col-md-12">
                        <label>E-mail</label>
                        <input type="text" class="form-control input-item" name="ack_email" id="ack_email" readonly>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Amount</label>
                        <input type="number" step="0.1" class="form-control input-item" name="input[ack_amount]" autocomplete="off" id="ack_amount" required>
                    </div>

                    <input type="hidden" class="form-control input-item" id="ack_payment_id">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btn_submit" class="btn btn-primary" onclick="updateAcknowledgementReceiptAmount()">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalEntryAcknowledgementPrint" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"><span class='ion-compose'></span> Acknowledgement Receipt Print</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id='printAcknowledgementReceiptDiv'>
                    <div label='jc_background_image' style="background-image: url('assets/img/logo_2.png');background-repeat:no-repeat;background-size: contain;background-position: center;">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="assets/img/logo_1.png" alt="logo" width="50%"><br><br>
                                
                                <span style="font-weight: bold; font-size: 16pt;">
                                    <span id="print_acknowledgement_client"></span> <br>
                                    <span id="print_acknowledgement_address"></span>
                                </span>
                            </div>
                            <div class="col-sm-6" style="text-align: end;font-size: 16pt;">
                                <span style="font-weight: bold;" id="print_acknowledgement_date"></span>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row">
                           <div class="col-sm-12">
                                <span style="font-weight: bold;font-size: 16pt;">
                                    Dear Sir/Madam, 
                                    <br><br>

                                    <span> &nbsp &nbsp &nbsp &nbsp &nbsp This letter acknowledges the payment with a total of <span style="font-style: italic;" id=print_acknowledgement_amount></span> for your <span id="print_acknowledgement_project_name"></span> on <span id="print_acknowledgement_payment_date"></span>.</span> 
                                    <br><br>

                                    <span> &nbsp &nbsp &nbsp &nbsp &nbsp We thank you for the clearance of this payment. Do reach out if you have any issues with this transaction.</span> 
                                    <br><br><br><br>

                                    Sincerely,
                                    <br><br>
                                    <?= $Users->fullname($_SESSION['user']['id']); ?>
                                </span>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btnPrint" class="btn btn-primary">
                    Print
                </button>
            </div>
        </div>
    </div>
</div>