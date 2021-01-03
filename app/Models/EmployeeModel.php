<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{

    protected $table = 'employee_tbl';
    protected $primaryKey = 'employee_id';
    protected $allowedFields = [
        'first_name', 'last_name', 'password',
        'mobile', 'email', 'address', 'gender', 'photo', 'dept_id', 'desg_id', 'role_id', 'status'
    ];

    protected $validationRules    = [
        'first_name'     => 'required',
        'last_name'     => 'required',
        'password'     => 'required|min_length[8]',
        'mobile'     => 'required',
        'email'     => 'required|valid_email|is_unique[employee_tbl.email]',
        'address'     => 'required',
        'gender'     => 'required',
        'dept_id'     => 'required',
        'desg_id'     => 'required',
        'role_id'     => 'required',
        'status'     => 'required'
    ];

    protected $validationMessages = [
        'first_name'        => ['required' => 'Designation Name must enter'],
        'last_name'        => ['required' => 'last name must enter'],
        'password'        => [
            'required' => 'password must enter',
            'min_length' => 'password must be more than 8 character'
        ],
        'mobile'        => ['required' => 'mobile must enter'],
        'email'        => [
            'required' => 'email must enter',
            'valid_email' => 'Please enter a valid email',
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.'
        ],
        'address'        => ['required' => 'address must enter'],
        'gender'        => ['required' => 'gender must enter'],
        'dept_id'        => ['required' => 'dept_id must enter'],
        'desg_id'        => ['required' => 'desg_id must enter'],
        'role_id'        => ['required' => 'role_id must enter'],
        'status'        => ['required' => 'status must enter']
    ];

    // get data by id
    public function getdataid($id = null)
    {
        return $this->asArray()
            ->where(['employee_id' => $id])
            ->first();
    }

    function get_employee()
    {
        $query = $this->db->query('SELECT e.employee_id, e.name, e.mobile, 
            e.address, e.gender, e.photo, dept.department_name, 
            desg.designation_name, r.role_name, e.status FROM 
            employee_tbl e, department_tbl dept, designation_tbl desg, 
            user_role_tbl r where e.dept_id=dept.dept_id and 
            e.desg_id = desg.desg_id and e.role_id=r.role_id order by 
            employee_id desc');
        return $query->getResultArray();
    }

    function getcsvData()
    {
        $query = $this->db->query('SELECT * FROM employee_tbl order by 
            employee_id');
        return $query->getResultArray();
    }

    // function get_employee_id($id = null)
    // {
    //     $query = $this->db->query('SELECT e.dept_id, e.desg_id, e.role_id, dept.department_name, desg.designation_name, r.role_name FROM employee_tbl e, department_tbl dept, designation_tbl desg, user_role_tbl r where e.dept_id=dept.dept_id and e.desg_id = desg.desg_id and e.role_id=r.role_id and employee_id=' . $id);
    //     return $query->getResultArray();

    // }

    function get_department()
    {
        $query = $this->db->query('SELECT dept_id, department_name FROM 
            department_tbl order by department_name');
        return $query->getResultArray();
    }

    function get_designation()
    {
        $query = $this->db->query('SELECT desg_id, designation_name FROM 
            designation_tbl order by designation_name');
        return $query->getResultArray();
    }

    function get_role()
    {
        $query = $this->db->query('SELECT role_id, role_name FROM user_role_tbl 
            order by role_name');
        return $query->getResultArray();
    }

    function get_department_id($id = null)
    {

        $query = $this->db->query('SELECT d.department_name FROM employee_tbl e, 
            department_tbl d where e.dept_id=d.dept_id');
        return $query->getResultArray();
    }

    //    function problem_type_all($id = 0) {
    //        $tmpResult = array();
    //        if ($id > 0) {
    //            $results = $this->db->select(array('id', 'designation_name'))
    //                    ->where('id', $id)
    //                    ->get('designation_tbl')
    //                    ->result();
    //        } else {
    //            $results = $this->db->select(array('id', 'designation_name'))
    //                    ->order_by('designation_name', 'ASC')
    //                    ->get('designation_tbl')
    //                    ->result();
    //        }
    //        foreach ($results as $result) {
    //            $tmpResult[$result->id] = $result->designation_name;
    //        }
    //
    //        return $tmpResult;
    //    }
    function get_department2()
    {

        $query = $this->db->query('SELECT dept_id, department_name FROM 
            department_tbl GROUP BY department_name order by department_name');
        //        return $query->getResultArray(); 

        foreach ($query->getResult() as $row) {
            //this sets the key to equal the value so that
            //the pulldown array lists the same for each
            $array[$row->dept_id] = $row->department_name;
        }
        return $array;
    }

    function get_designation2()
    {

        $query = $this->db->query('SELECT desg_id, designation_name FROM 
            designation_tbl GROUP BY designation_name order by designation_name');
        //        return $query->getResultArray(); 

        foreach ($query->getResult() as $row) {
            //this sets the key to equal the value so that
            //the pulldown array lists the same for each
            $array[$row->desg_id] = $row->designation_name;
        }
        return $array;
    }

    function get_role2()
    {

        $query = $this->db->query('SELECT role_id, role_name FROM user_role_tbl
             GROUP BY role_name order by role_name');
        //        return $query->getResultArray();
        foreach ($query->getResult() as $row) {
            //this sets the key to equal the value so that
            //the pulldown array lists the same for each
            $array[$row->role_id] = $row->role_name;
        }
        return $array;
    }

    public function insertData($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        //  $message = "Record Successfully Updated";
        //  echo view('employees/employee-create-view_1', ['Insert' => $message]);
    }

    public function updateData($data, $id)
    {

        $employee = $this->db->table($this->table)
            ->where('employee_id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        // $id fetch Id from user table
        $builder = $this->db->table($this->table)
            ->where('employee_id', $id)
            ->delete();
    }
}
