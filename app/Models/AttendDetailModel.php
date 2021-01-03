<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendDetailModel extends Model
{
    // get attendance details data
    public function AttendDetails($empId1, $empId2, $login_time1, $login_time2)
    {
        // will check whole row in database

        // $sql = "SELECT * FROM attend_tbl WHERE employee_id = ? AND login_date = ? AND logout_time IS NOT NULL";
        // $query = $this->db->query($sql, array($id, $login_date));
        // return $query->getResult();

        $sql = "SELECT `login_time`, `logout_time`,`shift_duration`,`late_time`,`over_time`,`working_time`,`status` 
        FROM attend_tbl WHERE employee_id = ? 
        UNION 
        SELECT `login_time`, `logout_time`,`shift_duration`,`late_time`,`over_time`,`working_time`,`status` 
        FROM absent_tbl WHERE `employee_id`= ? 
        and date(login_time) BETWEEN ? and ? 
        and date(login_time) not in (select date(`login_time`) from attend_tbl) 
        ORDER by login_time";
        $query = $this->db->query($sql, array($empId1, $empId2, $login_time1, $login_time2));
        return $query->getResultArray();
    }

    public function get_data_by_empid($empId = null){
        $sql = "SELECT employee_tbl.employee_id, employee_tbl.name, 
        department_tbl.department_name 
        FROM employee_tbl inner JOIN department_tbl 
        on employee_tbl.dept_id = department_tbl.dept_id 
        WHERE employee_tbl.employee_id=?";
        $query = $this->db->query($sql, array($empId));
        return $query->getResultArray();
    }

    public function DetailsReport($empId, $login_start_date, $login_end_date)
    {
        // 
        $sql = "SELECT `login_time`, `logout_time`,`shift_duration`,`late_time`,
        `over_time`,`working_time`,`status` FROM attendance_tbl WHERE employee_id = ? AND
        `login_date` BETWEEN ? AND ?";
        $query = $this->db->query($sql, array($empId, $login_start_date, $login_end_date));
        return $query->getResultArray();



        // $sql = "SELECT * FROM attend_tbl WHERE employee_id = ? AND login_date = ? AND logout_time IS NOT NULL";
        // $query = $this->db->query($sql, array($id, $login_date));
        // return $query->getResultArray();
    }
}
