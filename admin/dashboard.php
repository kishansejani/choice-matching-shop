<?php include_once 'header.php'; 

$sql_select_slider = "select * from `slider`";
$data_select = mysqli_query($conn,$sql_select_slider);
$slider_count = mysqli_num_rows($data_select);

$sql_select_products = "select * from `product`";
$data_products = mysqli_query($conn,$sql_select_products);
$products_count = mysqli_num_rows($data_products);

$sql_select_products_stock = "select * from `product` where `stock`='In Stock'";
$data_products_stock = mysqli_query($conn,$sql_select_products_stock);
$products_count_stock = mysqli_num_rows($data_products_stock);

$sql_select_products_out = "select * from `product` where `stock`='Out of Stock'";
$data_products_out = mysqli_query($conn,$sql_select_products_out);
$products_count_out = mysqli_num_rows($data_products_out);

$sql_select_blog = "select * from `blog`";
$data_blog = mysqli_query($conn,$sql_select_blog);
$blog_count = mysqli_num_rows($data_blog);


$sql_select_order = "select * from `order` where `status`='Pending'";
$data_order = mysqli_query($conn,$sql_select_order);
$order_count = mysqli_num_rows($data_order);

$sql_select_order_deli = "select * from `order` where `status`='Delivered'";
$data_order_deli = mysqli_query($conn,$sql_select_order_deli);
$order_count_deli = mysqli_num_rows($data_order_deli);

$sql_select_order_can = "select * from `order` where `status`='Cancelled-By-Supplier' or `status`='Cancelled-By-Client'";
$data_order_can = mysqli_query($conn,$sql_select_order_can);
$order_count_can = mysqli_num_rows($data_order_can);

$cat_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `category`"));
$sub_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `subcategory`"));
$size_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `size`"));
$color_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `color`"));
?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-premium-blue">
              <div class="inner">
                <h3>
                  <?php echo $products_count; ?>
                </h3>

                <p>Total Products Updated</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="view-product.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-premium-blue">
              <div class="inner">
                <h3>
                  <?php echo $products_count_stock; ?>
                </h3>

                <p>Products In-Stock</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="view-product.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-premium-blue">
              <div class="inner">
                <h3>
                  <?php echo $products_count_out; ?>
                </h3>

                <p>Products Out of Stocks</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="view-product.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          


          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-premium-blue">
              <div class="inner">
                <h3>
                  <?php echo $order_count ?>
                </h3>

                <p>New Order Received</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="view-received-order.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-premium-blue">
              <div class="inner">
                <h3>
                  <?php echo $order_count_deli ?>
                </h3>

                <p>Delivered</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="view-all-orders.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-premium-blue">
              <div class="inner">
                <h3>
                  <?php echo $order_count_can ?>
                </h3>

                <p>Cancelled</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="view-all-orders.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-premium-blue">
              <div class="inner">
                <h3>
                  <?php echo $slider_count; ?>
                </h3>

                <p>Sliders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="view-slider.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-premium-blue">
              <div class="inner">
                <h3><?php echo $blog_count; ?></h3>
                <p>Blogs</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="view-blog.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Categories -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-premium-blue">
              <div class="inner">
                <h3><?php echo $cat_count; ?></h3>
                <p>Categories</p>
              </div>
              <div class="icon"><i class="fas fa-list"></i></div>
              <a href="view-category.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Sub-categories -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-premium-blue">
              <div class="inner">
                <h3><?php echo $sub_count; ?></h3>
                <p>Sub-Categories</p>
              </div>
              <div class="icon"><i class="fas fa-list-ul"></i></div>
              <a href="view-subcategory.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Sizes -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-premium-blue">
              <div class="inner">
                <h3><?php echo $size_count; ?></h3>
                <p>Total Sizes</p>
              </div>
              <div class="icon"><i class="fas fa-ruler-combined"></i></div>
              <a href="view-size.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Colors -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-premium-blue">
              <div class="inner">
                <h3><?php echo $color_count; ?></h3>
                <p>Total Colors</p>
              </div>
              <div class="icon"><i class="fas fa-palette"></i></div>
              <a href="view-color.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
<?php include_once 'footer.php'; ?>

  </div>
<!-- ./wrapper -->

<?php include_once 'scripts.php'; ?>


</body>
</html>