<!-- Main Header -->
@extends('layouts.main')



        @section('content')
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content container-fluid">
            @if (session('error') != null)
            <ul class="alert alert-danger" style="list-style-type: none">
                      <li>{{ session('error') }}</li>
              </ul>
            @endif
            @if (session('error') != null)
            <ul class="alert alert-success" style="list-style-type: none">
                      <li>{{ session('error') }}</li>
              </ul>
            @endif

            @isset($orders)
              @foreach($orders as $order)
                      <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>total Price</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="/orders/{{ $order->id}}">PDC-OR{{$order->id}}</a></td>
                    <td>Item</td>
                    <td><span class="label label-{{ $order->delivered ? 'success' : 'info' }}">{{ $order->delivered ? 'Shipped' : 'processing' }}</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">50000</div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            @if ($order->delivered == 0)
              <a href="/orders/{{$order->id}}/delivered" class="btn btn-sm btn-info btn-flat pull-left">Mark as Delivered</a>
            @endif
              <a href="/orders/{{$order->id}}" class="btn btn-sm btn-default btn-flat pull-right">View Order</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

            @endforeach
            @else
            <div class="box box-info">
              <div class="box-body">
                  <h1>No Orders Yet</h1>
              </div>
            </div>
            @endisset
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @stop
