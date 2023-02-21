@extends('dashboard.accounts.pending_datatable')
@section('title')
    {{trans('admin.home') }}
@endsection
@section('content')
    {{-- <div class="app-content content"> --}}
    {{-- <div class="content-wrapper"> --}}
    <div class="content-header row">
        @if(session()->has('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('delete') }}</strong>
                </button>
            </div>
        @endif
        @if(session()->has('Add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add') }}</strong>
                </button>
            </div>
        @endif
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"> {{trans('admin.home') }} </h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{trans('admin.home') }}</a>
                        </li>
                        <li class="breadcrumb-item active"> {{trans('admin.home') }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- DOM - jQuery events table -->
        <section id="dom">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{trans('admin.accounts') }}</h4>
                            <a class="heading-elements-toggle"><i
                                    class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>

                        {{-- @include('dashboard.includes.alerts.success')
                        @include('dashboard.includes.alerts.errors') --}}

                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table table-bordered yajra-datatable">
                                        <thead>
                                        <tr>
                                            <th>{{trans('admin.user_id')}} </th>
                                            <th> {{trans('admin.name')}}   </th>
                                            <th> {{trans('admin.identity_card')}}   </th>
                                            <th> {{trans('admin.phone_number')}}  </th>
                                            <th> {{trans('admin.email')}} </th>
                                            <th>{{trans('admin.amount')}} </th>
                                            <th>{{trans('admin.status')}}</th>
                                            <th> {{trans('admin.Action')}}</th>

                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop









