<!-- Main Header -->
<?php include realpath(__DIR__ . '/../partials/header.view.php') ?>
        <!-- Left side column. contains the logo and sidebar -->
       <?php if ($user->isAdmin()) {           include realpath(__DIR__ . '/../partials/sidebar.view.php');       }?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content container-fluid">
            <?php if ($message = pdcsession('error')) { ?>
            <ul class="alert alert-danger" style="list-style-type: none">
                      <li><?php echo $message ?></li>
              </ul>
            <?php } ?>
            <?php if ($message = pdcsession('success')) : ?>
            <ul class="alert alert-success" style="list-style-type: none">
                      <li><?php echo $message ?></li>
              </ul>
            <?php endif; ?>
            <div class="col-md-12">
            <?php if ($user->isAdmin()) { ?>
                <a href="/items/create" class="btn btn-flat  btn-success" >+ New Item</a>
            <?php } ?>
                </div>
                <br><br>

            <?php if (isset($items)) {
                foreach($items as $item) {
                    ?>
            <div class="col-md-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('<?= assetload($item->image_path) ?>') center center;height:250px;">
              <!-- <h3 class="widget-user-username">Elizabeth Pierce</h3> -->
              <!-- <h5 class="widget-user-desc">Web Designer</h5> -->
            </div>
            <div class="widget-user-image">

            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li style="padding:3%;" ><a href="/items/<?=$item->id?>"><?= $item->item_name ?></a></li>
                <li style="padding:3%;">Price <span class="pull-right badge bg-aqua">₦ <?= $item->item_price ?></span></li>
                <li style="padding:3%;"><?= $item->description ?></span></li>
                <li style="padding:2%;">
                    <div class="row">
                <div class="col-xs-2">
                  <input type="number" class="form-control" value="1" id="item<?=$item->id?>" name="i_quantity">
                </div>
                <a href="#"  style="padding:2%;" id="addCart" data-iid="<?=$item->id?>" class="btn pull-left label bg-aqua">+ Add to Cart</a>
                <?php if ($user->isAdmin()) { ?>
                    <a href="/items/<?= $item->id ?>/edit" style="padding:2%;margin-right:15px;" class="btn pull-right label bg-aqua">Edit</a>
                <?php } ?>
                </li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
            <?php
                }
            } ?>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    <script>
        const itemDetails = document.querySelectorAll('#item');
        console.log(itemDetails);

        const addcart = document.querySelectorAll('#addCart');

        addcart.forEach(function(cart) {

        cart.addEventListener('click', function(e) {
            e.preventDefault();
        const item = this.dataset.iid;
        const quantity = document.querySelector(`#item${this.dataset.iid}`).value;
        fetch(`/carts/${item}/${quantity}/create`, {
                method: 'GET',
                credentials: 'same-origin',
                mode:  'same-origin'
            }).then(res => res.json())
            .catch(err => {
                if (err.error != undefined)
                    alert(err.error);
                console.error(err);
            }).then(response => {
                if (response.success != undefined) {
                    alert(response.success);
                    const cartBadge = document.querySelector("#cartCount");
                    cartBadge.innerText = parseInt(cartBadge.innerText) + 1;
                }
                console.log((response));
            });
        });
        });

    </script>
        <!-- Main Footer -->
       <?= include realpath(__DIR__ . '/../partials/footer.view.php') ?>
