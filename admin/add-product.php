<?php include_once 'header.php';

if (isset($_POST['submit_product']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $tag = isset($_POST['tag']) ? mysqli_real_escape_string($conn, implode(', ', $_POST['tag'])) : '';
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $size = isset($_POST['size']) ? mysqli_real_escape_string($conn, implode(', ', $_POST['size'])) : '';
    $color = isset($_POST['color']) ? mysqli_real_escape_string($conn, implode(', ', $_POST['color'])) : '';
    $one_line_title = mysqli_real_escape_string($conn, $_POST['one_line_title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $dimension = mysqli_real_escape_string($conn, $_POST['dimension']);
    $material = mysqli_real_escape_string($conn, $_POST['material']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);

    $image1 = rand(1,1000000).$_FILES['image1']['name'];
    $image2 = rand(1,1000000).$_FILES['image2']['name'];
    $image3 = rand(1,1000000).$_FILES['image3']['name'];

    $path1 = 'image/'.$image1;
    $path2 = 'image/'.$image2;
    $path3 = 'image/'.$image3;

    move_uploaded_file($_FILES['image1']['tmp_name'],$path1);
    move_uploaded_file($_FILES['image2']['tmp_name'],$path2);
    move_uploaded_file($_FILES['image3']['tmp_name'],$path3);

    $sql_insert = "insert into `product`(`name`,`price`,`category`,`tag`,`type`,`one_line_title`,`size`,`color`, `description`,`weight`,`dimension`,`material`,`image1`,`image2`,`image3`,`stock`)values('$name','$price','$category','$tag','$type','$one_line_title','$size','$color','$description','$weight','$dimension','$material','$image1','$image2','$image3','$stock')";
    mysqli_query($conn,$sql_insert);

    header('location:add-product.php');

}

?>

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
            
                  <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name/Title of Product</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Title of New Photo" name="name" maxlength="40" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" maxlength="50" placeholder="Enter Some Details of New Photo" name="price" maxlength="50" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Category of Product</label>
                    <select class="form-control" name="category" id="categorySelect" required onchange="updateSubcategories()">
                      <option selected disabled>-Select Category of Product-</option>
                      <?php
                      $cat_q = mysqli_query($conn, "SELECT * FROM `category` WHERE status=1 ORDER BY sequence ASC, id DESC");
                      while ($cat_r = mysqli_fetch_assoc($cat_q)) {
                        echo "<option value='{$cat_r['category_name']}' data-id='{$cat_r['id']}'>{$cat_r['category_name']}</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Tag of Product (As per the offer)</label>
                      <div>
                        <input type="checkbox" name="tag[]" value="Best-seller"> Best-seller <br>
                        <input type="checkbox" name="tag[]" value="Featured"> Featured <br>
                        <input type="checkbox" name="tag[]" value="Sale"> Sale <br>
                        <input type="checkbox" name="tag[]" value="Top-rate"> Top-rate <br>
                     </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Type of Product</label>
                    <select class="form-control" name="type" id="typeSelect" required>
                      <option selected disabled>-Select Type of Product-</option>
                    </select>
                  </div>

                  <script>
                    const subcategoryMap = {
                        <?php
                        $cat_q2 = mysqli_query($conn, "SELECT * FROM `category` WHERE status=1 ORDER BY sequence ASC, id DESC");
                        while ($cat_r2 = mysqli_fetch_assoc($cat_q2)) {
                          $sub_q = mysqli_query($conn, "SELECT * FROM `subcategory` WHERE category_id='{$cat_r2['id']}' AND status=1 ORDER BY sequence ASC, id DESC");
                          $subs = [];
                          while ($sub_r = mysqli_fetch_assoc($sub_q)) $subs[] = '"' . $sub_r['subcategory_name'] . '"';
                          echo '"' . $cat_r2['category_name'] . '": [' . implode(',', $subs) . '],';
                        }
                        ?>
                    };

                    function updateSubcategories(selectedType = null) {
                        const category = document.getElementById('categorySelect').value;
                        const typeSelect = document.getElementById('typeSelect');
                        
                        // Clear current options
                        typeSelect.innerHTML = '<option selected disabled>-Select Type of Product-</option>';
                        
                        if (subcategoryMap[category]) {
                            subcategoryMap[category].forEach(sub => {
                                const option = document.createElement('option');
                                option.value = sub;
                                option.textContent = sub;
                                if (sub === selectedType) {
                                    option.selected = true;
                                }
                                typeSelect.appendChild(option);
                            });
                        }
                    }
                  </script>

                  <div class="form-group">
                    <label for="exampleInputFile">Select Avilable Size of Product</label>
                      <div>
                        <?php
                        $size_q = mysqli_query($conn, "SELECT * FROM `size` WHERE status=1 ORDER BY sequence ASC, id DESC");
                        while ($size_r = mysqli_fetch_assoc($size_q)) {
                          echo "<input type='checkbox' name='size[]' value='{$size_r['size_name']}'> {$size_r['size_name']} <br>";
                        }
                        ?>
                     </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Select Available Color of Product</label>
                      <div>
                        <?php
                        $color_q = mysqli_query($conn, "SELECT * FROM `color` WHERE status=1 ORDER BY sequence ASC, id DESC");
                        while ($color_r = mysqli_fetch_assoc($color_q)) {
                          echo "<input type='checkbox' name='color[]' value='{$color_r['color_name']}'> {$color_r['color_name']} <br>";
                        }
                        ?>
                     </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">One Line Title of Product</label>
                    <textarea type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter One Line Title of Product" name="one_line_title" maxlength="100" required></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Description of Product</label>
                    <textarea rows="10" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Description of Product" name="description" maxlength="500" required></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Weight of Product (in KG)</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Weight of Product" name="weight" maxlength="10" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Dimensions of Product (in CM)</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Dimensions of Product" name="dimension" maxlength="20" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Type of Material used in Product</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter type of materail used in product" name="material" maxlength="50" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Image 1 (Main Image)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image1" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                      </div>
                    </div> 
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Image 2</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image2" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                      </div>
                    </div> 
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Image 3</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image3" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                      </div>
                    </div> 
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Stock</label>
                    <select class="form-control" name="stock" required>
                      <option selected disabled>-Select Avilability of Product-</option>
                      <option>In Stock</option>
                      <option>Out of Stock</option>
                    </select>
                  </div>

                <!-- /.card-body -->
           
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit_product">Submit</button>
                </div>


              </form>
            </div>
            <!-- /.card -->
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once 'footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include_once 'scripts.php'; ?>