@push("styles")
@endpush

<div class="form-body">
    <div class="form-group row {{ ($errors->has('name')) ? 'has-error' : '' }} ">
        <label class="col-md-2 label-control" for="name">Name:</label>
        <div class="col-md-6">
            <div>
                {{ Form::text('name', null, ['id' => 'name', "placeholder" => "Enter name", 'class'=>"form-control"]) }}
            </div>
            @if($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
    </div>
    <div class="form-group row {{ ($errors->has('email')) ? 'has-error' : '' }} ">
        <label class="col-md-2 label-control" for="email">Email:</label>
        <div class="col-md-6">
            <div>
                {{ Form::text('email', null, ['id' => 'email', "placeholder" => "Enter email", 'class'=>"form-control"]) }}
            </div>
            @if($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>
    </div>

</div>

@push("scripts")
{{-- jQuery Validate --}}
<script src="{{ asset('plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/validate/additional-methods.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {

        var result = @JSON((isset($result)) ? $result : []);


        $("#form_validate").validate({
            ignore: [],
            errorElement: 'p',
            errorClass: 'text-danger',
            normalizer: function( value ) {
                return $.trim( value );
            },
            rules: {
                name:{
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
            }
        });
    });
</script>
@endpush
