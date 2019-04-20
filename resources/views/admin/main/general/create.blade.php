@extends('admin.layouts.admin')
@section('content')

<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add {{ isset($module_name) ? $module_name : '' }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">

                        {!! Form::open(['url' => $module_route, 'method' => 'POST', "enctype"=>"multipart/form-data",'class'=>'m-form m-form--fit m-form--label-align-right','id'=>'form_validate', 'autocomplete'=>'off']) !!}
                        @csrf
                            @include("$moduleView._form")

                            <div class="form-actions center">
                                <a href="{{ isset($editProfileType) ? url('admin/dashboard'):$module_route }}" class="btn btn-danger mr-1">
                                    <i class="ft-x"></i> Cancel
                                </a>

                                <button type="submit" class="btn btn-success">
                                    <i class="la la-check-square-o"></i> Save
                                </button>
                            </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
