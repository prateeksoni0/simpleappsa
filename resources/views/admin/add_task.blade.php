

@extends('layouts.app')

@section('content')

<div class="container-fluid bg-white">

    
  <div class="row">
    <div class="col-md-12">
        <div class="p-3">
<h3 class="text-center">Add task</h3>
        </div>
        <div class="p-2">
            <a class="btn btn-success" href="{{route('show-task')}}">
                Back
            </a>
        </div>
        <div class="p-2 mt-5">
            <form class="p-1" action="{{route('store-task')}}" method="POST">
                @csrf
                {{-- <div class="mb-3">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                  <label for="Name" class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" id="Name" aria-describedby="Name">
           
                </div> --}}
                <div class="mb-3">
                <label for="Name" class="form-label">Staff</label>
                <select class="form-select" name="staff" aria-label="Default select example">
                    <option selected value="no-select">Select Staff</option>
                    @foreach($staff as $staffs)
                    <option value="{{$staffs->id}}">{{$staffs->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                    @error('task_type')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    <label for="task_type" class="form-label">Task Type</label>
                <select class="form-select" name="task_type" aria-label="Default select example">
                    <option value="no-select" selected>Select Status</option>
                    <option value="pending">Pending</option>
                    <option value="done">Done</option>
                </select>
                  </div>
                  <div class="mb-3">
                    @error('task_detail')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    <label for="task_detail" class="form-label">Task Detail</label>
                    <textarea type="number" name="task_detail" rows="4" name="task_detail" class="form-control" id="task_detail" aria-describedby="task_detail"></textarea>
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
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

