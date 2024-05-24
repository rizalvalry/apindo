@extends('admin.layouts.app')
@section('title')
    @lang("Contact Messages")
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
                        <div class="col-md-4 col-xl-4 col-sm-12">
                            <div class="form-group">
                                <label for="title"> @lang('From Date')</label>
                                <input type="date" class="form-control from_date" name="from_date" id="datepicker" placeholder="@lang('From date')" value="{{ old('from_date', request()->from_date) }}"/>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4 col-sm-12">
                            <div class="form-group">
                                <label for="title"> @lang('To Date')</label>
                                <input type="date" class="form-control to_date" name="to_date" id="datepicker" placeholder="@lang('To date')" value="{{ old('to_date', request()->to_date) }}" disabled="true"/>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4 col-sm-12">
                            <div class="form-group">
                                <label></label>
                                <button type="submit" class="btn w-100 w-md-auto btn-primary listing-btn-search-custom mt-2"><i
                                        class="fas fa-search"></i> @lang('Search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <tr>
                    <thead class="thead-dark">
                        <th>@lang('#')</th>
                        <th>@lang('From')</th>
                        <th>@lang('To')</th>
                        <th>@lang('Message')</th>
                        <th>@lang('Date-Time')</th>
                        @if(adminAccessRoute(config('role.contact_message.access.view')) == true || adminAccessRoute(config('role.contact_message.access.delete')) == true)
                            <th class="text-end">@lang('Action')</th>
                        @endif
                    </thead>
                    </tr>
                    <tbody>
                    @forelse($allMessages as $key => $message)
                        <tr>
                            <td data-label="@lang('No.')">{{loopIndex($allMessages) + $key}}</td>
                            <td data-label="@lang('From')">
                                <div class="float-left">
                                    <a href="{{ route('admin.user-edit', optional($message->get_client)->id) }}" target="_blank">
                                        <img src="{{getFile(optional($message->get_client)->driver, optional($message->get_client)->image)}}"
                                            alt="{{config('basic.site_title')}}" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    @lang(optional($message->get_client)->firstname) @lang(optional($message->get_client)->lastname) <br>
                                    @lang(optional($message->get_client)->email)
                                </div>
                            </td>

                            <td data-label="@lang('To')">
                                <div class="float-left">
                                    <a href="{{ route('admin.user-edit', optional($message->get_user)->id) }}" target="_blank">
                                        <img src="{{ getFile(optional($message->get_user)->driver, optional($message->get_user)->image) }}"
                                            alt="{{config('basic.site_title')}}" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    @lang(optional($message->get_user)->firstname) @lang(optional($message->get_user)->lastname) <br>
                                    @lang(optional($message->get_user)->email)
                                </div>

                            </td>

                            <td data-label="@lang('Message')">@lang(\Illuminate\Support\Str::limit($message->message, 50))</td>
                            <td data-label="@lang('Date-Time')">{{ dateTime($message->created_at) }}</td>
                            @php
                                $from = optional($message->get_client)->firstname . ' ' . optional($message->get_client)->lastname;
                                $to = optional($message->get_user)->firstname . ' ' . optional($message->get_user)->lastname;
                            @endphp
                            @if(adminAccessRoute(config('role.contact_message.access.view')) == true || adminAccessRoute(config('role.contact_message.access.delete')) == true)
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-sm rounded btn-icon edit_button notiflix-confirm showContactMessage"
                                            data-toggle="modal" data-target="#myModal" data-from="{{ $from }}" data-to="{{ $to }}" data-message="{{ $message->message }}" data-time="{{ dateTime($message->created_at) }}">
                                            <i class="fa fa-eye"></i>
                                    </button>
                                    @if(adminAccessRoute(config('role.contact_message.access.delete')) == true)
                                        <button type="button" class="btn btn-outline-danger btn-sm rounded btn-icon edit_button notiflix-confirm"
                                                data-toggle="modal" data-target="#deleteModal"
                                                data-route="{{route('admin.contactMessageDelete',$message->id)}}">
                                                <i class="fa fa-trash-alt"></i>
                                        </button>
                                    @endif
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
                {{$allMessages->appends($_GET)->links('partials.pagination')}}
            </div>
        </div>
    </div>

    @push('adminModal')
        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="myModalLabel">@lang('Message Information')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <form role="form" method="POST" class="actionRoute" action="" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item messageFrom"></li>
                                <li class="list-group-item messageTo"></li>
                                <li class="list-group-item contactMessage"></li>
                                <li class="list-group-item contactDateTime"></li>
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

        <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
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
    @endpush
@endsection

@push('js')
    <script>
        'use strict'
        $('.notiflix-confirm').on('click', function () {
            var route = $(this).data('route');
            $('.deleteRoute').attr('action', route)
        })

        $('.from_date').on('change', function (){
            $('.to_date').removeAttr('disabled')
        });
    </script>

    <script>
        "use strict";
        (function ($) {
            $(document).on('click', '.showContactMessage', function () {
                var showMessageModal = new bootstrap.Modal(document.getElementById('messageModal'))
                showMessageModal.show()

                let from = $(this).data('from');
                let to = $(this).data('to');
                let message = $(this).data('message');
                let dateTime = $(this).data('time');

                $('.messageFrom').text(`@lang('From: ') ${from}`);
                $('.messageTo').text(`@lang('To: ') ${to}`);
                $('.contactMessage').text(`@lang('Message: ') ${message}`);
                $('.contactDateTime').text(`@lang('Date-Time: ') ${dateTime}`);

            });
        })(jQuery);

    </script>
@endpush
