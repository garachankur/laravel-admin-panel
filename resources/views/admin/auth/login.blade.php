@extends('admin.layouts.auth')

@push('styles')
<style>
    .error{
        color:red;
    }
    h1{
        color: #202153;
        font-weight: 800;
    }
    body{
        background-color: #202153;
    }
</style>
@endpush

@section('content')
<section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                    <div class="card-title text-center">
                        <div class="p-1">
                            <h1>ADMIN PANEL</h1>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2">
                        <span>Login</span>
                    </p>
                    <div class="card-body pt-0">
                        <form class="form-horizontal" method="POST" action="{{ url('admin/login') }}" id="loginForm">
                            @csrf
                            <fieldset class="form-group floating-label-form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Your Email" autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group mb-1">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Your Password" >
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </fieldset>
                            <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Login</button>
                            <br>
                        <center><a href="{{url('admin/forgotpassword')}}">Forgot password </a></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')

<!-- Jquery Validate -->
<script src="{{ asset('plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/validate/additional-methods.min.js') }}"></script>

<script>
     @if(session("passwordchange"))
        fnToastSuccess("{{session('passwordchange')}}")
    @endif

    $().ready(function() {
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: "Please enter a valid email address",
                password: {
                    required: "Please provide a password"
                }
            }
        });
    });
</script>
@endpush
