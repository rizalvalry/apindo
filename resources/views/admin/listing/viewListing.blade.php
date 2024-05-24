@extends('admin.layouts.app')
@section('title')
    @lang("User Listing List")
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
                                <label for="title"> @lang('Listing')</label>
                                <input type="text" name="title" value="{{ old('title',request()->title) }}" class="form-control"
                                       placeholder="@lang('Listing..')">
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

                        <div class="col-md-3 col-xl-3 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="title"> @lang('Listing Category')</label>
                                <select name="category[]" class="form-control listing__category__select2" multiple>
                                    <option value="all"
                                            @if(request()->category && in_array('all', request()->category))
                                                selected
                                        @endif>@lang('All Category')</option>
                                    @foreach($listingCategories as $category)
                                        <option value="{{ $category->id }}"
                                                @if(request()->category && in_array($category->id, request()->category))
                                                    selected
                                            @endif>@lang(optional($category->details)->name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="title"> @lang('Location')</label>
                                <select name="location" class="form-control">
                                    <option selected disabled>@lang('Enter Location')</option>
                                    @foreach($allLocations as $location)
                                        <option value="{{ $location->id }}" {{  request()->location == $location->id ? 'selected' : '' }}>@lang(optional($location->details)->place)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label for="title"> @lang('From Date')</label>
                                <input type="date" class="form-control from_date" name="from_date" id="datepicker" placeholder="@lang('From date')" value="{{ old('from_date', request()->from_date) }}"/>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label for="title"> @lang('To Date')</label>
                                <input type="date" class="form-control to_date" name="to_date" id="datepicker" placeholder="@lang('To date')" value="{{ old('to_date', request()->to_date) }}" disabled="true"/>
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
                                            @if(@request()->status == '2') selected @endif>@lang('Rejected')</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
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

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            @if(adminAccessRoute(config('role.manage_listing.access.edit')) == true)
                <div class="dropdown mb-2 text-right">
                    <button class="btn btn-sm  btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span><i class="fas fa-bars pr-2"></i> @lang('Action')</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_active"><i class="fas fa-check pr-2"></i> @lang('Approved')</button>
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_inactive"><i class="fas fa-times pr-2"></i> @lang('Rejected')</button>
                    </div>
                </div>
            @endif

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        @if(adminAccessRoute(config('role.manage_listing.access.edit')) == true)
                        <th scope="col" class="text-center">
                            <input type="checkbox" class="form-check-input check-all tic-check" name="check-all"
                                   id="check-all">
                            <label for="check-all"></label>
                        </th>
                        @endif
                        <th scope="col">@lang('No.')</th>
                        <th scope="col">@lang('User')</th>
                        <th scope="col">@lang('Package')</th>
                        <th scope="col">@lang('Listing')</th>
                        <th scope="col">@lang('Category')</th>
                        <th scope="col">@lang('Address')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Stage')</th>
                        @if(adminAccessRoute(config('role.manage_listing.access.edit')) == true || adminAccessRoute(config('role.manage_listing.access.delete')) == true)
                        <th scope="col">@lang('Action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($all_user_listings as $listing)
                        <tr>
                            @if(adminAccessRoute(config('role.manage_listing.access.edit')) == true)
                            <td class="text-center">
                                <input type="checkbox" id="chk-{{ $listing->id }}"
                                       class="form-check-input row-tic tic-check" name="check" value="{{$listing->id}}"
                                       data-id="{{ $listing->id }}"
                                       data-listing = "{{ $listing->title }}"
                                >
                                <label for="chk-{{ $listing->id }}"></label>
                            </td>
                            @endif

                            <td data-label="@lang('No.')">{{loopIndex($all_user_listings) + $loop->index}}</td>

                            <td data-label="@lang('User')">
                                <div class="float-left">
                                    <a href="{{ route('admin.user-edit', optional($listing->get_user)->id) }}" target="_blank">
                                        <img src="{{getFile(optional($listing->get_user)->driver, optional($listing->get_user)->image)}}" alt="{{config('basic.site_title')}}" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    @lang(optional($listing->get_user)->firstname) @lang(optional($listing->get_user)->lastname) <br>
                                    @lang(optional($listing->get_user)->email)
                                </div>

                            </td>

                            <td data-label="@lang('package')">@lang(optional(optional($listing->get_package)->get_package)->title)</td>
                            <td data-label="@lang('listing')">
                                <a href="{{ route('listing-details',[slug($listing->title), $listing->id]) }}" target="_blank">
                                    @lang(\Illuminate\Support\Str::limit($listing->title, 20))
                                </a>

                            </td>

                            <td data-label="@lang('category')">
                                {{ $listing->getCategoriesName() }}
                            </td>
                            <td data-label="@lang('address')">@lang(\Illuminate\Support\Str::limit($listing->address, 20))</td>

                            <td data-label="@lang('Status')" class="text-center">
                                <span class="badge badge-pill
                                    @if($listing->status == 0)
                                        badge-danger
                                    @elseif($listing->status == 1)
                                        badge-success
                                    @else
                                        badge-warning
                                    @endif ">

                                    @if($listing->status == 0)
                                        @lang('Pending')
                                    @elseif($listing->status == 1)
                                        @lang('Approved')
                                    @else
                                        @lang('Rejected')
                                    @endif
                                </span>
                                @if($listing->status == 2)
                                    <sup>
                                        <a href="javascript:void(0)"
                                           title="@lang('Rejected Reason')"
                                           data-owner="@lang(optional($listing->get_user)->firstname) @lang(optional($listing->get_user)->lastname)"
                                           data-title="{{ $listing->title }}"
                                           data-rejectedreason="{{ $listing->rejected_reason }}"
                                           data-deactivereason="{{ $listing->deactive_reason }}"
                                           class="info-listing-btn listingRejectedInfo" aria-labelledby="dropdownMenuLink">  <i class="fas fa-info"></i>
                                        </a>
                                    </sup>
                                @endif
                            </td>

                            <td data-label="@lang('Stage')" class="text-center">

                                    <span class="badge badge-pill
                                        @if($listing->is_active == 0)
                                            badge-danger
                                        @else
                                             badge-success
                                        @endif ">

                                        @if($listing->is_active == 0)
                                            @lang('Deactive')
                                        @else
                                            @lang('Active')
                                        @endif
                                    </span>
                                @if($listing->is_active == 0)
                                    <sup>
                                        <a href="javascript:void(0)"
                                           data-owner="@lang(optional($listing->get_user)->firstname) @lang(optional($listing->get_user)->lastname)"
                                           data-title="{{ $listing->title }}"
                                           data-deactivereason="{{ $listing->deactive_reason }}"
                                           class="info-listing-btn listingDeactiveInfo" aria-labelledby="dropdownMenuLink">  <i class="fas fa-info"></i>
                                        </a>
                                    </sup>
                                @endif
                            </td>
                            @if(adminAccessRoute(config('role.manage_listing.access.edit')) == true || adminAccessRoute(config('role.manage_listing.access.delete')) == true)
                            <td data-label="@lang('Action')">
                                <div class="dropdown show ">

                                    <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @if(adminAccessRoute(config('role.manage_listing.access.edit')) == true)
                                            @if($listing->status == 0)
                                                <button class="dropdown-item singleApproved" type="button" data-toggle="modal"
                                                        data-target="#single_approved" data-id="{{ $listing->id }}"> <i class="fas fa-check pr-2"></i> @lang('Approved')
                                                </button>
                                                <button class="dropdown-item singleRejected" type="button" data-toggle="modal"
                                                        data-target="#single_rejected" data-id="{{ $listing->id }}"> <i class="fas fa-times pr-2"></i> @lang('Rejected')
                                                </button>
                                            @endif
                                            <a
                                               @if($listing->is_active == 0)
                                                    class="dropdown-item activeDeactiveListing listingActive"
                                                    data-id="{{ $listing->id }}"
                                                    data-title="{{ $listing->title }}"
                                               @else
                                                   class="dropdown-item activeDeactiveListing listingDeactive"
                                                   data-id="{{ $listing->id }}"
                                                   data-title="{{ $listing->title }}"
                                               @endif ">

                                                @if($listing->is_active == 0)
                                                    <i class="fa fa-toggle-off pr-2"></i> @lang('Active')
                                                @else
                                                    <i class="fa fa-toggle-on pr-2"></i> @lang('Deactive')
                                                @endif
                                            </a>
                                            <a href="{{ route('admin.listingAnalytics', $listing->id) }}"
                                               class="dropdown-item" aria-labelledby="dropdownMenuLink"><i class="fas fa-chart-line pr-2"></i> @lang('Analytics')
                                            </a>
                                            <a href="{{ route('admin.listingReview', $listing->id) }}"
                                               class="dropdown-item" aria-labelledby="dropdownMenuLink"><i class="fas fa-star pr-2"></i> @lang('Reviews')
                                            </a>
                                            @if($listing->is_active == 0 || $listing->status == 2)
                                            @else
                                                <a href="{{ route('admin.editListing', $listing->id) }}"
                                                   class="dropdown-item" aria-labelledby="dropdownMenuLink"><i class="fa fa-edit pr-2"></i> @lang('Edit')
                                                </a>
                                            @endif
                                        @endif
                                        @if(adminAccessRoute(config('role.manage_listing.access.delete')) == true)
                                            <a href="javascript:void(0)"
                                               data-route="{{ route('admin.viewListingDelete', $listing->id) }}"
                                               data-toggle="modal"
                                               data-target="#delete-modal"
                                               class="notiflix-confirm dropdown-item" aria-labelledby="dropdownMenuLink"><i class="fa fa-trash-alt pr-2"></i> @lang('Delete')
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @empty

                        <tr>
                            <td class="text-center text-danger" colspan="100%">@lang('No Data Found')</td>
                        </tr>

                    @endforelse
                    </tbody>
                </table>
                {{ $all_user_listings->appends(@$search)->links('partials.pagination') }}
            </div>
        </div>
    </div>

    @push('adminModal')
        <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title"><span class="messageShow"></span> @lang('Confirmation')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST" class="deleteRoute">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <p class="font-weight-bold">@lang('Are you sure delete message?') </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn waves-effect waves-light btn-dark" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn waves-effect waves-light btn-primary messageShow"> @lang('Delete')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div id="activeListingModal" class="modal fade" tabindex="-1" role="dialog"
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

        <!-- Active Listing Modal -->
        <div id="listingActiveModal" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="primary-header-modalLabel">@lang('Active Confirmation')
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="showListingTitle"> </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-dismiss="modal">@lang('Close')</button>
                        <form action="{{ route('admin.listingActive') }}" method="post">
                            @csrf
                            <input type="hidden" value="" class="listingActiveId" name="listing_id">
                            <button type="submit" class="btn btn-primary">@lang('Yes')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deactive Listing Modal -->
        <div class="modal fade" id="listingDeactiveModal" role="dialog">
            <div class="modal-dialog">
                <form action="{{ route('admin.listingDeactive') }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary">
                            <h5 class="modal-title">@lang('Deactive Listing Confirmation')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        </div>

                        <div class="modal-body">
                            <p class="showListingTitle"></p>

                            <div class="form-group">
                                <label for="">@lang('Write you reason')</label> <span class="text-danger">*</span>
                                <input type="hidden" value="" name="listing_id" class="listingDeactiveId">
                                <textarea name="deactive_reason" id="deactive_reason" required rows="4" class="form-control @error('deactive_reason') is-invalid @enderror" placeholder="@lang('type here...')"></textarea>
                                <div class="invalid-feedback">
                                    @error('deactive_reason') @lang($message) @enderror
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>

                            @csrf
                            <button type="submit" class="btn btn-primary">@lang('Yes')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Listing Deactive Info Modal -->
        <div class="modal fade" id="listingDeactiveInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="myModalLabel">@lang('Listing Information')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <form role="form" method="POST" class="actionRoute" action="" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item listingOwner"></li>
                                <li class="list-group-item listingTitle"></li>
                                <li class="list-group-item deactiveReason"></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Listing Rejected Info Modal -->
        <div class="modal fade" id="listingRejectedInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="myModalLabel">@lang('Listing Information')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <form role="form" method="POST" class="actionRoute" action="" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item listingOwner"></li>
                                <li class="list-group-item listingTitle"></li>
                                <li class="list-group-item rejectedReason"></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="single_approved" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title">@lang('Approved Listing Confirmation')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <p>@lang("Are you really want to approved this Listing?")</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                        <form>
                            <button type="button" class="btn btn-primary approved-yes"><span>@lang('Yes')</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="single_rejected" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title">@lang('Rejected Listing Confirmation')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <p>@lang("Are you really want to Rejected this Listing?")</p>
                        <div class="form-group">
                            <label for="">@lang('Write you reason')</label> <span class="text-danger">*</span>
                            <textarea name="single_reject_reason" id="single_reject_reason" rows="4" class="form-control" placeholder="@lang('type here...')"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                        <form>
                            <button type="button" class="btn btn-primary rejected-yes"><span>@lang('Yes')</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="all_active" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title">@lang('Approved Listing Confirmation')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <p>@lang("Are you really want to approved the Listing?")</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                        <form action="" method="post">
                            @csrf
                            <a href="javascript:void(0)"  class="btn btn-primary active-yes"><span>@lang('Yes')</span></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="all_inactive" role="dialog">
            <div class="modal-dialog">
                <form action="" method="post">
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary">
                            <h5 class="modal-title">@lang('Rejected Listing Confirmation')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        </div>

                        <div class="modal-body">
                            <p>@lang("Are you really want to rejected the Listing?")</p>
                            <div class="form-group">
                                <label for="">@lang('Write you reason')</label> <span class="text-danger">*</span>
                                <textarea name="reject_reason" id="reject_reason" rows="4" class="form-control" placeholder="@lang('type here...')"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                                @csrf
                                <a href="javascript:void(0)"  class="btn btn-primary inactive-yes"><span>@lang('Yes')</span></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endpush

@endsection


@push('js')
    <script>
        "use strict";
            $(document).on('click', '.listingActive', function () {
                var showListingActiveModal = new bootstrap.Modal(document.getElementById('listingActiveModal'))
                showListingActiveModal.show();
                let listingId = $(this).data('id');
                let listingTitle = $(this).data('title');
                $('.showListingTitle').text(`@lang('Are you sure to active ') ${listingTitle} @lang(' Listing?')`);
                $('.listingActiveId').val(listingId);
            });

            $(document).on('click', '.listingDeactive', function () {
                var showlistingDeactiveModal = new bootstrap.Modal(document.getElementById('listingDeactiveModal'))
                showlistingDeactiveModal.show();

                let listingId = $(this).data('id');
                let listingTitle = $(this).data('title');
                $('.showListingTitle').text(`@lang('Are you sure to deactive ') ${listingTitle} @lang(' Listing?')`);
                $('.listingDeactiveId').val(listingId);
            });

            $(document).on('click', '.listingDeactiveInfo', function () {
                var showlistingDeactiveInfoModal = new bootstrap.Modal(document.getElementById('listingDeactiveInfoModal'))
                showlistingDeactiveInfoModal.show();

                let listingOwner = $(this).data('owner');
                let listingTitle = $(this).data('title');
                let deactiveReason = $(this).data('deactivereason');

                $('.listingOwner').text(`@lang('Owner: ') ${listingOwner}`);
                $('.listingTitle').text(`@lang('Listing: ') ${listingTitle}`);
                $('.deactiveReason').text(`@lang('Deactive Reason: ') ${deactiveReason}`);
            });

            $(document).on('click', '.listingRejectedInfo', function () {
                var showlistingRejectedInfoModal = new bootstrap.Modal(document.getElementById('listingRejectedInfoModal'))
                showlistingRejectedInfoModal.show();

                let listingOwner = $(this).data('owner');
                let listingTitle = $(this).data('title');
                let rejectedReason = $(this).data('rejectedreason');

                $('.listingOwner').text(`@lang('Owner: ') ${listingOwner}`);
                $('.listingTitle').text(`@lang('Listing: ') ${listingTitle}`);
                $('.rejectedReason').text(`@lang('Rejected Reason: ') ${rejectedReason}`);
            });
    </script>

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

            $('select').select2({
                selectOnClose: true
            });
        });
    </script>

    <script>
        "use strict";

        $(document).on('click', '#check-all', function () {
            $(".listing__category__select2").select2({
                width: '100%',
                placeholder: '@lang("Select Categories")',
            });
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $(document).on('change', ".row-tic", function () {
            let length = $(".row-tic").length;
            let checkedLength = $(".row-tic:checked").length;

            if (length == checkedLength) {
                $('#check-all').prop('checked', true);
            } else {
                $('#check-all').prop('checked', false);
            }
        });

        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });

        //Single Approved
        $(document).on('click', '.approved-yes', function (e) {
            var listingId = $('.singleApproved').data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('admin.listingSingleApproved') }}",
                data: {
                    listingId: listingId,
                },
                datatType: 'json',
                type: "POST",
                success: function (data) {
                    location.reload();
                },
            });
        });

        //Single Rejected
        $(document).on('click', '.rejected-yes', function (e) {
            var listingId = $('.singleRejected').data('id');
            var rejectReason = $('#single_reject_reason').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('admin.listingSingleRejected') }}",
                data: {
                    listingId: listingId,
                    rejectReason: rejectReason,
                },
                datatType: 'json',
                type: "POST",
                success: function (data) {
                    location.reload();
                },
            });
        });

        //multiple Approved
        $(document).on('click', '.active-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            var listing = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
                listing.push($(this).attr('data-listing'));
            });

            var strIds = allVals;
            var userListing = listing;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('admin.listing-multiple-approved') }}",
                data: {
                    strIds: strIds,
                    userListing: userListing,
                },
                datatType: 'json',
                type: "POST",
                success: function (data) {
                    location.reload();
                },
            });
        });

        //multiple Rejected
        $(document).on('click', '.inactive-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            var listing = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
                listing.push($(this).attr('data-listing'));
            });

            var strIds = allVals;
            var rejectReason = $('#reject_reason').val();
            var userListing = listing;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('admin.listing-multiple-rejected') }}",
                data: {
                    strIds: strIds,
                    rejectReason: rejectReason,
                    userListing: userListing,
                },
                datatType: 'json',
                type: "POST",
                success: function (data) {
                    location.reload();
                }
            });
        });
    </script>
@endpush
