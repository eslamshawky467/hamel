<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Credit Card Payment Form Template | PrepBootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=2.0" />

    <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('font-awesome/css/font-awesome.min.css')}}" />

    <script type="text/javascript" src="{{asset('js/jquery-1.10.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
</head>

<body>
<div class="container">

<div class="page-header">
    <h1 style="text-align:center;">Credit Card Payment Form </h1>
</div>

        <div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <h3 class="text-center">Payment Details</h3>
                        <img class="img-responsive cc-img" src="{{
                        asset('/Visa_Logo ds.png')}}">
                    </div>
                </div>
                <div class="panel-body">
                    
                            <form accept-charset="UTF-8" action="https://api.moyasar.com/v1/payments.html" method="POST">
                            <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                               <input type="hidden" name="callback_url" value=" {{url(route('thanks',$id))}}" />
                                
                                
   <input type="hidden" name="callback_url" value="https://ghazala.efada-academy.com/payments/{{$id}}/thanks/"/>                               
                              <input type="hidden" name="publishable_api_key" value="pk_test_AoRj6RYtNMNjNzYfbPg2YKEA3DH88hgDBuKsbdMt" />
                                <input type="hidden" name="amount" value="{{$cost*100}}" />

                                <input type="hidden" name="source[type]" value="creditcard" />
                               <input type="hidden" name="description" value="Order id 1234 by guest" />
                               <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                  <label>CARD OWNER</label>
                                <input type="text" name="source[name]" class="form-control" placeholder="Card Owner Name" required   />
                                </div>
                                </div>
                                </div>
                                <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>CARD NUMBER</label>
                                    <div class="input-group">
                                        <input  type="number" name="source[number]" class="form-control" placeholder="Valid Card Number"required />
                                        <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                                
                               <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
                                    <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                    <input type="number" class="form-control"name="source[month]"  placeholder="MM" min="1" max="12" required />
                                    <br>
                                       <input type="number" class="form-control"  name="source[year]" placeholder="YY" min="2023" required />
                                </div>
                            </div>   
                             <div class="col-xs-5 col-md-5 float-xs-right">
                                <div class="form-group">
                                    <label>CVC</label>
                                    <input type="number" class="form-control" placeholder="CVC"  name="source[cvc]" max="999" required />
                                </div>
                            </div>
                        </div>
                    <div class="card-footer">
                    <div class="row">
                        <div class="col-xs-12">  

                             <button class="btn btn-success btn-lg btn-block" type="submit">Purchase {{$cost*100}} SAR </button>

   </div>
                    </div>
                </div>
                             </form>
                               </div>
        </div>
    </div>
    <style>
    .cc-img {
        margin: 0 auto;
    }
</style>
</div>
</body>
</html>
                   