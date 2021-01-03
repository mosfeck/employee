<?php

namespace App\Models;

use CodeIgniter\Model;

class LeaveModel extends Model
{
    protected $table = 'leave_tbl';
    protected $primaryKey = 'leave_id';
    protected $allowedFields = ['dept_id','employee_id','leave_type','reason',
                                'from_date','to_date','status'];

    // protected $validationRules    = [
    //     'dept_id'     => 'required',
    //     'employee_id'     => 'required',
    //     'leave_type'     => 'required',
    //     'reason'     => 'required',
    //     'from_date'     => 'required',
    //     'to_date'     => 'required',
    //     'status'     => 'required'
    // ];

    // protected $validationMessages = [
    //     'dept_id'        => ['required' => 'Department name must enter'],
    //     'employee_id'        => ['required' => 'Employee name must enter'],
    //     'leave_type'        => ['required' => 'Leave type must enter'],
    //     'reason'        => ['required' => 'reason must enter'],
    //     'from_date'        => ['required' => 'From date must enter'],
    //     'to_date'        => ['required' => 'To date must enter'],
    //     'status'        => ['required' => 'status must enter']
    // ];   
    
    // display general data
    public function getData()
    {
        $query = $this->db->query('SELECT l.leave_id, d.department_name,
                                 e.name, l.leave_type, l.reason, l.from_date, 
                                 l.to_date, l.status FROM leave_tbl l, 
                                 department_tbl d, employee_tbl e where 
                                 l.dept_id = d.dept_id and 
                                 e.employee_id = l.employee_id 
                                 order by leave_id desc');
        return $query->getResultArray();

        // $message="Record Fetched Successfully";
        // return redirect()->to(base_url('LeaveControl'))
        //                 ->with('msg',$message);
    }
    
    // get data by id
    public function getdataid($id = null)
    {
        return $this->asArray()
                    ->where(['leave_id' => $id])
                    ->first();
    }

    // get csv data
    public function getcsvData()
    {
        $query = $this->db->query('SELECT * from leave_tbl order by leave_id');
        return $query->getResultArray();
    }
    
    // get department dropdown
    public function get_department()
    {
        $query = $this->db->query('SELECT dept_id, department_name 
                                from department_tbl  GROUP BY department_name
                                 order by department_name');
        foreach($query->getResult() as $row)
        {
            //this sets the key to equal the value so that
            //the pulldown array lists the same for each
            $array[$row->dept_id] = $row->department_name;
        }
        return $array;;
    }

    public function get_emp_name($dept_id = null){
        $sql = 'SELECT employee_tbl.employee_id, 
                employee_tbl.name FROM employee_tbl 
                inner JOIN department_tbl on 
                employee_tbl.dept_id = department_tbl.dept_id 
                WHERE employee_tbl.status="Yes" and 
                department_tbl.dept_id=?';
        $query = $this->db->query($sql, array($dept_id));
        return $query->getResultArray();
    }

    // insert data
    public function insertData($data)
    {
        $this->db->table($this->table)
                ->insert($data);
    }

    // update data
    public function updateData($data, $id)
    {
        $this->db->table($this->table)
                ->where('leave_id', $id)
                ->update($data);
    }

    // Delete data
    public function deleteData( $id)
    {
        $this->db->table($this->table)
                    ->where('leave_id',$id)
                    ->delete();
    }
}