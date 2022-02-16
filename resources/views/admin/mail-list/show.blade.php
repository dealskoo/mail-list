@extends('admin::layouts.panel')
@section('title',__('mail-list::mail-list.view_mail'))
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{ __('admin::admin.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('mail-list::mail-list.view_mail') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('mail-list::mail-list.view_mail') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="first_name"
                                       class="form-label">{{ __('mail-list::mail-list.first_name') }}</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       value="{{ $email->first_name }}" autofocus tabindex="1" readonly>
                            </div>
                        </div>
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="last_name"
                                       class="form-label">{{ __('mail-list::mail-list.last_name') }}</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       value="{{ $email->last_name }}" tabindex="2" readonly>
                            </div>
                        </div>
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('mail-list::mail-list.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                       value="{{ $email->email }}" tabindex="3" readonly>
                            </div>
                        </div>
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="email_verified_at"
                                       class="form-label">{{ __('mail-list::mail-list.email_verified_at') }}</label>
                                <input type="text" class="form-control" id="email_verified_at" readonly
                                       name="email_verified_at"
                                       value="{{ \Carbon\Carbon::parse($email->email_verified_at)->format('m/d/Y') }}"
                                       tabindex="4">
                            </div>
                        </div>
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="tag" class="form-label">{{ __('mail-list::mail-list.tag') }}</label>
                                <input type="text" class="form-control" id="tag" name="tag" readonly
                                       value="{{ $email->tag }}" tabindex="5">
                            </div>
                        </div>
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="country_id"
                                       class="form-label">{{ __('mail-list::mail-list.country') }}</label>
                                <input type="text" class="form-control" id="country_id" name="country_id" readonly
                                       value="{{ $email->country->name }}" tabindex="6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
