@extends('admin.layouts.app')
@section('title')
    @lang('Blog List')
@endsection

@section('content')
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            @if(adminAccessRoute(config('role.manage_blog.access.add')) == true)
                <div class="media mb-4 float-right">
                    <a href="{{route('admin.blogCreate')}}" class="btn btn-sm btn-primary mr-2">
                        <span><i class="fa fa-plus-circle"></i> @lang('Add New')</span>
                    </a>
                </div>
            @endif

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered" id="zero_config">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('SL No.')</th>
                        <th scope="col">@lang('Category')</th>
                        <th scope="col">@lang('Author')</th>
                        <th scope="col">@lang('Title')</th>
                        @if(adminAccessRoute(config('role.manage_blog.access.edit')) == true || adminAccessRoute(config('role.manage_blog.access.delete')) == true)
                            <th scope="col">@lang('Action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($blogs as $blog)
                        <tr>
                            <td data-label="@lang('SL No.')">{{$loop->index+1}}</td>
                            <td data-label="@lang('Category')">
                                @lang(optional(optional($blog->category)->details)->name)
                            </td>

                            <td data-label="@lang('Category')">
                                @lang(optional($blog->details)->author)
                            </td>

                            <td data-label="@lang('Category')">
                                @lang(optional($blog->details)->title)
                            </td>
                            @if(adminAccessRoute(config('role.manage_blog.access.edit')) == true || adminAccessRoute(config('role.manage_blog.access.delete')) == true)
                                <td data-label="@lang('Action')">
                                    @if(adminAccessRoute(config('role.manage_blog.access.edit')) == true)
                                    <a href="{{ route('admin.blogEdit',$blog->id) }}" class="btn btn-sm btn-outline-primary rounded edit-button">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                    @if(adminAccessRoute(config('role.manage_blog.access.delete')) == true)
                                        <a href="javascript:void(0)"
                                            data-route="{{ route('admin.blogDelete',$blog->id) }}"
                                            data-toggle="modal"
                                            data-target="#delete-modal"
                                            class="btn btn-sm btn-outline-danger rounded notiflix-confirm"><i class="fas fa-trash-alt"></i>
                                        </a>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">@lang('No Data Found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="primary-header-modalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header modal-colored-header bg-primary">
                   <h4 class="modal-title" id="primary-header-modalLabel">@lang('Delete Confirmation')
                   </h4>
                   <button type="button" class="close" data-dismiss="modal"
                           aria-hidden="true">×
                   </button>
               </div>
               <div class="modal-body">
                   <p>@lang('Are you sure to delete this?')</p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-light"
                           data-dismiss="modal">@lang('Close')</button>
                   <form action="" method="post" class="deleteRoute">
                       @csrf
                       @method('delete')
                       <button type="submit" class="btn btn-primary">@lang('Yes')</button>
                   </form>
               </div>
           </div>
       </div>
   </div>

@endsection
@push('style-lib')
    <link href="{{asset('assets/admin/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/datatable-basic.init.js') }}"></script>

    <script>
        'use strict'
        $('.notiflix-confirm').on('click', function () {
            var route = $(this).data('route');
            $('.deleteRoute').attr('action', route)
        })
    </script>
@endpush
