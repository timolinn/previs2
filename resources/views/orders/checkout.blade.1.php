 <!-- Main Header -->
 @extends('layouts.main')

        @section('content')
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content container-fluid">
            @if ($message = session('error'))
                        <ul class="alert alert-danger" style="list-style-type: none">
                      <li>{{ $message }}</li>
              </ul>
            @endif
            @if ($message = session('success'))
            <ul class="alert alert-success" style="list-style-type: none">
                      <li>{{ $message }}</li>
              </ul>
            @endif
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
                    <th>#</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($cartitems as $cItem)
                  <tr>
                    <td><a href="/orders/{{ $cItem->id}}">#</a></td>
                    <td>{{$cItem->name}}</td>
                    <td><span class="label label-info">{{ $cItem->qty }}</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">{{$cItem->price}}</div>
                    </td>
                    <td>{{ $cItem->price * $cItem->qty }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            <form action="/orders/create" method="post">
            {{ csrf_field() }}
            <div class="col-xs-2">

              <button href="/orders/create" class="btn btn-sm btn-info btn-flat pull-left">Place Order</button>
                </div>
                </form>
              <a href="/items" class="btn btn-sm btn-default btn-flat pull-right">Back To Items</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @stop
