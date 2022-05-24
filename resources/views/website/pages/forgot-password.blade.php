@extends('website.layouts.master')
@section('pageTitle', 'Quên mật khẩu')

@section('content')
    <!-- SECTION FORGOT PASSWORD
				================================================== -->
    <section id="forgot_password" class="page-section grey-section big-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 mt-100 mt-md-80 mt-sm-60 text-center">
                    <h2 class="font-face1 section-heading fw800 mt-0 text-center">Quên mật khẩu</h2>
                    <div class="form-subscribe">
                        @if(session()->has('successMsg'))
                            <h6>{{ session('successMsg') }}</h6>
                        @else
                            <form class="account-form" id="forgot_password_form"
                                  action="{{ route('website.students.forgot_password') }}" method="POST">

                                @csrf

                                <div class="form-group">
                                    <input type="email" placeholder="Email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <div class="text-right">
                                        <button type="submit" class="btn bg-white" title="Gửi email">Gửi email</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
