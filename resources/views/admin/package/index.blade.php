@extends('admin.layouts.app')
@section('title')
    @lang('Package List')
@endsection

@section('content')
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            @if(adminAccessRoute(config('role.manage_package.access.add')))
                <div class="media mb-4 float-right">
                    <a href="{{route('admin.packageCreate')}}" class="btn btn-sm btn-primary mr-2">
                        <span><i class="fa fa-plus-circle"></i> @lang('Add New')</span>
                    </a>
                </div>
            @endif

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered" id="zero_config">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('SL No.')</th>
                        <th scope="col">@lang('Package Name')</th>
                        <th scope="col">@lang('Price')</th>
                        <th scope="col">@lang('Expiry Time')</th>
                        <th scope="col">@lang('Status')</th>
                        @if(adminAccessRoute(config('role.manage_package.access.edit')) == true || adminAccessRoute(config('role.manage_package.access.delete')) == true)
                            <th scope="col">@lang('Action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($Packages as $item)
                        <tr>
                            <td data-label="@lang('SL No.')">{{$loop->index+1}}</td>
                            <td data-label="@lang('Package Name')">
                                @lang(optional($item->details)->title)
                            </td>

                            <td data-label="@lang('Price')">
                                @if($item->price == null)
                                    {{ $basic->currency_symbol ?? 'USD' }}0
                                @else
                                    {{ $basic->currency_symbol ?? 'USD' }}{{ $item->price }}
                                @endif
                            </td>

                            <td data-label="@lang('Expiry Time')">
                                @if ($item->expiry_time == Null)

                                    <span class="badge badge-pill badge-success">@lang('Unlimited')</span>
                                @else
                                    {{ $item->expiry_time }} @lang($item->expiry_time_type)
                                @endif

                            </td>
                            <td data-label="@lang('Status')">
                                <span class="badge badge-pill {{ $item->status == 1 ? 'badge-success' : 'badge-danger' }}">@lang($item->status == 1 ? 'Active' : 'Deactive')</span>
                            </td>
                            @if(adminAccessRoute(config('role.manage_package.access.edit')) == true || adminAccessRoute(config('role.manage_package.access.delete')) == true)
                                <td data-label="@lang('Action')">
                                    @if(adminAccessRoute(config('role.manage_package.access.edit')) == true)
                                    <a href="{{ route('admin.packageEdit',$item->id) }}" class="btn btn-outline-primary btn-sm rounded btn-icon edit_button">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="100%">@lang('No Data Found')</td>
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

    @if ($errors->any())
        @php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        @endphp
        <script>
            "use strict";
            @foreach ($errors as $error)
            Notiflix.Notify.Failure("{{trans($error)}}");
            @endforeach
        </script>
    @endif

    <script>
        'use strict'
        $(document).ready(function () {
            $('.notiflix-confirm').on('click', function () {
                var route = $(this).data('route');
                $('.deleteRoute').attr('action', route)
            })
        });
    </script>
@endpush
