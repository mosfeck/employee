<?php
namespace App\Models;

use CodeIgniter\Model;

class AttendModel extends Model {
    protected $table = 'attendance_tbl';
    protected $primaryKey = 'emp_auto_id';
    protected $allowedFields = [
        'employee_id','name','dept_id','desg_id','shift_id','emp_shift_id',
        'roster_id','roster_date','leave_id','leave_from_date','leave_to_date',
        'login_date','login_time','schedule_login_start',
        'schedule_login_end','schedule_login_grace','late_time','schedule_logout',
        'logout_time','early_logout','over_time','working_time' ,'status'
    ];
    
    // public function getEmployee($data){
    //     $query = $this->db->table($this->table)->getWhere($data);
    //     return $query->getResult();
    // }

    // check whole row in database
    public function login_checker($data)
    {
        // will check whole row in database
        $query = $this->db->table('employee_tbl')->getWhere($data); 
        return $query->getResult();
    }

    // check if login id and date in database
    public function login_id_checker($data)
    {
        // will check whole row in database
        $query = $this->db->table('attendance_tbl')->getWhere($data); 
        return $query->getResult();
    }

    // check if login id and date in database
    public function logout_id_checker($id = null, $login_date = null)
    {
        // will check whole row in database
        // $query = $this->db->table('attendance_tbl')->getWhere($data); 
        // return $query->getResult();

        $sql = "SELECT * FROM attendance_tbl WHERE employee_id = ? AND login_date = ? AND logout_time IS NOT NULL";
        $query = $this->db->query($sql, array($id, $login_date));
        return $query->getResult();
    }

    // display general data by id
    public function getData($id = null, $login_date = null)
    {
        $sql = "SELECT `employee_tbl`.`employee_id`, `attendance_tbl`.`emp_auto_id`,
        `attendance_tbl`.`status`,
        `employee_tbl`.`name`, `employee_tbl`.`dept_id`, 
        `employee_tbl`.`desg_id`, `shift_tbl`.`shift_id`, 
        `emp_shift_tbl`.`emp_shift_id`, `roster_tbl`.`roster_id`,
        `roster_tbl`.`roster_date`, `leave_tbl`.`leave_id`,
        `leave_tbl`.`from_date` as `leave_from_date`, 
        `leave_tbl`.`to_date` as `leave_to_date`, 
        `shift_tbl`.`login_start` as `schedule_login_start`,
        `shift_tbl`.`login_end` as `schedule_login_end`, 
        `shift_tbl`.`login_grace` as `schedule_login_grace`,
        `shift_tbl`.`logout` as `schedule_logout` FROM `employee_tbl`,
        `shift_tbl`, `emp_shift_tbl`, `roster_tbl`, `leave_tbl`, `attendance_tbl`
        WHERE `employee_tbl`.`employee_id` = `emp_shift_tbl`.`employee_id` 
        AND `employee_tbl`.`employee_id` = `attendance_tbl`.`employee_id`
        AND `emp_shift_tbl`.`shift_id` = `shift_tbl`.`shift_id` 
        AND `employee_tbl`.`employee_id` = `roster_tbl`.`employee_id` 
        AND `employee_tbl`.`employee_id` = `leave_tbl`.`employee_id` 
        AND `employee_tbl`.`employee_id` = ?
        AND `attendance_tbl`.`login_date`= ?";
        $query = $this->db->query($sql, array($id, $login_date));
        // print_r($query->getResultArray());
        return $query->getRow();   
    }

    // display data by id and date
    public function getdataIdDate($id = null, $login_date = null)
    {
        $sql = "SELECT * FROM attendance_tbl WHERE employee_id = ? AND login_date = ?";
        $query = $this->db->query($sql, array($id, $login_date));
        return $query->getRow();


        // another way not working
        // $query = $this->db->table('attendance_tbl')->getWhere($data);
        // return $query->getRow();
        // $query = $this->db->table('attendance_tbl')->where('employee_id',$id)->get();
        //        return $query->getResultArray();

        // return $this->asArray()
        //     ->where(['employee_id' => $id, 'login_date' => $login_date])
        //     ->first();
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
                ->where('emp_auto_id', $id)
                ->update($data);
    }
}