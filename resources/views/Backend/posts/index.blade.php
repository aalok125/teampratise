@extends('Backend.layouts.master')
@push('backend-stylesheet')
    <!-- BEGIN PAGE LEVEL STYLES -->
 
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/dt-global_style.css')}}">
    <link href="{{asset('backend/plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('backend/plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('backend/plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('backend/assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />


@endpush
@section('content')
<div class="page-header">
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item {{ (request()->routeIs('posts.index')) ? 'active' : '' }}">Posts</li>
        </ol>
    </nav>
</div>
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <a href="{{route('posts.create')}}" class="btn btn-primary btn-rounded float-right mr-3 " style="margin-bottom: 20px">Create Post</a>
                    <a href="{{route('posts.trash')}}" class="btn btn-warning  btn-rounded float-right mr-2 " style="margin-bottom: 20px">Trash Post</a>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover " style="width:100%;">
                            <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th style="width:150px;">Post Title</th>
                                <th style="width:150px;">Post Slug</th>
                                <th>Status</th>
                                <th>Published</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td> <img src="{{asset($post->getThumbnail())}}" alt="Girl in a jacket" > </td>
                                <td>{{$post->post_title}}</td>
                                <td>{{$post->post_slug}}</td>
                                <td>@if($post->post_status == 1)
                                        <span class="badge badge-success"> Active </span> 
                                    @else 
                                        <span class="badge badge-danger"> Inactive </span> 
                                    @endif
                                </td>
                                <td>@if($post->is_published == 1)
                                    <span class="badge badge-success"> Yes </span> 
                                    @else 
                                    <span class="badge badge-danger"> No </span> 
                                    @endif
                                </td>
                                <td>{{ $post->user->name}}</td>
                                 
                                <td>
                                    <a type="button" data-id = "{{$post->id}}" class="btn btn-secondary showPost" style="display: inline-block" data-target="#showPost{{$post->id}}" data-toggle="modal">Show</a>
                                    <a type="button" href="{{route('posts.edit',$post->id)}}" class="btn btn-primary" style="display: inline-block">Edit</a>
                                    <a type="button"  data-id="{{$post->id}}" class="btn btn-danger deletePost" style="display: inline-block">Delete</a>
                                </td>                              
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal animated zoomInUp" id="showPostModal" tabindex="-1" role="dialog" aria-labelledby="showPostLabel" aria-hidden="true">
   
</div>


@endsection
@push('backend-scripts')

        <script src="{{asset('backend/plugins/table/datatable/datatables.js')}}"></script>
        <script src="{{asset('backend/plugins/sweetalerts/promise-polyfill.js')}}"></script>
        <script src="{{asset('backend/plugins/sweetalerts/sweetalert2.min.js')}}"></script>
        <script src="{{asset('backend/plugins/sweetalerts/custom-sweetalert.js')}}"></script>
        
        
        <script>
            $('#zero-config').DataTable({
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7
            });
        </script>

        <script>
            $(document).ready(function () {
                $('.showPost').on('click',function()
                {
                    var id = $(this).attr('data-id');
                    var viewUrl = "{{route('posts.show',':id')}}";
                    viewUrl = viewUrl.replace(":id",id);
                    $.ajax(
                    {
                        url: viewUrl, 
                        success:function(post) 
                        {
                            $(".zoomInUp").modal('show');
                            $(".zoomInUp").html(post);
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function ()
            {
                $('.deletePost').on('click',function (e)
                {    e.preventDefault();
                    var id = $(this).attr('data-id');
                    var deleteUrl = "{{route ('posts.delete',':id')}}";
                    deleteUrl = deleteUrl.replace(":id",id);
                    swal(
                    {
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Delete',
                        padding: '2em',
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }).then(function(result) 
                    {
                        if (result.value) {
                            $.ajax(
                            {
                                url: deleteUrl, 
                                success: function(response) 
                                {
                                    if (response.success === true) {
                                        swal("Done!", response.message, "success").then
                                            (function(){ 
                                            location.reload();
                                        });
                                    } else {
                                        swal("Error!", response.message, "error");
                                    }
                                }   
                            } );
                        }
                    });
                });
            });
             
        </script>

        
@endpush
