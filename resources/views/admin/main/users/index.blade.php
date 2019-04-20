@extends('admin.layouts.admin')

@section('content')
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($module_name) ? $module_name : '' }} List</h4>
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
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push("scripts")

<script>
$(document).ready(function() {
    var oTable = $('#datatable').DataTable({
            "dom": '<"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
            processing: true,
            serverSide: true,
            responsive: true,
            pagingType: "full_numbers",
            "ajax": {
                "url": "{!! $module_route.'/datatable' !!}",
            },
            columns: [

                { data: 'name', name: 'name'},
                { data: 'email', name: 'email'},
                {
                    data:  null,
                    orderable: false,
                    searchable: false,
                    width: 60,
                    render:function(o){
                        var str="";

                        str += "<a href='{{ url("$module_route") }}/" + o.id +"'><i class='fa fa-eye' aria-hidden='true'></i></a>";

                        str +="&nbsp;<a href='{{ $module_route }}/" + o.id + "/edit'><i class='fa fa-edit'></i></a>";

                        str += "&nbsp;<a href='javascript:void(0);' class='deleteRecord' val='" + o.id + "'><i class='fa fa-trash'></i></a> ";

                        return str;
                    }
                }
            ],
            order: [["1", "DESC"]]
    });


    //delete Record
    jQuery(document).on('click', '.deleteRecord', function(event) {
        var id = $(this).attr('val');
        var deleteUrl = "{!!  $module_route  !!}/" + id;
        var isDelete = deleteRecordByAjax(deleteUrl, "{{$module_name}}", oTable);
    });

});
</script>
@endpush
