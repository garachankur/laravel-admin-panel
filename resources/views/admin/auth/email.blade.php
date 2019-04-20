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
                            <h1>LARAVEL ADMIN PANEL</h1>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2">
                        <span>Forgot Password</span>
                    </p>
                    <div class="card-body pt-0">
                        <form class="form-horizontal" id="passwordforgot" method="post" action="{{ url('admin/forgotpasswordset') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{$token}}">
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
                            <fieldset class="form-group floating-label-form-group mb-1">
                                <label for="confirm_password">Confirm Password</label>
                                <input id="confirm_password" type="password" class="form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" name="confirm_password" placeholder="Your Password" >
                                @if ($errors->has('confirm_password'))
                                    <span class="invalid-feedback text-danger">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                @endif
                            </fieldset>
                            <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Forgot Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push("scripts")

<script src="{{ asset('plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/validate/additional-methods.min.js') }}"></script>
<script>
    @if(session("emailerror"))
    fnToastError("{{session('emailerror')}}")
    @endif

    $(document).ready(function(){

      $("#passwordforgot").validate({
         rules: {
            password:"required",
             email:{
                required:true,
                email:true,
            },
            confirm_password:{
                equalTo : "#password",
                required:true
            },

        },
        messages:{
            email: {
                    required:"Email is required",
                    'email': 'Email is not valid'
                    },
            password:{required:"Password is reqired"},
            confirm_password:{
                required:"Confirm password is reqired",
                equalTo:'Password and confirm password not match'
            },
        }
    });
})
</script>
@endpush
