<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\staff;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;






class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show_task(request $request)
    {

        $page = $request->query('page') ? $request->query('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $task = task::offset($offset)->limit($limit)->get();
        return view('admin.task',['task'=> $task]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_task()
    {
        
       $staff = staff::all();
        return view('admin.add_task',['staff'=>$staff]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_task(Request $request)
    {

        // @dd($request->task_type);
        $task = new task;
        $validation = $request->validate([
         'task_detail' => 'required'
        ]);  

 
        $task->user_id = $request->staff;
        $task->task_detail = $request->task_detail;
        $task->task_type = $request->task_type;


        $task->save();


        return redirect()->route('show-task');



    }

    /**
     * Display the specified resource.
     */
    public function edit_task($id)
    {
        $staff = staff::all();
        $task_edit = task::find($id);

        return view('admin.edit_task',['task_edit'=> $task_edit , 'staff' => $staff]);
    }

 
    public function exel_task()
    {

        $task = task::get();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'id');
$sheet->setCellValue('B1', 'user_id');
$sheet->setCellValue('C1', 'task_detail');
$sheet->setCellValue('D1', 'task_type');
$sheet->setCellValue('E1', 'created_at');
$sheet->setCellValue('F1', 'updated_at');

$rowCount = 2;

foreach($task as $data){


    $sheet->setCellValue('A'.$rowCount, $data->id);
    $sheet->setCellValue('B'.$rowCount, $data->user_id);
    $sheet->setCellValue('C'.$rowCount, $data->task_detail);
    $sheet->setCellValue('D'.$rowCount, $data->task_type);
    $sheet->setCellValue('E'.$rowCount, $data->created_at);
    $sheet->setCellValue('F'.$rowCount, $data->updated_at);

    $rowCount++;

}


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="tasksheet.xlsx"');
header('Cache-Control: max-age=0');


$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

    

exit;
    }

    public function edit_store_task(Request $request)
    {

        $task =  task::find($request->id);
        $validation = $request->validate([
            'task_detail' => 'required'
           ]);  
   
    
           $task->user_id = $request->staff;
           $task->task_detail = $request->task_detail;
           $task->task_type = $request->task_type;

        $task->save();

        ?>
<?php 

        return redirect()->route('show-task');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_task($id)
    {
        $task_edit = task::find($id)->delete();
        return redirect()->route('show-task');
        
    }
}

