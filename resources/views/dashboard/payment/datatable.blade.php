<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="{{ app() -> getLocale() === 'ar' ? 'rtl' : 'ltr'}}">
<head>
    @include('dashboard.layouts.head')
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<!-- fixed-top-->

@include('dashboard.layouts.header')

<!-- ////////////////////////////////////////////////////////////////////////////-->

@include('dashboard.layouts.sidebar')



<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Revenue, Hit Rate & Deals -->

            @yield('content')
            <!-- Analytics map based session -->
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('dashboard.layouts.footer')
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></sc>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.1/i18n/ar.json"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.2.1/js/dataTables.fixedColumns.min.js"></script>

<script src=" https://code.jquery.com/jquery-3.5.1.js"></script>

<script src=" https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>



<script type="text/javascript">
    $(function () {
        var table = $('.yajra-datatable').DataTable({


            processing: true,
            serverSide: true,
            pageLength: 50,
            language:{
                "emptyTable":     "{{trans('datatable.General.emptyTable')}}",
                "sLengthMenu": "{{trans('admin.menu')}}",
                "infoEmpty":      "{{trans('datatable.General.infoEmpty')}}",
                "infoFiltered":   "{{trans('datatable.General.infoFiltered')}}",
                "sInfo": "{{trans('admin.filter')}}"   ,
                "loadingRecords": "{{trans('datatable.General.loadingRecords')}}",
                "processing":     "{{trans('datatable.General.processing')}}",
                "search":         "{{trans('datatable.General.search')}}",
                "searchPlaceholder": "{{trans('datatable.General.searchPlaceholder')}}",
                "zeroRecords":    "{{trans('datatable.General.zeroRecords')}}",
                "oPaginate": {
                    "sFirst": "{{trans('admin.first')}}",
                    "sPrevious": "{{trans('admin.last')}}",
                    "sNext": "{{trans('admin.next')}}",
                    "sLast": "{{trans('admin.slast')}}"
                }

            },
            ajax: "{{ route('success.pay') }}",
            columns: [
                {data: 'client', name: 'clients.name'},
                {data: 'id_number', name: 'clients.id_number'},
                {data: 'phonenumber', name: 'clients.phonenumber'},
                {data: 'email', name: 'clients.email'},
                {data: 'pay_status', name: 'pay_status'},
                {data: 'created_at', name: 'created_at'},
                  {data: 'price', name: 'price'},
                {data: 'trip_id', name: 'trip_id'},
                   
            ],
            order: [[0, 'desc']],
        });

    });
</script>
</html>