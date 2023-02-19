@extends('dashboard.layouts.admin')
@section('title')
    {{ __('dash.cfreateab') }}
@endsection
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"> {{ __('dash.ghazala') }} </h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active"> {{ __('dash.cfreateab') }}
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
                            <h4 class="card-title" id="basic-layout-form"> {{ __('dash.cfreateab') }} </h4>
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
                                      action="{{ route('about_us_store') }}"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('post')



                                    <div class="form-body">
                                        <h4 class="form-section"><i class="ft-home"></i>{{ __('dash.cfreateab') }} </h4>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1"> {{ __('dash.title_ar') }}
                                                    </label>
                                                    <input type="text" name="title_ar" autofocus class="form-control" value="{{ old('title_ar',$about->title_ar) }}" required>
                                                    @error("title_ar")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('dash.title_en') }}
                                                    </label>
                                                    <input type="text" name="title_en" autofocus class="form-control" value="{{ old('title_en',$about->title_en) }}" required>
                                                    @error("title_en")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('dash.description_ar') }}
                                                    </label>
                                                    <textarea name="description_ar" autofocus class="form-control"  required>{{ old('description_ar',$about->description_ar) }}</textarea>
                                                    @error("description_ar")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('dash.description_en') }}
                                                    </label>
                                                    <textarea name="description_en" autofocus class="form-control"  required>{{ old('description_en',$about->description_en) }}</textarea>
                                                    @error("description_en")
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


































