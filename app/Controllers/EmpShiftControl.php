<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
use App\Models\EmpShiftModel;


class EmpShiftControl extends BaseController
{

    public function __construct()
    {
        $this->model = new EmpShiftModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        // echo view('templates/header');
        
        $data['empshifts'] = $this->model->getData();
        //print_r($data['offdays']);exit;
        return view('empshifts/empshift_view', $data);
    }

    public function create()
    {
         $data['departs'] = $this->model->get_department();
        // print_r($data['departs']);

         $data['shifts'] = $this->model->get_shift();
        // print_r($data['shifts']);

        // echo $deptid = $this->request->getVar('dept_id');
        // print_r($deptid);
        // echo $data = $this->model->get_emp_name($deptid);
        // print_r($data);

        // $this->get_employee_name();
        return view('empshifts/empshift-create-view', $data);
    }

    public function get_employee_name(){
        // $dept_id = $this->request->getGetPost('dept_id');
        // $dept_id = 7;
        // $data = [
        //     'dept_id' => $this->request->getVar('dept_id')
        // ];
        // $dept_id = $this->$_POST['dept_id'];
        // $dept_id = set_value('dept_id');

        // $data['departs'] = $this->model->get_department();

        // $dept_id = $this->input->post('dept_id');

        $dept_id = $this->request->getPostGet('dept_id');
        // $dept_id = 24;
        // print_r($dept_id);
        $data = $this->model->get_emp_name($dept_id);
        // print_r($data);
        echo json_encode($data);
        // return view('empshifts/empshift-create-view', $data);
    }

    public function export()
    { 
        $file_name = 'Employee_Shift_details_' . date('d-m-Y') . '.csv';
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

    // add or update
    public function createOrUpdate()
    {
        $id = $this->request->getVar('emp_shift_id');
        $data = [
            'dept_id' => $this->request->getVar('dept_id'),
            'employee_id' => $this->request->getVar('employee_id'),
            'shift_id' => $this->request->getVar('shift_id'),
            'from_date' => $this->request->getVar('from_date'),
            'to_date' => $this->request->getVar('to_date'),
            'status' => $this->request->getVar('status')
        ];

        $message = "Record Updated Successfully";

        if(empty($id))
        {
            if ($this->model->insertData($data) === false) {
                return view('empshifts/empshift-create-view', ['errors' => $this->model->errors()]);
            } else {
                return redirect()->route('EmpShifts/create')->with('msg', $message);
            }
        }
        else
        {
            $save = $this->model->updateData($data, $id);
            return redirect()->route('EmpShifts')->with('msg', $message);
        }
    }


    // public function store()
    // {
    //     $data = [
    //         'dept_id' => $this->request->getVar('dept_id'),
    //         'employee_id' => $this->request->getVar('employee_id'),
    //         'shift_id' => $this->request->getVar('shift_id'),
    //         'from_date' => $this->request->getVar('from_date'),
    //         'to_date' => $this->request->getVar('to_date'),
    //         'status' => $this->request->getVar('status')
    //     ];

    //     if ($this->model->insertData($data) === false) {
    //         return view('empshifts/empshift-create-view', ['errors' => $this->model->errors()]);
    //     } else {
    //         $message = "Record Updated Successfully";
    //         return redirect()->to( base_url('EmpShiftControl/create') )->with('msg', $message);
    //     }
    // }

    // public function cancel()
    // {
    //     return redirect()->to(base_url('EmpShiftControl'));
    // }

    public function edit($id = null)
    {
        $data['departs'] = $this->model->get_department();
        $data['shifts'] = $this->model->get_shift();
        $data['empshifts'] = $this->model->getdataid($id);
        return view('empshifts/empshift-edit-view', $data);
    }

    // public function update()
    // {
    //     $id = $this->request->getVar('emp_shift_id');

    //     $data = [
    //         'dept_id' => $this->request->getVar('dept_id'),
    //         'employee_id' => $this->request->getVar('employee_id'),
    //         'shift_id' => $this->request->getVar('shift_id'),
    //         'from_date' => $this->request->getVar('from_date'),
    //         'to_date' => $this->request->getVar('to_date'),
    //         'status' => $this->request->getVar('status')
    //     ];

    //     $save = $this->model->updateData($data, $id);
    //     $message = "Record Successfully Updated";
    //     return redirect()->to(base_url('EmpShiftControl'))->with('msg', $message);
    // }

    public function delete($id = null)
    {
        $data['empshifts'] = $this->model->deleteData($id);
        $message = "Record Deleted successfully";
        return redirect()->route('EmpShifts')->with('msg', $message);
    }
}
