@extends('admin.layouts.app')
@section('title')
    @lang("Storages")
@endsection

@section('content')
    <style>
        .fa-ellipsis-v:before {
            content: "\f142";
        }
    </style>
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('No.')</th>
                        <th scope="col">@lang('Storage')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($storages as $key => $item)

                        <tr>
                            <td data-label="@lang('No.')">{{loopIndex($storages) + $loop->index}}</td>
                            <td data-label="@lang('Storage')">
                                <div class="float-left">
                                    <a href="#" target="_blank">
                                        <img src="{{ getFile($item->driver,config('location.storage.path'). $item->logo )}}" alt="{{ __($item->name) }}" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    @lang(($item->name))
                                </div>
                            </td>

                            <td data-label="@lang('Status')">
                                @if($item->status == 1)
                                    <span class="badge badge-pill bg-success text-white">@lang('Active')</span>
                                @else
                                    <span class="badge badge-pill bg-danger text-white">@lang('Inactive')</span>
                                @endif
                            </td>

                            <td data-label="@lang('Action')">
                                @if($item->code == 'local' && $item->status == 1)
                                    <span class="ml-2">--</span>
                                @else
                                    <div class="dropdown show ">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            @if($item->code != 'local')
                                                <a class="dropdown-item" href="{{ route('admin.storage.edit',$item->id)}}">
                                                    <i class="fas fa-edit"></i>  @lang('Edit')
                                                </a>
                                            @endif

                                            @if($item->status != 1)
                                                <a href="javascript:void(0)"
                                                   data-route="{{route('admin.storage.setDefault',$item->id)}}"
                                                   data-toggle="modal"
                                                   data-target="#set-modal"
                                                   class="notiflix-confirm dropdown-item" aria-labelledby="dropdownMenuLink"><i class="fas fa-thumbtack"></i> @lang('Set as default')
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="100%">@lang('No Data Found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $storages->links('partials.pagination') }}
            </div>
        </div>
    </div>

    @push('adminModal')
        <div id="set-modal" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="primary-header-modalLabel">@lang('Confirmation')
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>@lang('Are you sure to set this?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-dismiss="modal">@lang('Close')</button>
                        <form action="" method="post" class="setRoute">
                            @csrf
                            @method('post')
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
                $('.setRoute').attr('action', route)
            })

            $('.from_date').on('change', function (){
                $('.to_date').removeAttr('disabled')
            });

        });
    </script>
@endpush
