 <!-- Main Header -->
 @extends('layouts.main')



        @section('content')
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content container-fluid">
            @if (session('error'))
            <ul class="alert alert-danger" style="list-style-type: none">
                      <li>{{ session('error') }}</li>
              </ul>
            @endif
            @if (session('error'))
            <ul class="alert alert-success" style="list-style-type: none">
                      <li>{{ session('error') }}</li>
              </ul>
            @endif
            <div class="row">
  <div class="col-md-6">
<div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">items List and Details</h3>
      <a href="/items" class="pull-right btn label-primary">All items</a>
      <span class="pull-right" style="padding:5px;">  </span>
      <a href="/items/create" class="pull-right btn label-success">+ New item</a>
    </div>

    <!-- /.box-header -->
    <div class="box-body no-padding">
      <table class="table table-condensed">
        <tr>
          <th>Details</th>
          <th>Values</th>
        </tr>
          <tr>
              <td>item Name</td>
              <td>{{ $itemm->get('item_name')  }}</td>
          </tr>

          <tr>
              <td>item Price</td>
              <td>{{ $itemm->get('item_price')  }}</td>
          </tr>

          <tr>
              <td>item Category</td>
              <td>{{ $itemm->get('item_category')  }}</td>
          </tr>

          <tr>
              <td>item Description</td>
              <td>{{ $itemm->get('description')  }}</td>
          </tr>
      </table>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  </div>
  <!-- .col-md-6 -->
  </div>
  <div class="col-md-6">
      <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">{{ $itemm->get('item_name')  }}</h3>
          <!-- /.box-header -->
          </div>

          <div class="box-body no-padding text-center">
            <!-- QRCDOE HERE!!!  -->
            @if ($itemm->get('image_path'))
              <img src="{{ asset($itemm->get('image_path'))  }}" alt="{{ $itemm->get('item_name')  }}">
            @else
             <h3> No Image yet</h3>
              <a href="/items/{{$itemm->get('id')}}/edit" class="btn label bg-maroon">Upload</a>
              <br><br><br>
            @endif
          </div>
  </div>
  <!-- .row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @stop
