<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
use App\Models\LeaveModel;


class LeaveControl extends BaseController
{
    public function __construct()
    {
        $this->model = new LeaveModel();
        helper(['form', 'url']);
    }

    //default function
    public function index()
    {
        // view menu
        // echo view('templates/header');

        // display data to array
        $data['leaves'] = $this->model->getData();
        // print_r($data['leaves']);exit;

        // pass display value to view
        return view('leaves/leave_view', $data);
    }

    public function create()
    {
        // get department data to dropdown
        $data['departs'] = $this->model->get_department();

        // pass department value to view
        return view('leaves/leave-create-view', $data);
    }

    // get employee name base on department id in department table
    public function get_employee_name()
    {
        // get the value of department id
        $deptid = $this->request->getPostGet('dept_id');
        // print_r($deptid);
        // get employee name by id
        $data = $this->model->get_emp_name($deptid);
        // print_r($data);
        echo json_encode($data);
    }

    // export to csv data
    public function export()
    {
        $file_name = 'Leave_details_' . date('d-m-Y') . '.csv';
        // print_r($file_name);exit;
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");


        // get data 
        $data = $this->model->getcsvData();
        // print_r($data['exportData']);exit;

        // file creation 
        $file = fopen('php://output', 'w');


        // $header = array("Department id","Department name", "description","status");
        // print_r($header);exit;
        // fputcsv($file, $header);
        foreach ($data as $value) {
            $csv = fputcsv($file, $value);
        }
        // $csv->move(WRITEPATH.'uploads');
        fclose($file);
        exit;
    }

    // add or update data
    public function createOrUpdate()
    {
        // update data based on id
        $id = $this->request->getVar('leave_id');
        $data = [
            'dept_id' => $this->request->getVar('dept_id'),
            'employee_id' => $this->request->getVar('employee_id'),
            'leave_type' => $this->request->getVar('leave_type'),
            'reason' => $this->request->getVar('reason'),
            'from_date' => $this->request->getVar('from_date'),
            'to_date' => $this->request->getVar('to_date'),
            'status' => $this->request->getVar('status')
        ];
        $message = "Record Updated Successfully";

        if (empty($id)) {
            if ($this->model->insertData($data) === false) {
                return view('leaves/leave-create-view', ['errors' => $this->model->errors()]);
            } else {
                return redirect()->route('Leaves/create')
                    ->with('msg', $message);
            }
        } else {
            $this->model->updateData($data, $id);
            return redirect()->route('Leaves')
                ->with('msg', $message);
        }
    }

    // // insert data
    // public function store()
    // {
    //     // assign data
    //     $data = [
    //         'dept_id' => $this->request->getVar('dept_id'),
    //         'employee_id' => $this->request->getVar('employee_id'),
    //         'leave_type' => $this->request->getVar('leave_type'),
    //         'reason' => $this->request->getVar('reason'),
    //         'from_date' => $this->request->getVar('from_date'),
    //         'to_date' => $this->request->getVar('to_date'),
    //         'status' => $this->request->getVar('status')
    //     ];

    //     // get validation error before save
    //     if ($this->model->insertData($data) === false) {
    //         return view('leaves/leave-create-view', ['errors' => $this->model->errors()]);
    //     } else {
    //         $message = "Record Updated Successfully";
    //         return redirect()->to(base_url('LeaveControl/create'))
    //             ->with('msg', $message);
    //     }
    // }

    // // cancel data
    // public function cancel()
    // {
    //     return redirect()->to(base_url('LeaveControl'));
    // }

    public function edit($id = null)
    {
        $data['departs'] = $this->model->get_department();
        $data['leaves'] = $this->model->getdataid($id);
        return view('leaves/leave-edit-view', $data);
    }

    // public function update()
    // {
    //     // update data based on id
    //     $id = $this->request->getVar('leave_id');

    //     $data = [
    //         'dept_id' => $this->request->getVar('dept_id'),
    //         'employee_id' => $this->request->getVar('employee_id'),
    //         'leave_type' => $this->request->getVar('leave_type'),
    //         'reason' => $this->request->getVar('reason'),
    //         'from_date' => $this->request->getVar('from_date'),
    //         'to_date' => $this->request->getVar('to_date'),
    //         'status' => $this->request->getVar('status')
    //     ];

    //     $this->model->updateData($data, $id);
    //     $message = "Record Updated Successfully";
    //     return redirect()->to(base_url('LeaveControl'))
    //         ->with('msg', $message);
    // }

    public function delete($id = null)
    {
        $this->model->deleteData($id);
        $message = "Record Deleted Successfully";
        return redirect()->route('Leaves')
            ->with('msg', $message);
    }
}
