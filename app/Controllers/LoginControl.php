<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
use App\Models\LoginModel;
use App\Models\EmployeeModel;


class LoginControl extends BaseController
{
    // protected $validation;
    // protected $session;
    // protected $view;
    // var $id = "";

    public function __construct()
    {
        $this->model = new LoginModel();
        $this->empmodel = new EmployeeModel();
        helper(['form', 'url']);
        // $this->view = \Config\Services::renderer();
    }

    public function index()
    {
        // echo view('templates/header');
        return view('dashboard/signin_view');
    }

    

    public function auth_employee()
    {
        // get form input
        $data['employee_id'] = $this->request->getPost("employee_id");
        $data['password'] = md5($this->request->getPost("password"));

        //    $this->validation->setRules([
        //             'employee_id' => 'required',
        //             'password' => 'required|min_length[6]'
        //         ]);

        $val = $this->validate([
            'employee_id' => 'required',
            'password' => 'required|min_length[6]'
        ]);

        // form validation

        // if ($this->validation->run($data) == FALSE)
        if (!$val) {
            // validation fail
            return redirect()->route('login')->withInput()->with('validation', $this->validator);
        } else {
            // check for user credentials
            $EmpResult = $this->model->getEmployee($data);

            if (count($EmpResult) > 0) {
                // set session
                $sess_data = array('isLoggedIn' => TRUE, 'uname' => $EmpResult[0]->first_name, 'uid' => $EmpResult[0]->employee_id);
                // print_r($sess_data);
                $this->session->set($sess_data);

                $sess_id['uid'] = $_SESSION['uid'];
                $sess_id['uname'] = $_SESSION['uname'];
                // print_r($sess_id['uname']);
                
                    return redirect()->to( site_url('LoginControl/getUser') );
                    
                // }
            } else {
                $this->session->setFlashdata('msg', '<div class="alert alert-danger text-center">Wrong Employee ID or Password!</div>');
                return view('dashboard/signin_view.php');
            }
        }
    }

    public function getSessionId()
    {
        // echo view('templates/header');
        return view('templates/header');
    }

    public function render_template($page = null, $data = array())
	{
        
        $sess_id = $_SESSION['uname'];
        // print_r($sess_id);
        if (!empty($sess_id)) {
        $userId['uname'] = $sess_id;
        // return view('templates/header', $userId);
        // return view('layouts/layout', $userId);
        echo view($page, $data);
        }
	}

    public function getUser()
    {
        
        $data['employees'] = $this->empmodel->get_employee();
        $sess_id = $_SESSION['uname'];
        // print_r($sess_id);
        if (!empty($sess_id)) {
            $userId['uname'] = $sess_id;

            
            // echo $this->view->render('templates/header');
            return view('layouts/layout', $userId);
            $this->render_template('employees/employee_view', $data);
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger text-center">Session Expired !</div>');
            //load the login page
            return view('dashboard/signin.php');
        }
    }

    public function signout()
    {
        $session_items = array('uname', 'uid');
        $this->session->remove($session_items);
        session()->destroy();
        $this->session->setFlashdata('msg', '<div class="alert alert-success text-center">Logout Successfully !</div>');
        // $this->session->stop();
        return view('dashboard/signin_view');
    }

    
}
