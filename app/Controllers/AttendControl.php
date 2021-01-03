<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
use App\Models\AttendModel;
use CodeIgniter\I18n\Time;


class AttendControl extends BaseController
{
    protected $validation;
    protected $session;
    // var $id = "";


    public function __construct()
    {
        $this->model = new AttendModel();
        helper(['form', 'url', 'date']);
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        // echo view('templates/header');
        // $this->calDate();
        return view('attendance/attend_view');
    }

    public function loginForm()
    {
        // $myTime = new Time('now', 'BST', 'bn_BD');
        // $myTime->toDateString();
        // print_r($myTime);

        return view('attendance/attend_view_login');
    }

    public function logoutForm()
    {
        // $currDt = now('Asia/Dhaka');
        // $myTime = Time::now('Asia/Dhaka', 'en_US');
        // print_r($myTime);

        // $time = Time::createFromTimestamp($currDt, 'Asia/Dhaka', 'en_US');
        // print_r($time);
        //  echo date('Y-m-d', strtotime($time));

        // $this->get_data_by_id_date();
        return view('attendance/attend_view_logout');
    }



    // // login form
    // public function auth_employee()
    // {
    //     // get form input
    //     $loginData['employee_id'] = $this->request->getPost("empId");
    //     $loginData['password'] = md5($this->request->getPost("password"));

    //     // validate input field
    //     $val = $this->validate([
    //         'employee_id' => 'required',
    //         'password' => 'required|min_length[6]'
    //     ]);

    //     // form validation
    //     if (!$val) {
    //         // if validation fail
    //         $listErrors  =  \Config\Services::validation()->listErrors();
    //         echo view('attendance/attend_view_login',  ['validation' => $listErrors]);
    //     } else {
    //         // check for user credentials
    //         $EmpResult = $this->model->login_checker($loginData);

    //         // if the result found
    //         if (count($EmpResult) > 0) {
    //             // set session
    //             $sess_data = array('logged_in' => TRUE, 'uname' => $EmpResult[0]->first_name, 'uid' => $EmpResult[0]->employee_id);
    //             // print_r($sess_data);

    //             $this->session->set($sess_data);
    //             // $sess_id['uname'] = $_SESSION['uname'];

    //             $sess_id['uid'] = $_SESSION['uid'];


    //             return redirect()->to(base_url('AttendControl/getUser'))->with('user', $sess_id['uid']);
    //         } else {
    //             $this->session->setFlashdata('msg', '<div class="alert alert-danger text-center">Wrong Employee ID or Password!</div>');
    //             return view('attendance/attend_view_login');
    //         }
    //     }
    // }


    // get data by id with authentication
    public function get_data_by_id($empid = null)
    {
        // $empid = $this->request->getPost('employee_id');
        // print_r($empid);
        // $data['attends'] = $this->model->getData($empid);
        $login_date = date("Y-m-d");
        $data = $this->model->getData($empid, $login_date);
        // print_r($data['attends']);
        echo json_encode($data);
        // return view('attendance/attend_view', $data);

    }

    // get data by id and date with authentication
    public function get_data_by_id_date($empid = null)
    {
        // $empid = $this->request->getPost('empId');
        // $login_date = $this->request->getPostGet('login_date');

        // check data if already login
        // $loginidData = [
        //     'employee_id' => $this->request->getVar('empId'),
        //     'login_date' => $this->request->getVar('login_date'),
        // ];

        // $empid = '15074';
        // $login_date = "2020-09-12";
        // $login_date = $this->request->getVar('login_date');
        $login_date = date("Y-m-d");
        // print_r($login_date);
        $data = $this->model->getdataIdDate($empid, $login_date);
        echo json_encode($data);
        // print_r($data);

    }


    // // get session id
    // public function getUser()
    // {
    //     $sess_id = $_SESSION['uid'];
    //     // print_r($sess_id);

    //     if (!empty($sess_id)) {
    //         $data['attends'] = $this->model->getData($sess_id);
    //         // print_r($data['attends']);exit;
    //         return view('attendance/attend_edit_view', $data);
    //         echo json_encode($data);

    //         $this->session->setFlashdata('msg', '<div class="alert alert-success text-center">Display data Successfully!</div>');
    //     } else {
    //         $this->session->setFlashdata('msg', '<div class="alert alert-danger text-center">Session Expired!</div>');
    //         //load the login page
    //         return view('attendance/attend_view');
    //     }
    // }

    // // session out
    // public function signout()
    // {
    //     $session_items = array('uname', 'uid');
    //     $this->session->remove($session_items);
    //     $this->session->setFlashdata('msg', '<div class="alert alert-success text-center">Logout Successfully!</div>');
    //     $this->session->stop();
    //     return view('attendance/attend_view');
    // }

    // public function calDate()
    // {
    //     $previous_date = $this->request->getPost('schedule_login_start');
    //     var_dump($previous_date);
    //     // time() actually prints 2009-07-04
    //     $diff = time() - strtotime($previous_date);
    //     // echo floor(($diff / (60 * 60 * 24)));
    //     // echo date('H:i', strtotime($diff));
    // }

    public function store()
    {
        // get form input
        $loginData['employee_id'] = $this->request->getPost("empId");
        $loginData['password'] = md5($this->request->getPost("password"));

        // check data if already login
        $loginidData = [
            'employee_id' => $this->request->getVar('employee_id'),
            'login_date' => $this->request->getVar('login_date'),
        ];

        $empid = $this->request->getPost("empId");

        // check data if already logout
        $logoutidData = [
            'emp_auto_id' => $this->request->getVar('emp_auto_id'),
            'login_date' => $this->request->getVar('login_date'),
        ];

        // validate input field
        $val = $this->validate([
            'employee_id' => 'required',
            'password' => 'required|min_length[6]'
        ]);



        // $id = $this->request->getPost('emp_auto_id');
        $id = $this->request->getVar('emp_auto_id');
        $empName = $this->request->getVar('name');
        $employee_id = $this->request->getVar('employee_id');

        $login_time = $this->request->getVar('login_time');
        $schedule_login_end = $this->request->getVar('schedule_login_end');
        $working_time =  $this->request->getVar('working_time');
        $login_date = date("Y-m-d");

        $data = [
            'employee_id' => $this->request->getVar('employee_id'),
            'name' => $this->request->getVar('name'),
            'dept_id' => $this->request->getVar('dept_id'),
            'desg_id' => $this->request->getVar('desg_id'),
            'shift_id' => $this->request->getVar('shift_id'),
            'emp_shift_id' => $this->request->getVar('emp_shift_id'),
            'roster_id' => $this->request->getVar('roster_id'),
            'roster_date' => $this->request->getVar('roster_date'),
            'leave_id' => $this->request->getVar('leave_id'),
            'leave_from_date' => $this->request->getVar('leave_from_date'),
            'leave_to_date' => $this->request->getVar('leave_to_date'),
            'login_date' => $this->request->getVar('login_date'),
            'login_time' => $this->request->getVar('login_time'),
            'schedule_login_start' => $this->request->getVar('schedule_login_start'),
            'schedule_login_end' => $this->request->getVar('schedule_login_end'),
            'schedule_login_grace' => $this->request->getVar('schedule_login_grace'),
            'late_time' => $this->request->getVar('late_time'),
            'schedule_logout' => $this->request->getVar('schedule_logout'),
            'logout_time' => $this->request->getVar('logout_time'),
            'early_logout' => $this->request->getVar('early_logout'),
            'over_time' => $this->request->getVar('over_time'),
            'working_time' => $this->request->getVar('working_time'),
            'status' => $this->request->getVar('status'),
        ];

        $message = $empName . " is login Successfully!";

        // form validation
        if (!$val) {
            // if validation fail
            return redirect()->route('Attends/login')->withInput()->with('validation', $this->validator);
        } else {
            // check for user credentials
            $EmpResult = $this->model->login_checker($loginData);

            // check data if already login
            // $AttendResult = $this->model->login_id_checker($loginidData);

            // check data if data found from id
            $empGetResult = $this->model->getData($empid);
            // check if login ok
            if (count($EmpResult) > 0) {
                // save data
                
                // if the data found
                if (empty($employee_id)) {
                    $message = "Invalid Employee id";
                    return redirect()->route('Attends/login')->with('Insert', $message);
                }
                // check if already login
                // elseif (count($AttendResult) > 0) {
                //     $message = "You are already login";
                //     return redirect()->route('Attends/login')->with('Insert', $message);
                // } 
                
                // validation for login time over
                // elseif ($login_time > $schedule_login_end) {
                //     $message = "Your login time is over";
                //     return redirect()->route('Attends/login')->with('Insert', $message);
                // } 
                else {
                    // if the data found on empid
                    // if (count($empGetResult) > 0) {
                    // $save = $this->model->insertData($data);
                    $save = $this->model->updateData($data, $id);
                    return redirect()->route('Attends/login')->with('msg', $message);
                    // }else{
                    //     $message = "Invalid Employee id";
                    // return redirect()->route('Attends/login')->with('Insert', $message);
                    // }
                }
            } else {
                // $this->session->setFlashdata('warnMsg', '<div class="alert alert-danger text-center">Wrong Employee ID or Password!</div>');
                $message = "Wrong Employee ID or Password!";
                return redirect()->route('Attends/login')->with('Insert', $message);
            }
        }
    }

    public function update()
    {
        // $id = $this->request->getPost('emp_auto_id');
        // $empName = $this->request->getVar('name');
        // $data = [
        //     // 'employee_id' => $this->request->getVar('employee_id'),
        //     // 'name' => $this->request->getVar('name'),
        //     // 'dept_id' => $this->request->getVar('dept_id'),
        //     // 'desg_id' => $this->request->getVar('desg_id'),
        //     // 'shift_id' => $this->request->getVar('shift_id'),
        //     // 'emp_shift_id' => $this->request->getVar('emp_shift_id'),
        //     // 'roster_id' => $this->request->getVar('roster_id'),
        //     // 'roster_date' => $this->request->getVar('roster_date'),
        //     // 'leave_id' => $this->request->getVar('leave_id'),
        //     // 'leave_from_date' => $this->request->getVar('leave_from_date'),
        //     // 'leave_to_date' => $this->request->getVar('leave_to_date'),
        //     // 'login_date' => $this->request->getVar('login_date'),
        //     // 'login_time' => $this->request->getVar('login_time'),
        //     // 'schedule_login_start' => $this->request->getVar('schedule_login_start'),
        //     // 'schedule_login_end' => $this->request->getVar('schedule_login_end'),
        //     // 'schedule_login_grace' => $this->request->getVar('schedule_login_grace'),
        //     // 'late_time' => $this->request->getVar('late_time'),
        //     // 'schedule_logout' => $this->request->getVar('schedule_logout'),
        //     'logout_time' => $this->request->getVar('logout_time'),
        //     'early_logout' => $this->request->getVar('early_logout'),
        //     'working_time' => $this->request->getVar('working_time'),
        // ];
        // // $id = '24';
        // $message = $empName . " has logout Successfully";
        // $save = $this->model->updateData($data, $id);
        // return redirect()->to(base_url('AttendControl/logoutForm'))->with('msg', $message);

        // get form input
        $loginData['employee_id'] = $this->request->getPost("empId");
        $loginData['password'] = md5($this->request->getPost("password"));

        // check data if already logout
        $logoutidData = [
            'emp_auto_id' => $this->request->getVar('emp_auto_id'),
            'login_date' => $this->request->getVar('login_date'),
        ];

        // get employee auto id
        $id = $this->request->getVar('emp_auto_id');
        $empName = $this->request->getVar('name');
        $employee_id = $this->request->getPost('employee_id');
        $login_date = date("Y-m-d");

        // validate input field
        $val = $this->validate([
            'employee_id' => 'required',
            'password' => 'required|min_length[6]'
        ]);

        $data = [
            'employee_id' => $this->request->getVar('employee_id'),
            'name' => $this->request->getVar('name'),
            'dept_id' => $this->request->getVar('dept_id'),
            'desg_id' => $this->request->getVar('desg_id'),
            'shift_id' => $this->request->getVar('shift_id'),
            'emp_shift_id' => $this->request->getVar('emp_shift_id'),
            'roster_id' => $this->request->getVar('roster_id'),
            'roster_date' => $this->request->getVar('roster_date'),
            'leave_id' => $this->request->getVar('leave_id'),
            'leave_from_date' => $this->request->getVar('leave_from_date'),
            'leave_to_date' => $this->request->getVar('leave_to_date'),
            'login_date' => $this->request->getVar('login_date'),
            'login_time' => $this->request->getVar('login_time'),
            'schedule_login_start' => $this->request->getVar('schedule_login_start'),
            'schedule_login_end' => $this->request->getVar('schedule_login_end'),
            'schedule_login_grace' => $this->request->getVar('schedule_login_grace'),
            'late_time' => $this->request->getVar('late_time'),
            'schedule_logout' => $this->request->getVar('schedule_logout'),
            'logout_time' => $this->request->getVar('logout_time'),
            'early_logout' => $this->request->getVar('early_logout'),
            'over_time' => $this->request->getVar('over_time'),
            'working_time' => $this->request->getVar('working_time'),
            'status' => $this->request->getVar('status'),
        ];

        $message = $empName . " is logout Successfully!";

        // form validation
        if (!$val) {
            // if validation fail
            return redirect()->route('Attends/logout')->withInput()->with('validation', $this->validator);
        } else {
            // check for user credentials
            $EmpResult = $this->model->login_checker($loginData);

            // check data if already logout
            $AttendLogout = $this->model->logout_id_checker($employee_id, $login_date);
            // print_r($AttendLogout);

            if (count($EmpResult) > 0) {
                if(empty($id)){
                    $message = "Invalid employee id";
                    return redirect()->route('Attends/logout')->with('Update', $message);
                }
                // check if user already logout
                // elseif (count($AttendLogout) > 0) {
                //     $message = "You are already logout";
                //     return redirect()->to(base_url('AttendControl/logoutForm'))->with('Update', $message);
                // } 
                else {
                    // $message = $empName . " is logout Successfully";
                    // update data
                    $save = $this->model->updateData($data, $id);
                    return redirect()->route('Attends/logout')->with('msg', $message);
                }
            } else {
                // $this->session->setFlashdata('warnMsg', '<div class="alert alert-danger text-center">Wrong Employee ID or Password!</div>');
                $message = "Wrong Employee ID or Password!";
                return redirect()->route('Attends/logout')->with('Update', $message);
            }
        }
    }
}
