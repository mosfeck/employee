<?php

namespace App\Models;


use CodeIgniter\Model;

class RosterModel extends Model
{
    protected $table = 'roster_tbl';
    protected $primaryKey = 'roster_id';
    protected $allowedFields = ['dept_id', 'employee_id', 'shift_id', 
                        'roster_date','status'];

    protected $validationRules    = [
        'dept_id'     => 'required',
        'employee_id'     => 'required',
        'shift_id'     => 'required',
        'roster_date'     => 'required',
        'status'     => 'required'
    ];

    protected $validationMessages = [
        'dept_id'        => ['required' => 'Department name name must enter'],
        'employee_id'        => ['required' => 'Employee name must enter'],
        'shift_id'        => ['required' => 'Shift name must enter'],
        'roster_date'        => ['required' => 'roster date must enter'],
        'status'        => ['required' => 'status must enter']
    ];

    public function getdataid($id = null)
    {
        return $this->asArray()
            ->where(['roster_id' => $id])
            ->first();
    }

    public function getData()
    {
        //    display data
        $query = $this->db->query('SELECT r.roster_id, d.department_name, 
                        e.name, s.shift_name, r.roster_date, r.status 
                        FROM roster_tbl r, employee_tbl e, department_tbl d, 
                        shift_tbl s where r.shift_id = s.shift_id and 
                        r.dept_id = d.dept_id and e.employee_id = r.employee_id 
                        order by roster_id desc');
        return $query->getResultArray();
    }

    // csv data
    public function getcsvData(){
        $query = $this->db->query('SELECT * FROM roster_tbl order by roster_id');
        return $query->getResultArray();
    }

    // department dropdown
    public function get_department(){
        $query = $this->db->query('SELECT department_name, 
                            dept_id FROM department_tbl GROUP BY department_name 
                            order by department_name');
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
        $query = $this->db->query('SELECT shift_name, 
                                    shift_id FROM shift_tbl  GROUP BY shift_name 
                                    order by shift_name');
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
                employee_tbl.name FROM employee_tbl 
                inner JOIN department_tbl on 
                employee_tbl.dept_id = department_tbl.dept_id 
                WHERE employee_tbl.status="Yes" and 
                department_tbl.dept_id=?';
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
                    ->where('roster_id', $id)
                    ->update($data);
        }

    public function deleteData($id)
    {
        // $id fetch Id from user table
        $builder = $this->db->table($this->table)
            ->where('roster_id', $id)
            ->delete();
    }
}
