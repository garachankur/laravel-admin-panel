@extends('admin.layouts.admin')

@section('content')
<section id="configuration">
    <div class="row">
            {{-- <h1 class="text-center">Welcome to {{ config('app.name') }}</h1> --}}

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card pull-up">
                  <a href="{{url('admin/users')}}">
                    <div class="card-content">
                      <div class="card-body">
                        <div class="media d-flex">
                          <div class="media-body text-left">
                            <h3 class="info">{{$totalUser}}</h3>
                            <h6>Total Users</h6>
                          </div>
                          <div>
                            <i class="icon-user-follow info font-large-2 float-right"></i>
                          </div>
                        </div>
                        {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                          <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div> --}}
                      </div>
                    </div>
                  </a>
                </div>
              </div>



    </div>
</section>
@endsection
