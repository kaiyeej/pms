<?php

class ExpenseCategory extends Connection
{
    private $table = 'tbl_expense_category';
    public $pk = 'expense_category_id';
    public $name = 'expense_category';

    public function add()
    {
        $expense_category = $this->clean($this->inputs[$this->name]);
        $is_exist = $this->select($this->table, $this->pk, "expense_category = '$expense_category'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                $this->name => $this->clean($this->inputs[$this->name]),
                'remarks'   => $this->inputs['remarks'],
            );
            return $this->insert($this->table, $form);
        }
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $expense_category = $this->clean($this->inputs[$this->name]);
        $is_exist = $this->select($this->table, $this->pk, "expense_category = '$expense_category' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                $this->name => $this->clean($this->inputs[$this->name]),
                'remarks'   => $this->inputs['remarks'],
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
