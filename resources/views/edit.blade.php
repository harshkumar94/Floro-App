@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Form') }}</div>

                <div class="card-body">
                    <form method="POST" action="/users/{{$user->id}}" id="myForm">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('UserName') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{$user->username}}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="password" disabled  required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="password" disabled  required>
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="first-name" class="col-md-4 col-form-label text-md-right">{{ __('First Name' ) }}</label>

                            <div class="col-md-6">
                                <input id="first-name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last-name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name' ) }}</label>

                            <div class="col-md-6">
                                <input id="last-name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}"required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address' ) }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ $user->address }}"required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="house-no" class="col-md-4 col-form-label text-md-right">{{ __('House Number' ) }}</label>

                            <div class="col-md-6">
                                <input id="house-no" type="text" class="form-control" name="house_number" value="{{ $user->house_number }}"required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postal-code" class="col-md-4 col-form-label text-md-right">{{ __('Postal code' ) }}</label>

                            <div class="col-md-6">
                                <input id="postal-code" type="text" class="form-control" name="postal_code" value="{{ $user->postal_code }}"required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City' ) }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ $user->city }}"required>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="telephone-number" class="col-md-4 col-form-label text-md-right">{{ __('Telephone Number' ) }}</label>

                            <div class="col-md-6">
                                <input id="telephone-number" type="text" class="form-control" name="telephone_number" value="{{ $user->telephone_number }}"required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="active">Active</label>

                            <div class="col-md-2">
                                <input type="checkbox" class="form-control" id="active" name="active">
                            </div>            
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                                <button type="button" onclick="clearForm()" class="btn btn-primary">
                                    {{ __('Reset') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function clearForm() {
if(document.getElementById) {
document.myForm.reset();
}
}
</script>
@endsection
