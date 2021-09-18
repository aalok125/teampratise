@extends('Backend.layouts.master')
@push('backend-stylesheet')

@endpush
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h3>Edit Users</h3>
        </div>
    </div>
    <div class="widget-content widget-content-area">
        <form action="{{--{{route('backend.users.store')}}--}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-row mb-6">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Name</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="Name" name="name" value="{{$user->name}}">
                    <span style="color: red;">{{$errors->first('name')}}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" value="{{$user->email}}">
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" placeholder="Password" name="password_confirmation">
                </div>
            </div>
            {{-- <div class="form-group mb-4">
                 <label for="inputAddress">Address</label>
                 <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address">
             </div>--}}
            {{--  <div class="custom-file-container" data-upload-id="myFirstImage">
                  <label>Upload (Single File) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                  <label class="custom-file-container__custom-file" >
                      <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="image">
                      <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                      <span class="custom-file-container__custom-file__custom-file-control"></span>
                  </label>
                  <div class="custom-file-container__image-preview"></div>
              </div>--}}
            <button type="submit" class="btn btn-primary mt-3">Register</button>
        </form>
    </div>
    @endsection
