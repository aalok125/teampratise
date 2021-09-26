@extends('Backend.layouts.master')
@push('backend-stylesheet')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{asset('backend/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <!-- END PAGE LEVEL STYLES -->
@endpush
@section('content')
<div class="page-header">
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item"><a href="{{route('posts.index')}}">Post</a></li>
            <li class="breadcrumb-item {{ (request()->routeIs('posts.edit')) ? 'active' : '' }}">Edit</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div id="flFormsGrid" class="col-lg-6 layout-spacing" style="margin:auto;">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <h4>Edit Post</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <form action="{{route('posts.update',$post->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-row mb-12">
                        <div class="form-group col-md-12">
                            <label for="post_title">Post Title</label>
                            <input type="text" class="form-control" name="post_title" placeholder = "Enter Title" value="{{ $post->post_title ?? old}}">
                            <div class="has-error"> 
                                @error('post_title')
                                <span class="text-danger">{{ $errors->first('post_title') }}</span>
                                @enderror
                            </div>
                        </div>
                   
                    </div>
                    <div class="form-row mb-12">
                        <div class="form-group col-md-12">
                            <label for="post_content">Post Content</label>
                           <textarea class="form-control" id="summernote" rows="4" name="post_content">{{ $post->post_content}}</textarea>
                            <div class="has-error"> 
                                @error('post_content')
                                    <span class="text-danger">{{ $errors->first('post_content') }}</span>
                                @enderror 
                            </div>
                        </div>
                    </div>
                     <div class="form-row mb-12">
                        <div class="form-group col-md-12">
                            <label>Status</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="post_status" name="post_status" class="custom-control-input" value="1"  @if($post->post_status == 1) checked  @endif >
                                <label class="custom-control-label" for="post_status">Active</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="post_status2" name="post_status" class="custom-control-input" value="0"  @if($post->post_status == 0) checked  @endif>
                                <label class="custom-control-label" for="post_status2">In Active</label>
                            </div>
                        </div>
                         <div class="has-error"> 
                            @error('status')
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @enderror 
                        </div>

                    </div>
                    <div class="form-row mb-12">
                        <div class="form-group col-md-12">
                            <label>Published</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="is_published1" name="is_published" class="custom-control-input" value="1"  @if($post->post_status == 1) checked  @endif>
                                <label class="custom-control-label" for="is_published1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="is_published2" name="is_published" class="custom-control-input" value="0"  @if($post->post_status == 0) checked  @endif>
                                <label class="custom-control-label" for="is_published2">No</label>
                            </div>
                        </div>
                         <div class="has-error"> 
                            @error('is_published')
                                <span class="text-danger">{{ $errors->first('is_published') }}</span>
                            @enderror 
                        </div>
                    </div>
                    
                    <div class="custom-file-container" data-upload-id="myFirstImage">
                        <label>Upload Thumbnail<a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a></label>
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
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
        //First upload 
        @if(isset($post->postImage->name))
            var importedBaseImage = "{{asset($post->getThumbnail())}}";
            var firstUpload = new FileUploadWithPreview("myFirstImage",
                {images:{
                        baseImage:importedBaseImage,
                    },
                })
        @else
         var firstUpload = new FileUploadWithPreview('myFirstImage');
         }  });
        @endif
        
    </script>
    <!-- Summer Note Js -->
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                tabsize: 1,
                height: 150
            });
        });
    </script>
@endpush
