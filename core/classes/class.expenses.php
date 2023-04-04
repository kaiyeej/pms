<?php

class Expenses extends Connection
{
    private $table = 'tbl_expenses';
    public $pk = 'expense_id';
    public $name = 'expense_category_id';

    public function add()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'expense_amount'    => $this->inputs['expense_amount'],
            'expense_desc'      => $this->inputs['expense_desc'],
            'expense_date'      => $this->inputs['expense_date'],
        );
        return $this->insert($this->table, $form);
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'expense_amount'    => $this->inputs['expense_amount'],
            'expense_desc'      => $this->inputs['expense_desc'],
            'expense_date'      => $this->inputs['expense_date'],
        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function show()
    {
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $ExpenseCategory = new ExpenseCategory();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['expense_category'] = $ExpenseCategory->name($row['expense_category_id']);
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
