<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class CoreControl extends Controller
{
    public function __construct()
    {
        // parent::__construct();
    }
}
class AdminControl extends CoreControl
{

    public function __construct()
    {
        // $this->model = new DepartModel();

        //        $DepartModel = new DepartModel();
        // helper(['form', 'url']);
    }

    public function render_template($page = null, $data = array())
	{
        
        // $sess_id = $_SESSION['uname'];
        // print_r($sess_id);
        // if (!empty($sess_id)) {
        // $userId['uname'] = $sess_id;
        echo view('templates/header');
        echo view($page, $data);
        // }
    }

    public function index()
    {
        // echo view('templates/header');
        //        $data['departs'] = $this->model->orderBy('dept_id', 'DESC')->findAll();
        // $data['departs'] = $this->model->getData();
        //        print_r($data['departs']);exit;
        // return view('departments/depart_view', $data);
    }
}
