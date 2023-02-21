@extends('dashboard.layouts.admin')
@section('title')
    {{ trans('admin.index') }}
@endsection
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"> {{ trans('admin.home') }} </h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{ trans('admin.home') }}</a>
                        </li>
                        <li class="breadcrumb-item active"> {{ trans('admin.home') }}
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
                            <h4 class="card-title" id="basic-layout-form"> {{ trans('admin.create') }} </h4>
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
                                      action="{{route('admins.store')}}"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <div class="form-body">
                                    <h4 class="form-section"><i class="ft-home"></i>{{ trans('admin.create') }} </h4>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> {{ trans('admin.name') }}
                                                </label>
                                                <input type="text" id="name"
                                                       class="form-control"
                                                       placeholder=""
                                                       value="{{old('name')}}"
                                                       name="name">
                                                @error("name")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">{{ trans('admin.email') }}
                                            </label>
                                            <input type="text" id="name"
                                                   class="form-control"
                                                   placeholder=""
                                                   value="{{old('email')}}"
                                                   name="email">
                                            @error("email")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                       <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">{{ trans('admin.password') }}
                                            </label>
                                            <input type="text" id="name"
                                                   class="form-control"
                                                   placeholder=""
                                                   name="password">
                                            @error("password")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    </div>
                                        <br>
                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> {{ trans('admin.canceled') }}
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{ trans('admin.submit') }}
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
    <!-- // Basic form layout section end -->
    </div>
@stop


































