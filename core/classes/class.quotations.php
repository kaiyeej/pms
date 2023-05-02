<?php

class Quotations extends Connection
{
    private $table = 'tbl_quotations';
    public $pk = 'quotation_id';
    public $desc = 'quotation_description';
    public $name = 'quotation_id';

    private $table_detail = 'tbl_quotation_details';
    public $pk2 = 'quotation_detail_id';

    public function add()
    {
        $form = array(
            'client_id'                 => $this->inputs['client_id'],
            'quotation_description'     => $this->inputs['quotation_description'],
            'quotation_date'            => $this->inputs['quotation_date'],
            'quotation_valid_until'     => $this->inputs['quotation_valid_until'],
        );
        return $this->insert($this->table, $form, 'Y');
    }

    public function show()
    {
        $rows = array();
        $Clients = new Clients;
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['client_name'] = $Clients->name($row['client_id']);
            $rows[] = $row;
        }
        return $rows;
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

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $Clients = new Clients;
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        $row['client_name'] = $Clients->name($row['client_id']);
        return $row;
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
       
            $form = array(
                'client_id'                 => $this->inputs['client_id'],
                'quotation_description'     => $this->inputs['quotation_description'],
                'quotation_date'            => $this->inputs['quotation_date'],
                'quotation_valid_until'     => $this->inputs['quotation_valid_until'],
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
   
    }

    public function add_detail()
    {

        $form = array(
            'quotation_id'                    => $this->inputs['quotation_id'],
            'quotation_detail_description'    => $this->inputs['quotation_detail_description'],
            'quotation_detail_unit'           => $this->inputs['quotation_detail_unit'],
            'quotation_detail_amount'         => $this->inputs['quotation_detail_amount']
        );

        return $this->insert($this->table_detail, $form);
    }

     public function show_detail()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table_detail, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['quotation_detail_amount'] = number_format($row['quotation_detail_amount'],2);
            $rows[] = $row;
        }
        return $rows;
    }

    public function deleteQuoteDetails()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table_detail, "$this->pk2 IN($ids)");
    }
}
