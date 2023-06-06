<?php

class Payment extends Connection
{
    private $table = 'tbl_payments';
    public $pk = 'payment_id';
    public $name = 'project_id';

    public function add()
    {
        $form = array(
            $this->name        => $this->clean($this->inputs[$this->name]),
            'payment_amount'   => $this->inputs['payment_amount'],
            'payment_remarks'  => $this->inputs['payment_remarks'],
            'payment_date'     => $this->inputs['payment_date'],
        );
        return $this->insert($this->table, $form);
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $form = array(
            $this->name        => $this->clean($this->inputs[$this->name]),
            'payment_amount'   => $this->inputs['payment_amount'],
            'payment_remarks'  => $this->inputs['payment_remarks'],
            'payment_date'     => $this->inputs['payment_date'],
        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function show()
    {
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $Project = new Projects();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['project'] = $Project->name($row['project_id']);
            $row['total'] = number_format($row['payment_amount'], 2);
            $rows[] = $row;
        }
        return $rows;
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        return $result->fetch_assoc();
    }

    public function view_acknowledgement_receipt()
    {
        $primary_id = $this->inputs['id'];
        $result_payment = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        $payment_row = $result_payment->fetch_assoc();

        $result_project = $this->select("tbl_projects", "*", "project_id = '$payment_row[project_id]'");
        $project_row = $result_project->fetch_assoc();

        $result_client = $this->select("tbl_clients", "*", "client_id = '$project_row[client_id]'");
        $client_row = $result_client->fetch_assoc();

        $acknowledgement_receipt_result = $this->select('tbl_acknowledgement_receipt', "*", "$this->pk = '$primary_id'");
        $acknowledgement_receipt_row = $acknowledgement_receipt_result->fetch_assoc();
        $final_amount = $acknowledgement_receipt_row['amount']>0?$acknowledgement_receipt_row['amount']:$payment_row['payment_amount'];

        $row['ack_payment_id']  = $primary_id;
        $row['ack_date']        = $payment_row['payment_date'];
        $row['ack_customer']    = $client_row['client_name'];
        $row['ack_email']       = $client_row['client_email'];
        $row['ack_project']     = $project_row['project_name'];
        $row['ack_amount']      = $final_amount;

        //for print
        $row['print_acknowledgement_date']          = date("F j, Y", strtotime($payment_row['payment_date']));
        $row['print_acknowledgement_address']       = nl2br($client_row['client_address']);
        $row['print_acknowledgement_client']        = $client_row['client_name'];
        $row['print_acknowledgement_amount']        = ucwords($this->convert_number($final_amount))." Pesos Only (Php ".number_format($final_amount,2).")";
        $row['print_acknowledgement_project_name']  = $project_row['project_name'];
        $row['print_acknowledgement_payment_date']  = date("F j, Y", strtotime($payment_row['payment_date']));

        return $row;
    }

    public function update_acknowledgement_receipt_amount()
    {
        $payment_id = $this->inputs['id'];

        $acknowledgement_receipt_result = $this->select('tbl_acknowledgement_receipt', "count(acknowledgement_receipt_id) as count_acknowledgement_receipt", "payment_id = '$payment_id'");
        $acknowledgement_receipt_row = $acknowledgement_receipt_result->fetch_assoc();

        

        if($acknowledgement_receipt_row['count_acknowledgement_receipt']>0){ //update
            $form = array(
                'amount' => $this->inputs['amount']
            );
            return $this->update("tbl_acknowledgement_receipt", $form, "payment_id = '$payment_id'");
        }else{ //add


            $form = array(
                'payment_id'    => $payment_id,
                'amount'        => $this->inputs['amount']
            );
            return $this->insert("tbl_acknowledgement_receipt", $form);
        }

       
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, $this->name, "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row[$this->name];
    }
    
    public function total_paid($project_id)
    {
        $result = $this->select($this->table, "sum(payment_amount) as total", "project_id = '$project_id'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    public function delete_entry()
    {
        $id = $this->inputs['id'];

        return $this->delete($this->table, "$this->pk = $id");
    }


    public function convert_number($number) 
    {
        if (($number < 0) || ($number > 999999999)) 
        {
            throw new Exception('Number is out of range');
        }
        $giga = floor($number / 1000000);
        // Millions (giga)
        $number -= $giga * 1000000;
        $kilo = floor($number / 1000);
        // Thousands (kilo)
        $number -= $kilo * 1000;
        $hecto = floor($number / 100);
        // Hundreds (hecto)
        $number -= $hecto * 100;
        $deca = floor($number / 10);
        // Tens (deca)
        $n = $number % 10;
        // Ones
        $result = '';
        if ($giga) 
        {
            $result .= $this->convert_number($giga) .  'Million';
        }
        if ($kilo) 
        {
            $result .= (empty($result) ? '' : ' ') .$this->convert_number($kilo) . ' Thousand';
        }
        if ($hecto) 
        {
            $result .= (empty($result) ? '' : ' ') .$this->convert_number($hecto) . ' Hundred';
        }
        $ones = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eightteen', 'Nineteen');
        $tens = array('', '', 'Twenty', 'Thirty', 'Fourty', 'Fifty', 'Sixty', 'Seventy', 'Eigthy', 'Ninety');
        if ($deca || $n) {
            if (!empty($result)) 
            {
                $result .= ' and ';
            }
            if ($deca < 2) 
            {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n) 
                {
                    $result .= '-' . $ones[$n];
                }
            }
        }
        if (empty($result)) 
        {
            $result = 'zero';
        }
        return $result;
    }
}