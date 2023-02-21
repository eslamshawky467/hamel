@extends('dashboard.layouts.admin')
@section('title')
   {{ __('dash.create_scotter') }}
@endsection
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"> {{ __('dash.ghazala') }} </h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active"> {{ __('dash.scotter') }}
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('scotters.index')}}">{{ __('dash.scotters') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Basic form layout section start -->
        <section id="basic-form-layouts">

            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form"> 
                            {{ __('dash.create_scotter') }} </h4>
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


  @if(session()->has('delete'))
                                <div class="alert alert-danger  text-center alert-dismissible fade show" role="alert">
                                    <strong>{{ session()->get('delete') }}</strong>
                                    </button>
                                </div>
                            @endif
                            @if(session()->has('edit'))
                            <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                                <strong>{{ session()->get('Add') }}</strong>
                                </button>
                            </div>
                        @endif
                             @if(session()->has('Add'))
                                <div class="alert alert-success  text-center alert-dismissible fade show" role="alert">
                                    <strong>{{ session()->get('Add') }}</strong>
                                    </button>
                                </div>
                            @endif



















                        <div class="card-content collapse show">
                            <div class="card-body">

                                <form class="form"
                                      action="{{ route('scotters.store') }}"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('post')



                                    <div class="form-body">
                                        <h4 class="form-section"><i class="ft-home"></i>{{ __('dash.create_scotter') }} </h4>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1"> {{ __('dash.location') }}
                                                    </label>
                                                    <input type="text" class="form-control"  value="{{old('location')}}" placeholder="Location" name="location">
                                                    @error("location")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('dash.lang') }}
                                                    </label>
                                                    <input type="text" class="form-control"  value="{{old('lang')}}" placeholder="Lang" name="lang">
                                                    @error("lang")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ __('dash.qrcode') }}
                                                </label>
                                                <input type="text" class="form-control"   value="{{old('qrcode')}}" placeholder="qrcode" name="qrcode">
                                                @error("qrcode")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                           </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('dash.lat') }}
                                                    </label>
                                                    <input type="text" class="form-control"  value="{{old('lat')}}" placeholder="Lat" name="lat">
                                                    @error("lat")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('dash.status') }}
                                                    </label>
                                                    <select  class="form-control" name="status">
                                                        <option value="active">{{ __('dash.active') }}</option>
                                                        <option value="inactive">{{ __('dash.inactive') }}</option>

                                                    </select>
                                                    @error("status")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> {{ __('dash.back') }}
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{ __('dash.save') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@stop


































