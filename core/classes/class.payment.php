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
}
