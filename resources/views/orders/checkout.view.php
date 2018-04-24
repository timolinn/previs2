 <!-- Main Header -->
 <?php include realpath(__DIR__ . '/../partials/header.view.php') ?>
        <!-- Left side column. contains the logo and sidebar -->
       <?php if ($user->isAdmin()) {           include realpath(__DIR__ . '/../partials/sidebar.view.php');       }?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content container-fluid">
            <?php if ($message = pdcsession('error')) : ?>
                        <ul class="alert alert-danger" style="list-style-type: none">
                      <li><?php echo $message ?></li>
              </ul>
            <?php endif; ?>
            <?php if ($message = pdcsession('success')) { ?>
            <ul class="alert alert-success" style="list-style-type: none">
                      <li><?php echo $message ?></li>
              </ul>
            <?php } ?>
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
                  <?php foreach($cartitems as $cItem) { ?>
                  <tr>
                    <td><a href="/orders/<?= $order->id;?>">#</a></td>
                    <td><?=$cItem->name?></td>
                    <td><span class="label label-info"><?= $cItem->quantity ?></span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20"><?=$cItem->price?></div>
                    </td>
                    <td><?= $cItem->price * $cItem->quantity ?></td>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            <form action="/orders/create" method="post">
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

        <!-- Main Footer -->
       <?= include realpath(__DIR__ . '/../partials/footer.view.php') ?>
