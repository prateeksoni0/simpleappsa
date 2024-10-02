

@extends('layouts.app')

@section('content')


<div class="container-fluid bg-white">

    
  <div class="row">
    <div class="col-md-12">
        <div class="p-3">
<h3 class="text-center">Edit Staff</h3>
        </div>
        <div class="p-2">
            <a class="btn btn-success" href="{{route('show-staff')}}">
                Back
            </a>
        </div>
        <div class="p-2 mt-5">
            <form class="p-1" action="{{route('edit-store-staff')}}" method="POST">
                @csrf
                <div class="mb-3">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <input type="hidden" value="{{$staff_edit->id}}" name="id">

                  <label for="Name" class="form-label">Name</label>
                  <input type="text" name="name" value="{{$staff_edit->name}}" class="form-control" id="Name" aria-describedby="Name">
                  
                </div>
                <div class="mb-3">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    <label for="Email" class="form-label">Email</label>
                    <input type="Email" name="email" value="{{$staff_edit->email}}" class="form-control" id="Email" aria-describedby="Email">
                  </div>
                  <div class="mb-3">
                    @error('mobile')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    <label for="Mobile" class="form-label">Mobile</label>
                    <input type="number" name="mobile" value="{{$staff_edit->mobile}}" class="form-control" id="Mobile" aria-describedby="Mobile">
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

