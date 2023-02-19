@extends('dashboard.layouts.admin')
@section('title')
Home Page
@endsection
@section('content')
<a class="btn btn-danger" href="{{ URL::to('/info/pdf') }}"> {{trans('admin.pdf')}}</a>
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="info">{{App\Models\Client::count()}}</h3>
                      <h6>{{trans('dashboard.clients')}}</h6>
                    </div>
                      <div>
                          <i class="icon-user-follow success font-large-2 float-right"></i>
                      </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="warning">{{App\Models\Scotter::count()}}</h3>
                      <h6>{{trans('dashboard.scotter')}}</h6>
                    </div>
                    <div>
                      <i class="icon-pie-chart warning font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%"
                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="success">{{App\Models\Trip::where('trip_status','finished')->count()}}</h3>
                      <h6>{{trans('dashboard.finished')}}</h6>
                    </div>
                      <div>
                          <i class="icon-basket-loaded info font-large-2 float-right"></i>
                      </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="danger">{{App\Models\Trip::where('trip_status','in-trip')->count()}}</h3>
                      <h6>{{trans('dashboard.in_trip')}}</h6>
                    </div>
                      <div>
                          <i class="icon-basket-loaded info font-large-2 float-right"></i>
                      </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%"
                    aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    <!-- Base style table -->
        <section id="base-style">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">{{trans('dashboard.clients')}}</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <p class="card-text"></p>
                    <table class="table table-striped table-bordered base-style">
                      <thead>
                        <tr>

                            <th>{{trans('users.name')}} </th>
                            <th>{{trans('users.email')}}</th>
                            <th>{{trans('dashboard.phone')}}</th>
                            <th>{{trans('users.status')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($users as $user )
                          <tr class="bg-success bg-lighten-5">
                              <td>{{$user->name}}</td>
                              <td>{{$user->email}}</td>
                              <td>{{$user->phonenumber}}</td>
                              <td>{{$user->status}}</td>

                          </tr>
                      @endforeach
                      </tbody>
                      <tfoot>

                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--/ Base style table -->

  <!-- Base style table -->
{{--        <section id="base-style">--}}
{{--          <div class="row">--}}
{{--            <div class="col-12">--}}
{{--              <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                  <h4 class="card-title">{{__('admin/home.comments table')}} </h4>--}}
{{--                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>--}}
{{--                  <div class="heading-elements">--}}
{{--                    <ul class="list-inline mb-0">--}}
{{--                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
{{--                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>--}}
{{--                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
{{--                      <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
{{--                    </ul>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="card-content collapse show">--}}
{{--                  <div class="card-body card-dashboard">--}}
{{--                    <p class="card-text"></p>--}}
{{--                    <table class="table table-striped table-bordered base-style">--}}
{{--                      <thead>--}}
{{--                        <tr>--}}
{{--                            <th>{{__('admin/home.id')}}</th>--}}
{{--                            <th>{{__('admin/home.user name')}}</th>--}}
{{--                            <th>{{__('admin/home.user comment')}}</th>--}}
{{--                        </tr>--}}
{{--                      </thead>--}}
{{--                      <tbody>--}}
{{--                            <tr>--}}
{{--                            <td> <div class="custom-control">1</div></td>--}}
{{--                            <td class="w-25"><small class="text-muted">Samar Elsayed</small></td>--}}
{{--                            <td class="w-25"><small class="text-muted">هذا الكورس جيد جدا</small></td>--}}
{{--                          </tr>--}}
{{--                      </tbody>--}}
{{--                      <tfoot>--}}

{{--                      </tfoot>--}}
{{--                    </table>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </section>--}}
{{--        <!--/ Base style table -->--}}

{{--  <!-- Base style table -->--}}
{{--        <section id="base-style">--}}
{{--          <div class="row">--}}
{{--            <div class="col-12">--}}
{{--              <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                  <h4 class="card-title">{{__('admin/home.courses table')}} </h4>--}}
{{--                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>--}}
{{--                  <div class="heading-elements">--}}
{{--                    <ul class="list-inline mb-0">--}}
{{--                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
{{--                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>--}}
{{--                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
{{--                      <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
{{--                    </ul>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="card-content collapse show">--}}
{{--                  <div class="card-body card-dashboard">--}}
{{--                    <p class="card-text"></p>--}}
{{--                    <table class="table table-striped table-bordered base-style">--}}
{{--                      <thead>--}}
{{--                        <tr>--}}
{{--                            <th>{{__('admin/home.id')}}</th>--}}
{{--                            <th>{{__('admin/home.instructor name')}}</th>--}}
{{--                            <th>{{__('admin/home.instructor course')}}</th>--}}
{{--                        </tr>--}}
{{--                      </thead>--}}
{{--                      <tbody>--}}

{{--                          <tr>--}}
{{--                            <td> <div class="custom-control">1</div></td>--}}
{{--                            <td class="w-25"><small class="text-muted">Samar Elsayed</small></td>--}}
{{--                            <td class="w-25 "> <img style='height:80px;width:150px;margin-top:15px;'src='{{ loadFiles('images.jpeg')}}'></td>--}}
{{--                          </tr>--}}
{{--                      </tbody>--}}
{{--                      <tfoot>--}}

{{--                      </tfoot>--}}
{{--                    </table>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </section>--}}
        <!--/ Base style table -->
@endsection