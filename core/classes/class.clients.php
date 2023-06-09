<?php

class Clients extends Connection
{
    private $table = 'tbl_clients';
    public $pk = 'client_id';
    public $name = 'client_name';

    public function add()
    {
        $client_name = $this->clean($this->inputs[$this->name]);
        $is_exist = $this->select($this->table, $this->pk, "client_name = '$client_name'");
        if ($is_exist->num_rows > 0) {
            return -2;
        } else {
            $form = array(
                $this->name             => $this->clean($this->inputs[$this->name]),
                'client_email'          => $this->inputs['client_email'],
                'client_address'        => $this->inputs['client_address'],
                'client_remarks'        => $this->inputs['client_remarks'],
                'client_contact_num'    => $this->inputs['client_contact_num']
            );
            return $this->insert($this->table, $form);
        }
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $client_name = $this->clean($this->inputs[$this->name]);
        $is_exist = $this->select($this->table, $this->pk, "client_name = '$client_name' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                $this->name             => $this->clean($this->inputs[$this->name]),
                'client_email'          => $this->inputs['client_email'],
                'client_address'        => $this->inputs['client_address'],
                'client_remarks'        => $this->inputs['client_remarks'],
                'client_contact_num'    => $this->inputs['client_contact_num']
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

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
