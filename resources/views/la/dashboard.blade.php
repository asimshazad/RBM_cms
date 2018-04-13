@extends('la.layouts.app')

@section('htmlheader_title') Dashboard @endsection
@section('contentheader_title') Dashboard @endsection
@section('contentheader_description') Organisation Overview @endsection

@section('main-content')

        <section class="content">
          <div class="row">

            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{  $customers }}</h3>
                  <p>Customers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{  url('admin/customers') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>{{  $orders }}</h3>
                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{  url('admin/orders') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{  $employees }}</h3>
                  <p>Employees</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{  url('admin/employees') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{ $expenses }}</h3>
                  <p>Expenses</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{  url('admin/employees') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

          </div>

          <div class="row">
            <section class="col-lg-7 connectedSortable">

           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added Customers</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <ul class="products-list product-list-in-box">

              @if(count($latest_customers))
                @foreach($latest_customers as $customer)
                  <li class="item">

                    <div style="margin-left: 10px;">
                      <a href="{{ url('admin/customers/'.$customer->id) }}" class="product-title">{{$customer->name}}
                        <span class="label label-warning pull-right">{{ $customer->phone}}</span></a>
                      <span class="product-description">
                           {{ $customer->department.'-' }} {{ $customer->city }}
                          </span>
                    </div>
                  </li>
                @endforeach
             @else
                <p>No customers added yet!</p>

             @endif

              </ul>
            </div>
            <div class="box-footer text-center">
              <a href="{{ url('admin/customers') }}" class="uppercase">View All Customers</a>
            </div>
          </div>

            </section>
            <section class="col-lg-5 connectedSortable">

    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
              <ul class="products-list product-list-in-box">

               @if(count($latest_orders))
                @foreach($latest_orders as $order)
                <li class="item">

                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">{{$order->delivery_date}}
                      <span class="label label-warning pull-right">{{ $order->total_amount }}</span></a>
                    <span class="product-description">
                          {{$order->created_at}}
                        </span>
                  </div>
                 </li>
               @endforeach
             @else
                <p>No orders are added yet!</p>

             @endif
              </ul>
            </div>

            <div class="box-footer text-center">
              <a href="{{ url('')}}" class="uppercase">View All Orders</a>
            </div>
            <!-- /.box-footer -->
          </div>

            </section>
          </div>

        </section>
@endsection

@push('styles')
<!-- Morris chart -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/morris/morris.css') }}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/daterangepicker/daterangepicker-bs3.css') }}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

@push('scripts')
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('la-assets/plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('la-assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('la-assets/plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('la-assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('la-assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('la-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('la-assets/plugins/fastclick/fastclick.js') }}"></script>
<!-- dashboard -->
<script src="{{ asset('la-assets/js/pages/dashboard.js') }}"></script>
@endpush

@push('scripts')
<script>
(function($) {
  $('body').pgNotification({
    style: 'circle',
    title: 'Raj By Mansoor',
    message: "Tailor Management System",
    position: "top-right",
    timeout: 0,
    type: "success",
    thumbnail: '<img width="40" height="40" style="display: inline-block;" src="la-assets/img/avatar5.png" data-src="la-assets/img/avatar5.png" data-src-retina="la-assets/img/avatar5.png" alt="">'
  }).show();
})(window.jQuery);
</script>
@endpush