@extends('Backend.layouts.master')
@push('backend-stylesheet')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{asset('backend/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/plugins/table/datatable/dt-global_style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/plugins/table/datatable/custom_dt_custom.css')}}" rel="stylesheet" type="text/css" />
    />
    <!-- END PAGE LEVEL STYLES -->
@endpush
@section('content')

     <!--  BEGIN MAIN CONTAINER  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="page-header">
                <div class="page-title">
                    <h3>View Users </h3>
                </div>
                <div class="dropdown filter custom-dropdown-icon">
                    <button class="btn btn-outline-secondary  mb-4 btn-rounded" ><a href="{{ route('posts.create')}}">Create Post</a></button>
                </div>
            </div>

            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content">
                <div class="layout-px-spacing">
                    <div class="row layout-top-spacing" id="cancel-row">
                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                            <div class="widget-content widget-content-area br-6">
                                <div class="table-responsive mb-4 mt-4">
                                    <table id="zero-config" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Post Title</th>
                                                <th>Post Slug</th>
                                                <th>Post Status</th>
                                                <th>Post Published</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @forelse ($posts as $post)
                                            <tr>
                                                <td> {{$post->post_title}}</td>

                                                
                                                <td> {{$post->post_slug}}</td>
                                                @if($post->post_status = 0)
                                                    <td> In Active</td>
                                                @else
                                                    <td> Active</td>
                                                @endif
                                                @if ( $post->is_published = 0)
                                                    <td> No</td>
                                                @else
                                                    <td>Yes</td>
                                                @endif
                                                
                                                <td class="d-flex" style="padding-right: 5px;">
                                                    <button class="btn btn-outline-primary mb-2" style = "margin-right:5px;"><a href="{{ route('posts.edit',  $post->id) }}">Edit</a></button>
                                                    <button class="btn btn-outline-primary mb-2" style="margin-right:5px;" ><a href="{{ route('posts.show', $post->post_slug) }}">Show</a></button>
                                                    <form  method="POST" action="{{route('posts.destroy', $post->id ) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger mb-2">Delete</button>
                                                   </form>
                                                </td>
                                            </tr>
                                             @empty
                                             <tr>
                                                <td colspan="3" ><center>No Users Found</center></td>
                                            </tr>
                                             @endforelse
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection