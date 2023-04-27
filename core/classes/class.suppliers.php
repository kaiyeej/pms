<?php

class Suppliers extends Connection
{
    private $table = 'tbl_suppliers';
    public $pk = 'supplier_id';
    public $name = 'supplier_name';

    public function show()
    {
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function add()
    {
        $supplier_name = $this->clean($this->inputs[$this->name]);
        $is_exist = $this->select($this->table, $this->pk, "supplier_name = '$supplier_name'");
        if ($is_exist->num_rows > 0) {
            return -2;
        } else {
            $form = array(
                $this->name             => $this->clean($this->inputs[$this->name]),
                'supplier_address'        => $this->inputs['supplier_address'],
                'supplier_remarks'        => $this->inputs['supplier_remarks'],
                'supplier_contact_num'    => $this->inputs['supplier_contact_num']
            );
            return $this->insert($this->table, $form);
        }
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $supplier_name = $this->clean($this->inputs[$this->name]);
        $is_exist = $this->select($this->table, $this->pk, "supplier_name = '$supplier_name' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                $this->name             => $this->clean($this->inputs[$this->name]),
                'supplier_address'        => $this->inputs['supplier_address'],
                'supplier_remarks'        => $this->inputs['supplier_remarks'],
                'supplier_contact_num'    => $this->inputs['supplier_contact_num']
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
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

    public function delete_entry()
    {
        $id = $this->inputs['id'];

        return $this->delete($this->table, "$this->pk = $id");
    }
}
