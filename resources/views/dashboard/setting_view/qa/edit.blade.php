@extends('dashboard.layouts.admin')
@section('title')
    {{ __('dash.edit_qa') }}
@endsection
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"> {{ __('dash.ghazala') }} </h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active"> {{ __('dash.settings') }}
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('qa.index')}}">{{ __('dash.qa') }}</a>
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
                            <h4 class="card-title" id="basic-layout-form"> {{ __('dash.edit_qa') }} </h4>
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
                                      action="{{ route( 'qa.edit') }}"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    {{--                                    @method('PUT')--}}



                                    <div class="form-body">
                                        <h4 class="form-section"><i class="ft-home"></i>{{ __('dash.edit_qa') }} </h4>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1"> {{ __('dash.q_ar') }}
                                                    </label>
                                                    <input type="text" name="title_ar" autofocus class="form-control" value="{{ old('title_ar',$qa->title_ar) }}" required>
                                                    <input type="hidden" name="id" autofocus  value="{{ $qa->id }}" required>
                                                    @error("title_ar")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('dash.q_en') }}
                                                    </label>
                                                    <input type="text" name="title_en" autofocus class="form-control" value="{{ old('title_en',$qa->title_en) }}" required>
                                                    @error("title_en")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('dash.a_ar') }}
                                                    </label>
                                                    <textarea name="description_ar" autofocus class="form-control"  required>{{ old('description_ar',$qa->description_ar) }}</textarea>
                                                    @error("description_ar")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">{{ __('dash.a_en') }}
                                                    </label>
                                                    <textarea name="description_en" autofocus class="form-control"  required>{{ old('description_en',$qa->description_en) }}</textarea>
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


































