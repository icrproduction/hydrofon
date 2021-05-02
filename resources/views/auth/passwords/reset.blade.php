@extends('layouts.app')

@section('content')
    <div class="w-full h-full flex flex-col items-center justify-center">
        <div class="w-full sm:w-1/2 md:w-1/3">
            <h1 class="mb-4">Password Reset</h1>

            <form method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="label" for="email">E-mail</label>
                    <input id="email" type="email" name="email" class="field" value="{{ $email ?? old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <div class="help-block">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="mb-4{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="label" for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Password" class="field" class="field" required>

                    @if ($errors->has('password'))
                        <div class="help-block">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="mb-6{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="label" for="password-confirm">Confirm password</label>
                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm password" class="field" required>

                    @if ($errors->has('password_confirmation'))
                        <div class="help-block">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>

                <div>
                    <x-forms.button>
                        Reset password
                    </x-forms.button>
                </div>
            </form>
        </div>
    </div>
@endsection
