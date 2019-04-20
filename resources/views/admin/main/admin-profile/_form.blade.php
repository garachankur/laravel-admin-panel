<div class="form-body">
        @if($editProfileType=="profile")
        <div class="form-group row">
            <div class="col-md-12">
                <center>
                        <img src="{{ $result['image_thumb_fullpath'] }}" style="border-radius:50%" height="100" width="100">
                </center>
            </div>
        </div>
        <div class="form-group row {{ ($errors->has('name')) ? 'has-error' : '' }} ">
            <label class="col-md-2 label-control" for="name">Name:</label>
            <div class="col-md-6">
                <div>
                    {{ Form::text('name', null, ['id' => 'name', "placeholder" => "Name", 'class'=>"form-control"]) }}

                </div>
                @if($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
        </div>
        <div class="form-group row {{ ($errors->has('email')) ? 'has-error' : '' }} ">
            <label class="col-md-2 label-control" for="name">Email:</label>
            <div class="col-md-6">
                <div>
                    {{ Form::text('email', null, ['id' => 'email', "placeholder" => "Name", 'class'=>"form-control",'readonly'=>'readonly']) }}

                </div>
                @if($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
        </div>
        <div class="form-group row {{ ($errors->has('image')) ? 'has-error' : '' }} ">
            <label class="col-md-2 label-control" for="category_class">Image:</label>
            <div class="col-md-6">
                <div>
                    {{ Form::file('image', null, ['id' => 'image','class'=>"form-control"]) }}
                </div>
                @if($errors->has('image'))
                    <p class="text-danger">{{ $errors->first('image') }}</p>
                @endif
            </div>
        </div>
        @else
        <div class="form-group row {{ ($errors->has('current_password')) ? 'has-error' : '' }} ">
                <label class="col-md-2 label-control" for="password">Current Password:</label>
                <div class="col-md-6">
                    <div>
                        {{ Form::password('current_password',['id' => 'current_password', "placeholder" => "", 'class'=>"form-control"]) }}

                    </div>
                    @if($errors->has('current_password'))
                        <p class="text-danger">{{ $errors->first('current_password') }}</p>
                    @endif
                </div>
            </div>
        <div class="form-group row {{ ($errors->has('password')) ? 'has-error' : '' }} ">
                <label class="col-md-2 label-control" for="password">New Password:</label>
                <div class="col-md-6">
                    <div>
                        {{ Form::password('password',['id' => 'password', "placeholder" => "", 'class'=>"form-control"]) }}

                    </div>
                    @if($errors->has('password'))
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>
            </div>
        <div class="form-group row {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }} ">
                <label class="col-md-2 label-control" for="password_confirmation">Confirm Password:</label>
                <div class="col-md-6">
                    <div>
                        {{ Form::password('password_confirmation',['id' => 'password_confirmation', "placeholder" => "", 'class'=>"form-control"]) }}

                    </div>
                    @if($errors->has('password_confirmation'))
                        <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>
            </div>
            @endif
    </div>

    @push("scripts")
    {{-- jQuery Validate --}}
    <script src="{{ asset('plugins/validate/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('plugins/validate/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#form_validate").validate({
                ignore: [],
                errorElement: 'p',
                errorClass: 'text-danger',
                normalizer: function( value ) {
                    return $.trim( value );
                },
                rules: {
                    name: {
                        required: true,
                    },
                    email:{
                        required: true,
                        email:true
                    },
                    image: {
                        required: false,
                        accept:"image/*"
                    },
                    password:{
                        required: true,
                    },
                    current_password:{
                        required: true,
                    },
                    password_confirmation:{
                        equalTo : "#password",
                 },
                },
                messages:{
                    name: {required:"Name is required"},
                    email: {
                            required:"Email is required",
                            'email': 'Email is not valid'
                            },
                     password_confirmation:{
                            equalTo:'Password and confirm password not match'
                    },
                    passowrd:{required:"Password is required"},
                    current_password:{required:"Current Password is required"},
                     image:{accept:"accept only image types"}
                    },
            });
        });
    </script>
    @endpush
