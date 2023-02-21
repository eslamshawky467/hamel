

@extends('dashboard.loginlayout')
@section('content')

<body style="background-color: rgb(240, 238, 238);">
<div class="container text-center my-5 mb-3 " style="margin-top: 50%";>
<div class="row mt-3 pt-5">
    <div class="col-12 col-sm-8 col-md-6 m-auto ">

        <div class="card w-75 AdminCard ">
            <h5 class="mt-4"
                style="font-family: Verdana, Geneva, Tahoma, sans-serif ; color:#012970; font-weight: 700;">
                {{trans('dashboard.admin')}}</h5>

            <div class="text-center mt-4 p-3">
                <img class=" img-fluid  w-25" src="{{asset("icon.jpg")}}" alt="">

            </div>
            <div class="card-body ">

<form action="{{ route('login') }}" method="post">

    @csrf

    <span
    @if (\Session::has('message'))>
        <h5 style="color: red; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            <li>{!! \Session::get('message') !!}</li>
            </h5>
            @endif

    </span>


    <div class="align-items-center">


            <span  @error('email')   >
                <h5 style="color: red; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                    {{ $message }}
                    </h5>

                @enderror
            </span>
            <span  @error('password')   >
                <h5 style="color: red; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                    {{ $message }}
                    </h5>
                @enderror
            </span>

        <div class="form-group" >
            {{-- <span class="text-danger">@error('email'){{ $message }}@enderror</span>  --}}
            <input type="hidden" value="{{$type}}" name="type">
            <input class="form-control my-3 py-2 w-75 mx-auto" type="text" name="email" placeholder="{{trans('dashboard.email')}}" value="{{ old('email') }}">


                                        </div>

        <div class="form-group">
        <input type="password" class="form-control py-2 w-75 mx-auto" name="password" placeholder="{{trans('dashboard.password')}}" value="{{ old('password') }}">

    </div>
    <button class="btn AdminBtn text-cente  w-30" style="background-color: #012970 ; color: #fff; border-radius: 10px">{{trans('dashboard.login')}}</button>
    </div>






</form>


</div>

</div>



</div>


</div>
</div>















@endsection
{{--

    <body style="background-color: rgb(240, 238, 238);">



    <div class="container">
        <div class="row mt-5 pt-5 text-center">
            <div class="col-12 col-sm-8 col-md-6 m-auto ">

                <div class="card w-75 AdminCard ">
                    <h5 class="mt-3"
                        style="font-family: Verdana, Geneva, Tahoma, sans-serif ; color:#012970; font-weight: 700;">
                        admin
                        dashboard</h5>

                    <div class="text-center mt-4 p-3">
                        <img class=" img-fluid  w-25" src="imgs/icon.jpg">

                    </div>
                    <div class="card-body ">


                        <form action="" class="adminForm">
                            <div class="align-items-center">

                                <input class=" form-control  my-4 py-2 mx-auto w-75  " type="email"
                                    placeholder="Email ">
                                <h5 style="color: red; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                    the
                                    selected email
                                    is invalid</h5>
                                <input class="form-control my-4 py-2 w-75 mx-auto" type="password"
                                    placeholder="Password">
                                <h5 style="color: red; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                    the
                                    selected email
                                    is invalid</h5>
                            </div>

                            <div class="text-center">

                                <button class="btn AdminBtn w-25">Login</button>

                            </div>

                        </form>


                    </div>

                </div>



            </div>


        </div>

    </div>

















</body>
/*admin login */
.adminIcone {
    width: 150px;
    height: 80px;
}


#exampleCheck1 {
    text-align: center;

}

.AdminCard {
    height: 570px;
    text-align: center;

    font-size: 35px;

    -webkit-box-shadow: 0px 10px 49px -14px rgba(114, 110, 110, 0.7);
    -moz-box-shadow: 0px 10px 49px -14px rgba(101, 111, 175, 0.7);
    box-shadow: 0px 10px 49px -14px rgba(58, 37, 100, 0.7);
    line-height: 100px;
    color: #fff;
    font-family: Verdana, Geneva, Tahoma, sans-serif;

}

.AdminBtn {
    background-color: #012970;
    color: white;
    border-radius: 10px;

}

.AdminBtn:hover {

    color: white;

}

/*end admin login */

























    --}}
