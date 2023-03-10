
@extends('dashboard.layouts.admin')
@section('title')
{{trans('banners.banners')}}
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title"> {{ trans('banners.banners')}} </h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{ trans('banners.add_banner') }}</a>
                    </li>
                    <li class="breadcrumb-item active"> {{trans('banners.add_banner')}}
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
    <!-- Basic form layout section start -->
    <section id="basic-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form"> {{trans('banners.add_banner')}} </h4>
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
                            action="{{route('banners.store')}}"
                            method="POST"
                            enctype="multipart/form-data">
                              @csrf
                                            @method('post')



                                               <div class="form-body">
                                                <h4 class="form-section">{{ trans('banners.add_banner') }} </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                     
                                                            <input type="file" class="form-control" name="file_name" required>
                                                            @error("file_name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>





                    




                            <br>
                            <div class="form-actions">
                                <button type="button" class="btn btn-warning mr-1"
                                        onclick="history.back();">
                                    <i class="ft-x"></i> {{ trans('banners.back') }}
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> {{ trans('banners.add') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

</section>
<!-- // Basic form layout section end -->
</div>
@stop
