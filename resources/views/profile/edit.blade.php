@extends('layouts.app')

@section('title', 'Profile Edit')

@section('content')
    <div class="inner-page">
        <h1 class="text-blue">{{ __('profile.greeting') }} {{ auth()->user()->name }}!</h1>
        <div class="page-content">
            <div class="row">
                <div class="col">
                    <div class="card my-3">
                        <div class="card-header">
                            <h3 class="card-title text-blue ">{{ __('profile.block_title') }}</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">

                                <form class="row" method="post" action="{{ route('profile.update', $user->id) }}">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">{{ __('common.label_name') }}</label>
                                            <input type="text"
                                                   name="name"
                                                   class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   id="name"
                                                   required
                                                   value="{{ $user->name }}"
                                                   placeholder="{{ __('common.label_your_name') }}">
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('name') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">{{ __('common.label_email') }}</label>
                                            <input type="email"
                                                   name="email"
                                                   class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   id="email"
                                                   required
                                                   value="{{ $user->email }}"
                                                   placeholder="{{ __('common.label_your_email') }}">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('email') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="first_name">{{ __('common.label_first_name') }}</label>
                                            <input type="text"
                                                   name="first_name"
                                                   class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                                   id="first_name"
                                                   required
                                                   value="{{ $user->first_name }}"
                                                   placeholder="{{ __('common.label_first_name') }}">
                                            @if ($errors->has('first_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('first_name') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="last_name">{{ __('common.label_last_name') }}</label>
                                            <input type="text"
                                                   name="last_name"
                                                   class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                                   id="last_name"
                                                   required
                                                   value="{{ $user->last_name }}"
                                                   placeholder="{{ __('common.label_last_name') }}">
                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('last_name') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="gender">{{ __('common.label_gender') }}</label>
                                            <select name="gender"
                                                    class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}"
                                                    id="gender">
                                                @foreach(['male', 'female'] as $gender)
                                                    <option value="{{ $gender }}">
                                                        {{ __('common.label_gender_option_'.$gender) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('gender'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('gender') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="birth_date">{{ __('common.label_birth_date') }}</label>
                                            <input type="text"
                                                   name="birth_date"
                                                   class="form-control {{ $errors->has('birth_date') ? ' is-invalid' : '' }}"
                                                   id="birth_date"
                                                   required
                                                   value="{{ $user->birth_date ? $user->birth_date->format('Y/m/d') : '' }}"
                                                   placeholder="{{ __('common.label_birth_date') }}">
                                            @if ($errors->has('birth_date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('birth_date') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address">{{ __('common.label_address') }}</label>
                                            <input type="text"
                                                   name="address"
                                                   class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                   id="address"
                                                   required
                                                   value="{{ $user->address }}"
                                                   placeholder="{{ __('common.label_address') }}">
                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('address') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="city">{{ __('common.label_city') }}</label>
                                            <input type="text"
                                                   name="city"
                                                   class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}"
                                                   id="city"
                                                   required
                                                   value="{{ $user->city }}"
                                                   placeholder="{{ __('common.label_city') }}">
                                            @if ($errors->has('city'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('city') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="state">{{ __('common.label_state') }}</label>
                                            <input type="text"
                                                   name="state"
                                                   class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }}"
                                                   id="state"
                                                   required
                                                   value="{{ $user->state }}"
                                                   placeholder="{{ __('common.label_state') }}">
                                            @if ($errors->has('state'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('state') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="zip">{{ __('common.label_zip') }}</label>
                                            <input type="text"
                                                   name="zip"
                                                   class="form-control {{ $errors->has('zip') ? ' is-invalid' : '' }}"
                                                   id="zip"
                                                   required
                                                   value="{{ $user->zip }}"
                                                   placeholder="{{ __('common.label_zip') }}">
                                            @if ($errors->has('zip'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('zip') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="country">{{ __('common.label_country') }}</label>
                                            <input type="text"
                                                   name="country"
                                                   class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}"
                                                   id="country"
                                                   required
                                                   value="{{ $user->country }}"
                                                   placeholder="{{ __('common.label_country') }}">
                                            @if ($errors->has('country'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('country') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label
                                                for="telephone_phone">{{ __('common.label_telephone_phone') }}</label>
                                            <input type="text"
                                                   name="telephone_phone"
                                                   class="form-control {{ $errors->has('telephone_phone') ? ' is-invalid' : '' }}"
                                                   id="telephone_phone"
                                                   required
                                                   value="{{ $user->telephone_phone }}"
                                                   placeholder="{{ __('common.label_telephone_phone') }}">
                                            @if ($errors->has('telephone_phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('telephone_phone') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="mobile_phone">{{ __('common.label_mobile_phone') }}</label>
                                            <input type="text"
                                                   name="mobile_phone"
                                                   class="form-control {{ $errors->has('mobile_phone') ? ' is-invalid' : '' }}"
                                                   id="mobile_phone"
                                                   value="{{ $user->mobile_phone }}"
                                                   placeholder="{{ __('common.label_mobile_phone') }}">
                                            @if ($errors->has('mobile_phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('mobile_phone') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="routing_number">{{ __('common.label_routing_number') }}</label>
                                            <input type="text"
                                                   name="routing_number"
                                                   class="form-control {{ $errors->has('routing_number') ? ' is-invalid' : '' }}"
                                                   id="routing_number"
                                                   value="{{ $user->routing_number }}"
                                                   placeholder="{{ __('common.label_routing_number') }}">
                                            @if ($errors->has('routing_number'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('routing_number') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                   name="newsletter_subscription"
                                                   id="latestVideos" {{ $user->newsletter_subscription ? 'checked' : '' }}>
                                            <label class="form-check-label" for="Check1">
                                                {{ __('common.receive_latest_videos') }}
                                            </label>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="col-md-6 pt-4">
                                        <div class="form-group">
                                            <a class="btn btn-primary btn-width-equal" href="/profile">
                                                {{ __('common.label_back_button') }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-6 text-right pt-4">
                                        <div class="form-group">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-width-equal">
                                                {{ __('common.label_save_button') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
