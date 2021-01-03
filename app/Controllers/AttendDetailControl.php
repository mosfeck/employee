<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
// use App\Models\DepartModel;
use App\Models\AttendDetailModel;

class AttendDetailControl extends BaseController
{

    public function __construct()
    {
        $this->model = new AttendDetailModel();
    }

    public function index()
    {
        // $this->get_empdata_by_id();
        // $data['departs'] = $this->model->orderBy('dept_id', 'DESC')->findAll();
        $empId = $_SESSION['uid'];
        // print_r($empId);exit;
        $data['empData'] = $this->model->get_data_by_empid($empId);
        // print_r($data['empData']);exit;
        return view('attendReport/attendDetailReport', $data);
        
        // checking data
        // $this->AttendDetailsReport();
        
    }

    public function get_empdata_by_id()
    {
        $empId = $_SESSION['uid'];
        // print_r($empId);exit;
        $data['empData'] = $this->model->get_data_by_empid($empId);
        // print_r($data['empData']);exit;
        return view('attendReport/attendDetailReport', $data);
    }


    public function AttendDetailsReport()
    {
        // $empId1 = $_SESSION['uid'];
        // $empId2 = $_SESSION['uid'];
        // $login_time1 = $this->request->getPostGet('startDate');
        // $login_time2= $this->request->getPostGet('endDate');

        // $empId1 = 15074;
        // $empId2 = 15074;
        // $login_time1 = '2020-10-03';
        // $login_time2= '2020-10-12';

        $empId = $_SESSION['uid'];
        // $login_start_date = '2020-10-03';
        // $login_end_date = '2020-10-20';
        $login_start_date = $this->request->getPostGet('startDate');
        $login_end_date = $this->request->getPostGet('endDate');

        $data['AttendDetails'] = $this->model->DetailsReport($empId, $login_start_date, $login_end_date);
        // print_r($data['AttendDetails']);exit;
        return view('attendReport/DetailReport', $data);
    }
}
