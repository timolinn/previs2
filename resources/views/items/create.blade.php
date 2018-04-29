 <!-- Main Header -->
       @extends('layouts.main')



        @section('content')
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content container-fluid">
            @if ($message = session('error'))
                        <ul class="alert alert-danger" style="list-style-type: none">
                      <li>{{ $message }} </li>
              </ul>
            @endif
            @if ($message = session('success'))
            <ul class="alert alert-success" style="list-style-type: none">
                      <li>{{ $message }} </li>
              </ul>
            @endif
<div class="col-md-10 col-md-offset-1">
        <div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">New Item.</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form action="/items/create" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}
    <div class="box-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Name of Item</label>
        <input type="text" class="form-control" name="name" id="" placeholder="Enter item name">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">sku.</label> <em>Optional</em>
        <input type="text" class="form-control" name="sku" placeholder="Short Product Description">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Price per item (in naira)</label>
        <input type="number" class="form-control" name="price" placeholder="Enter price of product">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Item Categories.</label> <em>Optional</em>
        <input type="text" class="form-control" name="category" id="" placeholder="Enter Category">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Number of items in stock</label>
        <input type="number" class="form-control" name="number_in_stock" placeholder="Enter number of products available">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Description.</label>
        <input type="text" class="form-control" name="description" placeholder="Short Product Description">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Percent Discount.</label>
        <input type="text" class="form-control" name="discount" placeholder="Short Product Description">
      </div>

      <div class="form-group">
        <label for="exampleInputFile">Product Image</label>
        <input type="file" name="image" id="exampleInputFile">

        <p class="help-block">Image size not more than <strong>1mb.</strong></p>
      <!-- </div>
      <div class="checkbox">
        <label>
          <input name="send_copy_email" type="checkbox"> Send me a copy
        .</label>
      </div> -->
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>
</div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @stop
