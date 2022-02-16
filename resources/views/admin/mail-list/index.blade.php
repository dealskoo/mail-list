@extends('admin::layouts.panel')
@section('title',__('mail-list::mail-list.mail-lists'))
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{ __('admin::admin.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('mail-list::mail-list.mail-lists') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('mail-list::mail-list.mail-lists') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->canDo('mail-lists.create'))
                        <div class="row mb-2">
                            <div class="col-12">
                                <a href="{{ route('admin.mail-lists.create') }}" class="btn btn-danger mb-2"><i
                                        class="mdi mdi-plus-circle me-2"></i> {{ __('mail-list::mail-list.add_mail') }}
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="mail-lists_table" class="table table-centered w-100 dt-responsive nowrap">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('mail-list::mail-list.id') }}</th>
                                <th>{{ __('mail-list::mail-list.first_name') }}</th>
                                <th>{{ __('mail-list::mail-list.last_name') }}</th>
                                <th>{{ __('mail-list::mail-list.email') }}</th>
                                <th>{{ __('mail-list::mail-list.email_verified_at') }}</th>
                                <th>{{ __('mail-list::mail-list.tag') }}</th>
                                <th>{{ __('mail-list::mail-list.country') }}</th>
                                <th>{{ __('mail-list::mail-list.created_at') }}</th>
                                <th>{{ __('mail-list::mail-list.updated_at') }}</th>
                                <th>{{ __('mail-list::mail-list.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            let table = $('#mail-lists_table').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('admin.mail-lists.index') }}",
                "language": language,
                "pageLength": pageLength,
                "columns": [
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': false},
                ],
                "order": [[0, "desc"]],
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                    $('#mail-lists_table tr td:nth-child(10)').addClass('table-action');
                    delete_listener();
                }
            });
        });
    </script>
@endsection
