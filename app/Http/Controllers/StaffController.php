<?php

namespace App\Http\Controllers;

use App\Models\staff;
use App\Models\task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    public function show_staff(Request $request)
    {
        $page = $request->query('page') ? $request->query('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $staff = staff::offset($offset)->limit($limit)->get();
        return view('admin.staff',['staff'=> $staff]);
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function add_staff()
    {
        return view('admin.add_staff');
    }
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_staff(Request $request)
    {
        $staff = new Staff;
        $validation = $request->validate([
         'name' => 'required|max:255|min:3',
         'email'=> 'required',
         'mobile' => 'required|max:10|min:10'
        ]);  

 
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->mobile = $request->mobile;

        $staff->save();


        return redirect()->route('show-staff');



    }

    /**
     * Display the specified resource.
     */
    public function edit_staff($id)
    {
        $staff_edit = staff::find($id);

        return view('admin.edit_staff',['staff_edit'=> $staff_edit]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function all_data()
    {
        $task = task::get()->count();
        $staff = staff::get()->count();

        return view('admin.dashboard', ['task' => $task , 'staff'=>$staff]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit_store_staff(Request $request)
    {

        $staff =  Staff::find($request->id);
        $validation = $request->validate([
         'name' => 'required|max:255|min:3',
         'email'=> 'required',
         'mobile' => 'required|max:10|min:10'
        ]);  

 
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->mobile = $request->mobile;

        $staff->save();
       
        

        return redirect()->route('show-staff');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_staff($id)
    {

        $staff_edit = staff::find($id)->delete();
        return redirect()->route('show-staff');
        
    }

    public function exel_staff()
    {

        $staff = staff::get();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'id');
$sheet->setCellValue('B1', 'name');
$sheet->setCellValue('C1', 'email');
$sheet->setCellValue('D1', 'mobile');
$sheet->setCellValue('E1', 'created_at');
$sheet->setCellValue('F1', 'updated_at');

$rowCount = 2;

foreach($staff as $data){


    $sheet->setCellValue('A'.$rowCount, $data->id);
    $sheet->setCellValue('B'.$rowCount, $data->name);
    $sheet->setCellValue('C'.$rowCount, $data->email);
    $sheet->setCellValue('D'.$rowCount, $data->mobile);
    $sheet->setCellValue('E'.$rowCount, $data->created_at);
    $sheet->setCellValue('F'.$rowCount, $data->updated_at);

    $rowCount++;

}


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="staff-sheet.xlsx"');
header('Cache-Control: max-age=0');


$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

    

exit;
    }


}

