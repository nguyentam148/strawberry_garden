@extends('website.layouts.master')
@section('pageTitle', 'Khôi phục mật khẩu')

@section('content')
    <!-- SECTION FORGOT PASSWORD
				================================================== -->
    <section id="forgot_password" class="page-section grey-section big-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 mt-100 mt-md-80 mt-sm-60 text-center">
                    <h2 class="font-face1 section-heading fw800 mt-0 text-center">Khôi phục mật khẩu</h2>
                    <div class="form-subscribe">
                        @if(session()->has('successMsg'))
                            <h6>{{ session('successMsg') }}</h6>
                        @elseif($student)
                            <form class="account-form" id="forgot_password_form"
                                  action="{{ route('website.students.reset_password', $token) }}" method="POST">

                                @csrf

                                <div class="form-group">
                                    <input type="password" placeholder="Mật khẩu"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" value="{{ old('password') }}">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <input type="password" placeholder="Nhập lại mật khẩu"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation" value="{{ old('password_confirmation') }}">

                                    <div class="text-right">
                                        <button type="submit" class="btn bg-white" title="Gửi email">Lưu lại
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <h6>Yêu cầu đổi mật khẩu không tồn tại hoặc đã hết hạn.</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
