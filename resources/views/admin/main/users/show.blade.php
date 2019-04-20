@extends('admin.layouts.admin')

@section('content')
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($module_name) ? $module_name : '' }} Detail</h4>
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
                    <div class="card-body card-dashboard">

                        <div class="jumbotron" style="background-color:white;border: 1px solid #000;">
                                <table class="table table-borderless table-hover">
                                        <tr>
                                            <td><b> Name:</b></td>
                                            <td>{{ $result->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Email:</b></td>
                                            <td>{{ $result->email }}</td>
                                        </tr>
                                    </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
