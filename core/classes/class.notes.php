<?php

class Notes extends Connection
{
    private $table = 'tbl_notes';
    public $pk = 'note_id';
    public $name = 'content';

    public function add()
    {
        $form = array(
            $this->name => $this->clean($this->inputs[$this->name]),
            'user_id'   => $this->inputs['user_id'],
        );
        return $this->insert($this->table, $form);
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
    
        $form = array(
            $this->name => $this->clean($this->inputs[$this->name]),
        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
      
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
}
