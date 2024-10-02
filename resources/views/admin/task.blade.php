

@extends('layouts.app')

@section('content')


<div class="container-fluid bg-white">
  <div class="row">
    <div class="col-md-12">
        <div class="p-3">
<h3 class="text-center">All tasks</h3>
        </div>
        <div class="row">
        <div class="col-md-6 p-2">
            <a class="btn btn-success" href="{{route('add-task')}}">
                Add task
            </a>
        </div>
        <div class="col-md-6 p-2">
          <form action="{{route('exel-task')}}" method="POST">
            @csrf
          <button type="submit" class="btn btn-secondary" name="export_btn" href="">
              Export In XLsheet
          </button>
        </form>

         
      </div>
      </div>
        <div class="p-2">
        <table class="table table-sm table-bordered 
                  bg-success text-light rounded-3">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Staff</th>
                <th scope="col">Staff Email</th>
                <th scope="col">Task Type</th>
                <th scope="col">Task Detail</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($task as $tasks)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$tasks->staff->name}}</td>
                    <td>{{$tasks->staff->email}}</td>
                    <td>{{$tasks->task_type}}</td>
                    <td>{{$tasks->task_detail}}</td>
                    <td><a class="btn btn-primary" href="{{route('edit-task',['id'=>$tasks->id])}}">
                        Edit    
                    </a>
                    <a class="btn btn-danger" href="{{route('delete-task',['id'=>$tasks->id])}}">
                        Delete    
                    </a>
                </td>
                 
                  </tr>
                @endforeach

            </tbody>
          </table>
          <div>
            <nav aria-label="Page navigation example">
            @php
                $page =request()->query('page')?request()->query('page'):1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $task_count = App\Models\task::get();
        $total = count($task_count);
        $total_pages = ceil($total / $limit);


        echo '<ul class="pagination">';
if ($page > 1) {
    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
}

for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo '<li class="page-item"><a class="page-link" href="javascript:void(0);">' . $i . '</a></li>';
    } else {
        echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }
}

if ($page < $total_pages) {
    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
}
echo '</ul>';


            @endphp
            
          
            </nav>
          </div>
        </div>
    </div>


  {{-- <div class="py-6 px-6 text-center">
    <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
        class="pe-1 text-primary text-decoration-underline">AdminMart.com</a>Distributed by <a href="https://themewagon.com/" target="_blank"
        class="pe-1 text-primary text-decoration-underline">ThemeWagon</a></p>
  </div> --}}
</div>
</div>

@endsection

