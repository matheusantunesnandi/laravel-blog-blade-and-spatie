@extends('layouts.head')

@section('title', 'Login')

<section class="vh-100" style="background-color: gray">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-4">

                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">

                        <div class="col d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <h1 class="mb-4 text-center">{{ config('app.name') }}</h1>

                                <form action=" {{ url('/login') }}" method="POST">
                                    @csrf

                                    <h5 class="fw-normal mb-3 pb-3">
                                        Sign into your account
                                    </h5>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="email">
                                            Email address
                                        </label>

                                        <input type="email" id="email" class="form-control form-control-lg"
                                            name="email" required />

                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="password">
                                            Password
                                        </label>

                                        <input type="password" id="password" class="form-control form-control-lg"
                                            name="password" required />

                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    @if ($errorMessage = Session::get('error'))
                                        <span class="text-danger">{{ $errorMessage }}</span>
                                    @endif

                                    <div class="pt-1 mb-4">
                                        <button data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-dark btn-lg btn-block" type="submit">
                                            Login
                                        </button>
                                    </div>

                                    <p class="mb-5 pb-lg-2">
                                        Don't have an account? <a href="{{ url('/register') }}">Register here</a>
                                    </p>

                                    <p class=" pb-lg-2">
                                        <a href="{{ url('/') }}">Back home</a>
                                    </p>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@include('layouts.footer')