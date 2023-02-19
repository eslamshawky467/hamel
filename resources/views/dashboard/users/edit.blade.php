@extends('dashboard.layouts.admin')
@section('title')
{{ trans('users.updateclient') }}
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title"> {{ trans('users.updateclient')}} </h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{trans('users.dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item active"> {{ trans('users.updateclient')}}
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
                        <h4 class="card-title" id="basic-layout-form"> {{ trans('users.updateclient')}} </h4>
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
                            action="{{route('Users.client.update',$users->id)}}"
                            method="POST"
                            enctype="multipart/form-data">
                              @csrf
                                            @method('post')
                                               <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i>{{ trans('users.updateclient')}}</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> {{trans('users.name') }}
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   value="{{$users->name}}"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{trans('users.id_number')}}
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   value="{{$users->id_number}}"
                                                                   name="id_number">
                                                            @error("id_number")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class='row'>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('users.email') }}
                                                        </label>
                                                        <input type="text" id="name"
                                                               class="form-control"
                                                               placeholder=""
                                                               value="{{ $users->email }}"
                                                               name="email">
                                                        @error("email")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ trans('users.phonenumber') }}
                                                        </label>
                                                        <input type="text" id="name"
                                                               class="form-control"
                                                               placeholder=""
                                                               value="{{$users->phonenumber}}"
                                                               name="phonenumber">
                                                        @error("phonenumber")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                    </div>

<div class='row'>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">{{ trans('users.status') }}
                                            </label>
                                            <select  class="form-control pro-edt-select form-control-primary" name="status">
                                                <option type="hidden" value="{{$users->status}}">
                                                    @if($users->status == 'active')
                                                    active
                                                    @elseif($users->status == 'inactive')
                                                         inactive
                                                    @endif

                                                </option>
                                                <option value="active">active</option>
                                                <option value="inactive"> inactive</option>


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
                                    <i class="ft-x"></i> {{ trans('users.back') }}
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> {{trans('users.edit') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            
</section>
<!-- // Basic form layout section end -->
</div>
@stop


































