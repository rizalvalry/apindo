@extends('admin.layouts.app')
@section('title')
    @lang("Purchase Package List")
@endsection

@section('content')
    <style>
        .fa-ellipsis-v:before {
            content: "\f142";
        }
    </style>
    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <form action="" method="get" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-3 col-xl-3 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="title"> @lang('Filter By User')</label>
                                <select name="user" class="form-control filter__by__user">
                                    <option selected disabled>@lang('Select User')</option>
                                    @foreach($allDistinctUsers as $user)
                                        @php
                                            $firstname = optional($user->get_user)->firstname;
                                            $lastname = optional($user->get_user)->lastname;
                                            $fullname = $firstname." ".$lastname;
                                        @endphp
                                        <option value="{{ $user->user_id }}" {{  request()->user == $user->user_id ? 'selected' : '' }}>@lang($fullname)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="title"> @lang('Package')</label>
                                <select name="package" class="form-control">
                                    <option selected disabled>@lang('Select Package')</option>
                                    @foreach($packages as $package)
                                        <option value="{{ $package->id }}" {{  request()->package ==  $package->id ? 'selected' : '' }}>@lang(optional($package->details)->title)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label for="title"> @lang('Validity')</label>
                                <select name="package_status" class="form-control">
                                    <option value="active" {{ request()->package_status == 'active' ? 'selected' : '' }}>@lang('Active')</option>
                                    <option value="expired" {{ request()->package_status == 'expired' ? 'selected' : '' }}>@lang('Expired')</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label for="title"> @lang('Status')</label>
                                <select name="status" class="form-control">
                                    <option selected disabled>@lang('Status')</option>
                                    <option value="0"
                                            @if(@request()->status == '0') selected @endif>@lang('Pending')</option>
                                    <option value="1"
                                            @if(@request()->status == '1') selected @endif>@lang('Approved')</option>
                                    <option value="2"
                                            @if(@request()->status == '2') selected @endif>@lang('Cancelled')</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4 col-xl-4 col-sm-6">
                            <div class="form-group">
                                <label for="title"> @lang('From Date')</label>
                                <input type="date" class="form-control from_date" name="from_date" id="datepicker" placeholder="@lang('From date')" value="{{ old('from_date', request()->from_date) }}"/>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4 col-sm-6">
                            <div class="form-group">
                                <label for="title"> @lang('To Date')</label>
                                <input type="date" class="form-control to_date" name="to_date" id="datepicker" placeholder="@lang('To date')" value="{{ old('to_date', request()->to_date) }}" disabled="true"/>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4 col-sm-6">
                            <div class="form-group">
                                <label></label>
                                <button type="submit" class="btn w-100 w-md-auto btn-primary listing-btn-search-custom mt-2"><i
                                        class="fas fa-search"></i> @lang('Search')
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <div class="col-md-auto package_export_box mt-2 ml-2 d-none">
            <div class="form-group">

                <form action="{{ route('admin.export.packages.excel') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                    @csrf
                    <input type="hidden" name="package_id" class="export_selected_packages">
                    <button type="submit" class="btn btn-outline-info btn-rounded btn-sm">{{ __('Export Excel') }}</button>
                </form>

                <form action="{{ route('admin.export.packages.csv') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                    @csrf
                    <input type="hidden" name="package_id" class="export_selected_packages">
                    <button type="submit" class="btn btn-outline-success btn-rounded btn-sm">{{ __('Export Csv') }}</button>
                </form>
                <button class="btn btn-outline-danger btn-rounded btn-sm d-inline btn-sm" data-toggle="modal" data-target="#delete_selected_packages">{{ __('Delete') }}</button>
            </div>
        </div>
    </div>


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        @if(adminAccessRoute(config('role.manage_package.access.edit')) == true)
                            <th scope="col" class="text-center">
                                <input type="checkbox" class="form-check-input check-all tic-check check_all" value="1" name="check-all"
                                       id="check-all" data-status="all">
                                <label for="check-all"></label>
                            </th>
                        @endif

                        <th scope="col">@lang('No.')</th>
                        <th scope="col">@lang('User')</th>
                        <th scope="col">@lang('Package')</th>
                        <th scope="col">@lang('Purchased Date')</th>
                        <th scope="col">@lang('Expired Date')</th>
                        <th scope="col">@lang('Validity')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($all_purchase_packages as $package)
                        <tr>
                            @if(adminAccessRoute(config('role.manage_package.access.edit')) == true)
                                <td class="text-center">
                                    <input type="checkbox" name="id[]"
                                           value="{{ $package->id }}"
                                           class="form-check-input row-tic tic-check"
                                           id="customCheck{{ $package->id }}"
                                           data-id="{{ $package->id }}"
                                           data-package = "{{ optional($package->get_package)->title }}">
                                    <label for="customCheck{{ $package->id }}"></label>
                                </td>
                            @endif

                            <td data-label="@lang('No.')">{{loopIndex($all_purchase_packages) + $loop->index}}</td>
                            <td data-label="@lang('User')">
                                <div class="float-left">
                                    <a href="{{ route('admin.user-edit', optional($package->get_user)->id) }}" target="_blank">
                                        <img src="{{getFile(optional($package->get_user)->driver, optional($package->get_user)->image)}}" alt="" class="contactImageUser">
                                    </a>


                                </div>
                                <div class="float-left">
                                    @lang(optional($package->get_user)->firstname) @lang(optional($package->get_user)->lastname) <br>
                                    @lang(optional($package->get_user)->email)
                                </div>

                            </td>
                            <td data-label="@lang('Package Name')">@lang(optional(optional($package->getPlanInfo)->details)->title)</td>

                            <td data-label="@lang('Purchased Date')">{{ $package->purchase_date->format('m/d/y') }}</td>

                            <td data-label="@lang('Expired date')">
                                @if ($package->expire_date == null)
                                    <span class="badge badge-pill badge-success">@lang('Unlimited')</span>
                                @else
                                    {{ $package->expire_date->format('m/d/y') }}
                                @endif
                            </td>
                            <td data-label="@lang('Validity')">
                                @if (\Carbon\Carbon::now()->format('Y-m-d') <= \Carbon\Carbon::parse($package->expire_date))
                                    <span class="badge badge-pill bg-success text-white">@lang('Active')</span>
                                @elseif ($package->expire_date == null)
                                    <span class="badge badge-pill bg-success text-white">@lang('Active')</span>
                                @else
                                    <span class="badge badge-pill bg-danger text-white">@lang('Expired')</span>
                                @endif
                            </td>

                            @php
                                $fundInfo = \App\Models\Fund::where('purchase_package_id', $package->id)->latest()->first();
                            @endphp


                            @if($package->status == 0 || $package->status == 2 || ($fundInfo && ($fundInfo->status == 2 || $fundInfo->status == 3)))
                                <td data-label="@lang('Action')" class="text-center">
                                    <div class="dropdown show ">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{ route('admin.payment.pending', $package->id) }}">
                                                <i class="fa fa-dollar-sign pr-2"></i>  @lang('Payment History')
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            @else
                                <td data-label="@lang('Action')" class="text-center">
                                    <div class="dropdown show ">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{ route('admin.payment.log', $package->id) }}">
                                                <i class="fa fa-dollar-sign pr-2"></i>  @lang('Payment History')
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="9">@lang('No Data Found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{$all_purchase_packages->appends(@$search)->links('partials.pagination')}}
            </div>
        </div>
    </div>

    @push('adminModal')

        <div id="delete_selected_packages" class="modal fade" tabindex="-1" role="dialog"
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
                        <p>@lang('Are you sure to delete?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-dismiss="modal">@lang('Close')</button>
                        <form action="{{ route('admin.selected.package.delete') }}" method="post" enctype="multipart/form-data" class="deleteRoute">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="package_id" class="package_id_checked">
                            <button type="submit" class="btn btn-primary">@lang('Yes')</button>
                        </form>
                    </div>
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



    @endpush
@endsection

@push('js')
    <script>
        'use strict'
        $(document).ready(function () {
            $('.notiflix-confirm').on('click', function () {
                var route = $(this).data('route');
                $('.deleteRoute').attr('action', route)
            })

            $('.from_date').on('change', function (){
                $('.to_date').removeAttr('disabled')
            });

            $('.filter__by__user').select2({
                selectOnClose: true,
                width:'100%'
            });
        });
    </script>

    <script>
        'use strict'
        $(document).ready(function (){
            var package_array = [];
            $(document).on('click', '.check_all', function (){
                package_array = [];
                if(this.checked){
                    console.log('checked');
                    $('.package_export_box').removeClass('d-none');
                    $('.package_export_box').removeClass('d-none');

                    $('.row-tic').each(function(){
                        $(this).prop('checked', true);
                        package_array.push($(this).attr('data-id'));
                        $('.package_id_checked').val(package_array);
                        $('.export_selected_packages').val(package_array);
                    });

                }else{

                    $('.package_export_box').addClass('d-none');

                    $('.row-tic').each(function(){

                        $(this).prop('checked', false);
                        $('.package_id_checked').val(package_array);
                        $('.export_selected_packages').val(package_array);

                    });
                }

                if(package_array.length == 0)
                {
                    $('.package_export_box').addClass('d-none');
                }else{
                    $('.package_export_box').removeClass('d-none');
                }
            })


            $(document).on("click", ".row-tic", function(){
                var data_id = $(this).attr('data-id');
                $('.row-tic').each(function(){
                    if($(this).is(':checked')){
                        $('.check_all').prop('checked', true)
                    } else{
                        $('.check_all').prop('checked', false)
                        return false;
                    }
                });

                if(package_array.indexOf(data_id)  != -1){
                    package_array = package_array.filter(item => item !== data_id)
                    $('.package_id_checked').val(package_array);
                    $('.export_selected_packages').val(package_array);
                }
                else{
                    package_array.push(data_id)
                    $('.package_id_checked').val(package_array);
                    $('.export_selected_packages').val(package_array);
                }


                if(package_array.length == 0)
                {
                    $('.package_export_box').addClass('d-none');
                }else{
                    $('.package_export_box').removeClass('d-none');
                }

            });
        })
    </script>

@endpush
