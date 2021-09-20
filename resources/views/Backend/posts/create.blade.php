@extends('Backend.layouts.master')
@push('backend-stylesheet')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{asset('backend/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
@endpush
@section('content')
<div class="page-header">
    <div class="page-title">
        <h3>Posts</h3>
    </div>
</div>
<div class="row">
    <div id="flFormsGrid" class="col-lg-6 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <h4>Create Post</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row mb-12">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Post Title</label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="Post Title" name="post_title">
                            {{-- <span style="color: red;">{{$errors->first('name')}}</span> --}}
                        </div>
                         <div class="invalid-feedback"> 
                            @if ($errors->has('post_title'))
                                <span class="text-danger">{{ $errors->first('post_title') }}</span>
                            @endif 
                        </div>
                    </div>
                    <div class="form-row mb-12">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Post Content</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="post_content"></textarea>
                            <div class="invalid-feedback"> 
                                @if ($errors->has('post_content'))
                                    <span class="text-danger">{{ $errors->first('post_content') }}</span>
                                @endif 
                            </div>
                        </div>
                    </div>
                     <div class="form-row mb-12">
                        <div class="form-group col-md-12">
                            <label>Published</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="status" name="status" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="status">Active</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="status2" name="status" class="custom-control-input" value="0">
                                <label class="custom-control-label" for="status2">In Active</label>
                            </div>
                        </div>
                         <div class="invalid-feedback"> 
                            @if ($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif 
                        </div>

                    </div>
                    <div class="form-row mb-12">
                        <div class="form-group col-md-12">
                            <label>Published</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="is_published" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="customRadio1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="is_published" class="custom-control-input" value="0">
                                <label class="custom-control-label" for="customRadio2">No</label>
                            </div>
                        </div>
                         <div class="invalid-feedback"> 
                            @if ($errors->has('is_published'))
                                <span class="text-danger">{{ $errors->first('is_published') }}</span>
                            @endif 
                        </div>
                    </div>
                                     
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('backend-scripts')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('backend/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>

    <script>
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage')
        //Second upload
        var secondUpload = new FileUploadWithPreview('mySecondImage')
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
@endpush
