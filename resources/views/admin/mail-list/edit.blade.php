@extends('admin::layouts.panel')
@section('title',__('mail-list::mail-list.edit_mail'))
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{ __('admin::admin.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('mail-list::mail-list.edit_mail') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('mail-list::mail-list.edit_mail') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.mail-lists.update',$email) }}" method="post">
                        @csrf
                        @method('PUT')
                        @if(!empty(session('success')))
                            <div class="alert alert-success">
                                <p class="mb-0">{{ session('success') }}</p>
                            </div>
                        @endif
                        @if(!empty($errors->all()))
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <p class="mb-0">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="first_name"
                                           class="form-label">{{ __('mail-list::mail-list.first_name') }}</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           value="{{ old('first_name',$email->first_name) }}" autofocus tabindex="1"
                                           placeholder="{{ __('mail-list::mail-list.first_name_placeholder') }}">
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="last_name"
                                           class="form-label">{{ __('mail-list::mail-list.last_name') }}</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                           value="{{ old('last_name',$email->last_name) }}" tabindex="2"
                                           placeholder="{{ __('mail-list::mail-list.last_name_placeholder') }}">
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('mail-list::mail-list.email') }}</label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                           value="{{ old('email',$email->email) }}" tabindex="3"
                                           placeholder="{{ __('mail-list::mail-list.email_placeholder') }}">
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="email_verified_at"
                                           class="form-label">{{ __('mail-list::mail-list.email_verified_at') }}</label>
                                    <input type="text" class="form-control date" id="email_verified_at"
                                           name="email_verified_at" data-single-date-picker="true"
                                           data-toggle="date-picker"
                                           value="{{ old('email_verified_at',\Carbon\Carbon::parse($email->email_verified_at)->format('m/d/Y')) }}"
                                           tabindex="4"
                                           placeholder="{{ __('mail-list::mail-list.email_verified_at_placeholder') }}">
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="tag" class="form-label">{{ __('mail-list::mail-list.tag') }}</label>
                                    <input type="text" class="form-control" id="tag" name="tag"
                                           value="{{ old('tag',$email->tag) }}" tabindex="5"
                                           placeholder="{{ __('mail-list::mail-list.tag_placeholder') }}">
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="country_id"
                                           class="form-label">{{ __('mail-list::mail-list.country') }}</label>
                                    <select id="country_id" name="country_id" class="form-control select2"
                                            data-toggle="select2" tabindex="6">
                                        @foreach($countries as $country)
                                            @if($email->country_id == $country->id)
                                                <option value="{{ $country->id }}"
                                                        selected>{{ $country->name }}</option>
                                            @else
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success mt-2" tabindex="7"><i
                                    class="mdi mdi-content-save"></i> {{ __('admin::admin.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
