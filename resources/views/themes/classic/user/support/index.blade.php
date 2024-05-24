@extends($theme.'layouts.user')
@section('title',__($page_title))
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap-datepicker.css') }}" />
@endpush
@section('content')
    <!-- main -->
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">@lang('My Tickets')</h3>
                </div>
                <!-- search area -->
                <div class="search-bar my-search-bar" >
                    <form action="" method="get" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="input-box input-group">
                                    <input
                                        type="text"
                                        name="ticket"
                                        class="form-control"
                                        placeholder="@lang('ticket no.')"
                                        value="{{ old('ticket',request()->ticket) }}"/>
                                </div>
                            </div>
                            <div class="input-box col-lg-3 col-md-3 col-sm-6">
                                <input type="text" class="form-control datepicker" name="date_time" autofocus="off" readonly placeholder="@lang('choose date')" value="{{ old('date_time',request()->date_time) }}">
                            </div>
                            <div class="input-box col-lg-3 col-md-3 col-sm-6">
                                <select name="status" class="form-control js-example-basic-single">
                                    <option value="">@lang('All Ticket')</option>
                                    <option value="0"
                                            @if(@request()->status == '0') selected @endif>@lang('Open Ticket')</option>
                                    <option value="1"
                                            @if(@request()->status == '1') selected @endif>@lang('Answered Ticket')</option>
                                    <option value="2"
                                            @if(@request()->status == '2') selected @endif>@lang('Replied Ticket')</option>
                                    <option value="3"
                                            @if(@request()->status == '3') selected @endif>@lang('Closed Ticket')</option>
                                </select>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <button class="btn-custom" type="submit">@lang('search')</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
                    <a href="{{route('user.ticket.create')}}" class="btn btn-custom create-ticket-button notiflix-confirm"> <i class="fal fa-plus" aria-hidden="true"></i> @lang('Create Ticket')</a>
                </div>

                <!-- table -->
                <div class="table-parent table-responsive listing-table-parent">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Ticket')</th>
                            <th scope="col">@lang('Subject')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Last Reply')</th>
                            <th scope="col" class="text-end">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tickets as $key => $ticket)
                            <tr>
                                <td data-label="Ticket">
                                     <span
                                         class="font-weight-bold"> [{{ trans('Ticket#').$ticket->ticket }}]
                                     </span>
                                </td>

                                <td data-label="Subject">
                                    <span
                                        class="font-weight-bold"> {{ $ticket->subject }}
                                     </span>
                                </td>

                                <td data-label="Status">
                                    @if($ticket->status == 0)
                                        <span
                                            class="badge rounded-pill bg-success">@lang('Open')</span>
                                    @elseif($ticket->status == 1)
                                        <span
                                            class="badge rounded-pill bg-primary">@lang('Answered')</span>
                                    @elseif($ticket->status == 2)
                                        <span
                                            class="badge rounded-pill bg-warning">@lang('Replied')</span>
                                    @elseif($ticket->status == 3)
                                        <span class="badge rounded-pill bg-dark">@lang('Closed')</span>
                                    @endif
                                </td>

                                <td data-label="Last Reply">
                                    {{diffForHumans($ticket->last_reply) }}
                                </td>

                                <td class="action" data-label="Action">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('user.ticket.view', $ticket->ticket) }}"
                                           class="btn2 btn" title="@lang('Details')" > <i class="fas fa-eye"></i> </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="100%"> @lang('No Data Found')</td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $tickets->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('loadModal')
        <div
            class="modal fade"
            id="delete-modal"
            tabindex="-1"
            aria-labelledby="editModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-top modal-md">
                <div class="modal-content">
                    <div class="modal-header modal-primary modal-header-custom">
                        <h4 class="modal-title" id="editModalLabel">@lang('Delete Confirmation')</h4>
                        <button
                            type="button"
                            class="close-btn"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            <i class="fal fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('Are you sure delete?')
                    </div>
                    <hr>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn-custom btn2"
                            data-bs-dismiss="modal"
                        >
                            @lang('No')
                        </button>
                        <form action="" method="post" class="deleteRoute">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-custom btn-custom-listing-modal">@lang('Yes')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush
@endsection

@push('script')
    <script src="{{ asset('assets/global/js/bootstrap-datepicker.js') }}"></script>
    <script>
        'use strict'
        $(document).ready(function () {
            $( ".datepicker" ).datepicker({
                autoclose: true,
                clearBtn: true
            });
            $('.notiflix-confirm').on('click', function () {
                var route = $(this).data('route');
                $('.deleteRoute').attr('action', route)
            })
        });
    </script>
@endpush
