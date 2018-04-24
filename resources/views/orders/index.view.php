<!-- Main Header -->
<?php include realpath(__DIR__ . '/../partials/header.view.php') ?>
        <!-- Left side column. contains the logo and sidebar -->
       <?php if ($user->isAdmin()) {           include realpath(__DIR__ . '/../partials/sidebar.view.php');       }?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content container-fluid">
            <?php if (pdcsession('error') != null) { ?>
            <ul class="alert alert-danger" style="list-style-type: none">
                      <li><?php echo pdcsession('error') ?></li>
              </ul>
            <?php } ?>
            <?php if (pdcsession('error') != null) { ?>
            <ul class="alert alert-success" style="list-style-type: none">
                      <li><?php echo pdcsession('error') ?></li>
              </ul>
            <?php } ?>

            <?php if (isset($orders)) {
                 foreach($orders as $order) {
                    ?>
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
                    <td><a href="/orders/<?= $order->id;?>">PDC-OR<?=$order->id?></a></td>
                    <td>Item</td>
                    <td><span class="label label-<?= $order->delivered ? 'success' : 'info' ?>"><?= $order->delivered ? 'Shipped' : 'processing' ?></span></td>
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
            <?php if ($order->delivered == 0) { ?>
              <a href="/orders/<?=$order->id?>/delivered" class="btn btn-sm btn-info btn-flat pull-left">Mark as Delivered</a>
            <?php } ?>
              <a href="/orders/<?=$order->id?>" class="btn btn-sm btn-default btn-flat pull-right">View Order</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

            <?php
                }
            } ?>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
       <?= include realpath(__DIR__ . '/../partials/footer.view.php') ?>
