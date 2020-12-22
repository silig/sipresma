@extends('layouts.auth')

@section('content')
<div class="limiter">
    <div class="container-login100" style="background-image: url('{{ asset('css_login/images/a.jpg') }}');">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                
                @csrf
                <span class="login100-form-logo" >
                    <img src="{{ asset('css_login/images/logo.png') }}" alt="logo undip" style="width:138px;height:138px;">
                </span>
                <span class="login100-form-title p-b-15 p-t-15" style="color: yellow">
                    SIPRESMA FT
                </span>
                <span class="login100-form-title p-b-27 p-t-0" >
                   <h4> Login </h4>
                </span>
                
                @csrf
                @if (session('error'))
                    @alert(['type' => 'danger'])
                        {{ session('error') }}
                    @endalert
                @endif
                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input type="text"
                        name="username" 
                        class="input100 {{ $errors->has('username') ? ' is-invalid' : '' }}" 
                        placeholder="{{ __('Username') }}"
                        value="{{ old('username') }}">
                    <span class="focus-input100"> {{ $errors->first('username') }}</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input type="password" 
                        name="password"
                        class="input100 {{ $errors->has('password') ? ' is-invalid' : '' }} " 
                        placeholder="{{ __('Password') }}">
                    <span class="focus-input100"> {{ $errors->first('password') }}</span>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-90">
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection