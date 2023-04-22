<?php

class Quotations extends Connection
{
    private $table = 'tbl_quotation_headers';
    public $pk = 'qh_id';
    public $name = 'quote_number';
    public $desc = 'qh_description';


    private $table_detail = 'tbl_quotation_details';
    public $pk2 = 'qd_id';

    public function add()
    {
        $quote_number = $this->clean($this->inputs[$this->name]);
        $is_exist = $this->select($this->table, $this->pk, "quote_number = '$quote_number'");
        if ($is_exist->num_rows > 0) {
            return -2;
        } else {
            $form = array(
                $this->name     => $this->clean($this->inputs[$this->name]),
                'client_id'     => $this->inputs['client_id'],
                'qh_description'   => $this->inputs['qh_description'],
                'quote_date'    => $this->inputs['quote_date'],
                'qh_valid_until'   => $this->inputs['qh_valid_until'],
            );
            return $this->insertIfNotExist($this->table, $form, '', 'Y');
        }
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
        $quote_number = $this->clean($this->inputs[$this->name]);
        $is_exist = $this->select($this->table, $this->pk, "quote_number = '$quote_number' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                $this->name         => $this->clean($this->inputs[$this->name]),
                'client_id'         => $this->inputs['client_id'],
                'qh_description'    => $this->inputs['qh_description'],
                'quote_number'      => $this->inputs['quote_number'],
                'quote_date'        => $this->inputs['quote_date'],
                'qh_valid_until'    => $this->inputs['qh_valid_until'],
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function add_detail()
    {

        $form = array(
            'qh_id'             => $this->inputs['qh_id'],
            'qd_description'    => $this->inputs['qd_description'],
            'qd_unit'           => $this->inputs['qd_unit'],
            'qd_amount'         => $this->inputs['qd_amount']
        );

        return $this->insert($this->table_detail, $form);
    }

     public function show_detail()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table_detail, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['qd_amount'] = number_format($row['qd_amount'],2);
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
