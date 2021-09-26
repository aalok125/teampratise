@extends('Backend.layouts.master')
@push('backend-stylesheet')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{asset('backend/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <link href="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
@endpush
@section('content')

<div class="page-header">
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item"><a href= "{{route('posts.index')}}" >Posts</a></li>
            <li class="breadcrumb-item {{ (request()->routeIs('posts.create')) ? 'active' : '' }}">Create Post</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div id="flFormsGrid" class="col-lg-6 layout-spacing" style="margin:auto">
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
                            <input type="text" class="form-control" id="inputEmail4" placeholder="Post Title" name="post_title" value="{{old ('post_title') }}">
                            @error('post_title')
                                <div class="has-error">
                                    <span class="text-danger">{{$errors->first('post_title')}}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row mb-12">
                        <div class="form-group col-md-12">
                            <label>Post Content</label>
                           <textarea class="form-control" id="summernote" rows="4" name="post_content" placeholder="Write Something about the post...">{{old ('post_content')}}</textarea>
                            <div class="has-error"> 
                                @error('post_content'))
                                    <span class="text-danger">{{ $errors->first('post_content') }}</span>
                                @enderror 
                            </div>
                        </div>
                    </div>
                     <div class="form-row mb-12">
                        <div class="form-group col-md-12">
                            <label>Status</label><br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="status" name="status" class="custom-control-input" value="1" checked>
                                <label class="custom-control-label" for="status">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="status2" name="status" class="custom-control-input" value="0" >
                                <label class="custom-control-label" for="status2">In Active</label>
                            </div>
                        </div>
                         <div class="has-error"> 
                            @error('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-row mb-12">
                        <div class="form-group col-md-12">
                            <label>Published</label><br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadio1" name="is_published" class="custom-control-input" value="1" checked>
                                <label class="custom-control-label" for="customRadio1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadio2" name="is_published" class="custom-control-input" value="0">
                                <label class="custom-control-label" for="customRadio2">No</label>
                            </div>
                        </div>
                         <div class="has-error"> 
                            @error('is_published')
                                <span class="text-danger">{{ $errors->first('is_published') }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="custom-file-container" data-upload-id="myFirstImage">
                        <label>Upload Thumbnail<a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                        <label class="custom-file-container__custom-file" >
                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="name">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div class="custom-file-container__image-preview"></div>
                        <div class="has-error"> 
                            @error('name')
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @enderror
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage')
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                tabsize: 1,
                height: 150
            });
           
        });
    </script>
    
@endpush
