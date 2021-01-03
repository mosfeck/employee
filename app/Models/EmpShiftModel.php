<?php

namespace App\Models;


use CodeIgniter\Model;

class EmpShiftModel extends Model
{
    protected $table = 'emp_shift_tbl';
    protected $primaryKey = 'emp_shift_id';
    protected $allowedFields = ['dept_id', 'employee_id', 'shift_id', 
                        'from_date','to_date','status'];

    protected $validationRules    = [
        'dept_id'     => 'required',
        'employee_id'     => 'required',
        'shift_id'     => 'required',
        'from_date'     => 'required',
        'to_date'     => 'required',
        'status'     => 'required'
    ];

    protected $validationMessages = [
        'dept_id'        => ['required' => 'Department name name must enter'],
        'employee_id'        => ['required' => 'Employee name must enter'],
        'shift_id'        => ['required' => 'Shift id start must enter'],
        'from_date'        => ['required' => 'From Date must enter'],
        'to_date'        => ['required' => 'To date must enter'],
        'status'        => ['required' => 'status must enter']
    ];

    public function getdataid($id = null)
    {
        return $this->asArray()
            ->where(['emp_shift_id' => $id])
            ->first();
    }

    public function getData()
    {
        //    display data
        $query = $this->db->query('SELECT es.emp_shift_id, d.department_name, 
            e.name, s.shift_name, es.from_date, es.to_date, es.status FROM 
            emp_shift_tbl es, department_tbl d, employee_tbl e, shift_tbl s 
            where es.shift_id = s.shift_id and es.dept_id = d.dept_id and 
            e.employee_id = es.employee_id order by emp_shift_id desc');
        return $query->getResultArray();
    }

    // csv data
    public function getcsvData(){
        $query = $this->db->query('SELECT * FROM emp_shift_tbl order by 
            emp_shift_id');
        return $query->getResultArray();
    }

    // department dropdown
    public function get_department(){
        $query = $this->db->query('SELECT department_name, dept_id FROM 
            department_tbl  GROUP BY department_name order by department_name');
        // return $query->getResultArray();
        foreach($query->getResult() as $row){
            //this sets the key to equal the value so that
            //the pulldown array lists the same for each
            $array[$row->dept_id] = $row->department_name;
        }
        return $array;
    }

    // shift dropdown
    public function get_shift(){
        $query = $this->db->query('SELECT shift_name, shift_id FROM shift_tbl 
             GROUP BY shift_name order by shift_name');
        // return $query->getResultArray();
        foreach($query->getResult() as $row){
            //this sets the key to equal the value so that
            //the pulldown array lists the same for each
            $array[$row->shift_id] = $row->shift_name;
        }
        return $array;
    }

    // get employee name based on department
    public function get_emp_name($dept_id = null){
        $sql = 'SELECT employee_tbl.employee_id, 
                    employee_tbl.name FROM employee_tbl inner JOIN department_tbl 
                    on employee_tbl.dept_id = department_tbl.dept_id WHERE 
                    employee_tbl.status="Yes" and department_tbl.dept_id=?';

        $query = $this->db->query($sql, array($dept_id));
        return $query->getResultArray();
        
        // foreach($query->getResult() as $row){
        //     //this sets the key to equal the value so that
        //     //the pulldown array lists the same for each
        //     $array[$row->employee_id] = $row->name;
        // }
        // return $array;


        // another style
        // $db  = \Config\Database::connect();
        // $query = $this->db->table('employee_tbl')
        //             ->where('dept_id', $dept_id);
        // return $query;
    }

    public function insertData($data)
    {
        $query = $this->db->table($this->table)->insert($data);
    }

    public function updateData($data, $id)
        {
                // $this->db->table($this->table)->update($data, $where);
                $role = $this->db->table($this->table)
                    ->where('emp_shift_id', $id)
                    ->update($data);
        }

    public function deleteData($id)
    {
        // $id fetch Id from user table
        $builder = $this->db->table($this->table)
            ->where('emp_shift_id', $id)
            ->delete();
    }
}
