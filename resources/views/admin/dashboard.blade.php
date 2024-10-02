

  @extends('layouts.app')

  @section('content')

  {{-- @dd($task); --}}

 
  <div class="container-fluid bg-white">
     <div class="row">
    <div class="col-sm-5 mx-3 shadow mb-5 bg-body rounded">
      <div class="card">
        <div class="card-body ">
          <h5 class="card-title">Total Staff</h5>
          <a href="{{route('show-staff')}}" class="btn btn-primary">{{$task}}</a>
        </div>
      </div>
    </div>
    <div class="col-sm-5 mx-3 shadow mb-5 bg-body rounded  ">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Total Task</h5>
          <a href="{{route('show-task')}}" class="btn btn-primary">{{$staff}}</a>
        </div>
      </div>
    </div>
    
</div>
</div>

@endsection

