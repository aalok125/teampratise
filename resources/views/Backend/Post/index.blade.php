@extends('Backend.layouts.master')
@push('backend-stylesheet')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/dt-global_style.css')}}">
    <!-- END PAGE LEVEL STYLES -->
    <!-- END PAGE LEVEL STYLES -->
@endpush
@section('content')
<div class="page-header">
    <div class="page-title">
        <h3>Posts</h3>
    </div>
</div>
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <a href="{{route('posts.create')}}" class="btn btn-primary float-right" style="margin-bottom: 20px">Create Post</a>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>Post Title</th>
                                <th>Post Slug</th>
                                <th>Status</th>
                                <th>Published</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($posts as $post)
                            <tr>
                                <td>{{$post->post_title}}</td>
                                <td>{{$post->post_slug}}</td>
                                <td>@if($post->post_status == 1)
                                        <span class="badge badge-success"> Active </span> 
                                    @else 
                                        <span class="badge badge-danger"> Inactive </span> 
                                    @endif
                                </td>
                                <td>@if($post->is_publlishe == 1)
                                    <span class="badge badge-success"> Yes </span> 
                                    @else 
                                    <span class="badge badge-danger"> Inactive </span> 
                                    @endif
                                </td>
                                <!-- <td style='white-space: nowrap'>
                                    <a type="button" href="{{route('posts.edit',$post->id)}}" class="btn btn-primary" style="display: inline-block">Edit</a>
                                </td>
                                <td style='white-space: nowrap'>
                                    <a type="button" href="{{route('posts.detele',$post->id)}}" class="btn btn-primary" style="display: inline-block">Edit</a>
                                </td> -->
                            </tr>
                            @empty
                                No posts
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('backend-scripts')
        <script src="{{asset('backend/plugins/table/datatable/datatables.js')}}"></script>
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
@endpush
