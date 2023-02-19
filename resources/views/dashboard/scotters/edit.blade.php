@extends('dashboard.layouts.admin')
@section('title')
  {{ __('dash.editscotter') }} 
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
                                 {{ __('dash.editscotter') }} </h4>
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



                        <div class="card-content collapse show">
                            <div class="card-body">

                                <form class="form"
                                      action="{{ route('scotters.update',$scotter->id) }}"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')



                                    <div class="form-body">
                                        <h4 class="form-section"><i class="ft-home"></i>{{ __('dash.editscotter') }} </h4>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1"> {{ __('dash.location') }}
                                                    </label>
                                                    <input type="text" class="form-control" placeholder="Location" value="{{old('location',$scotter->location)}}" name="location">
                                                    @error("location")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('dash.lang') }}
                                                    </label>
                                                    <input type="text" class="form-control" placeholder="Lang" value="{{old('lang',$scotter->lang)}}" name="lang">
                                                    @error("lang")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('dash.qrcode') }}
                                                    </label>
                                                    <input type="text" class="form-control" placeholder="qrcode" value="{{old('qrcode',$scotter->qrcode)}}" name="qrcode">
                                                    @error("qrcode")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('dash.lat') }}
                                                    </label>
                                                    <input type="text" class="form-control" placeholder="Lat" value="{{old('lat',$scotter->lat)}}" name="lat">
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
                                                            <option value="{{$scotter->status}}">{{$scotter->status}}
                                                        </option>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">inActive</option>
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
                                                <i class="la la-check-square-o"></i> {{ __('dash.edit') }}
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


































