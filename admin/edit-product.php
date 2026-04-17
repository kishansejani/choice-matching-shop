<?php include_once 'header.php';

if (isset($_GET['e_id']))
{
    $edit_id = $_GET['e_id'];
}

$sql_select = "select * from `product` where `id`='$edit_id'";
$data = mysqli_query($conn,$sql_select);
$row = mysqli_fetch_assoc($data);

$tag = explode(', ',$row['tag']);
$tag_length = count($tag);

$size = explode(', ',$row['size']);
$size_length = count($size);

$color = explode(', ',$row['color']);
$color_length = count($color);


if (isset($_POST['edited_product']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $tag = mysqli_real_escape_string($conn, implode(', ',$_POST['tag']));
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $size = mysqli_real_escape_string($conn, implode(', ',$_POST['size']));
    $color = mysqli_real_escape_string($conn, implode(', ',$_POST['color']));
    $one_line_title = mysqli_real_escape_string($conn, $_POST['one_line_title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $dimension = mysqli_real_escape_string($conn, $_POST['dimension']);
    $material = mysqli_real_escape_string($conn, $_POST['material']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);

    $image1_e = $_FILES['image1']['name'];
    if ($image1_e=="")
    {
        $image1=$row['image1'];
    }
    else
    {
        if(file_exists('image/'.$row['image1'])) {
            unlink('image/'.$row['image1']);
        }

        $image1 = rand(1,1000000).$_FILES['image1']['name'];
        $path1 = 'image/'.$image1;
        move_uploaded_file($_FILES['image1']['tmp_name'],$path1);
    }

    $image2_e = $_FILES['image2']['name'];
    if ($image2_e=="")
    {
        $image2=$row['image2'];
    }
    else
    {
        if(file_exists('image/'.$row['image2'])) {
            unlink('image/'.$row['image2']);
        }

        $image2 = rand(1,1000000).$_FILES['image2']['name'];
        $path2 = 'image/'.$image2;
        move_uploaded_file($_FILES['image2']['tmp_name'],$path2);
    }

    $image3_e = $_FILES['image3']['name'];
    if ($image3_e=="")
    {
        $image3=$row['image3'];
    }
    else
    {
        if(file_exists('image/'.$row['image3'])) {
            unlink('image/'.$row['image3']);
        }

        $image3 = rand(1,1000000).$_FILES['image3']['name'];
        $path3 = 'image/'.$image3;
        move_uploaded_file($_FILES['image3']['tmp_name'],$path3);
    }


    $sql_update = "update `product` set `name`='$name',`price`='$price',`category`='$category',`tag`='$tag',`type`='$type',`one_line_title`='$one_line_title',`size`='$size',`color`='$color',`description`='$description',`weight`='$weight',`dimension`='$dimension',`material`='$material',`image1`='$image1',`image2`='$image2',`image3`='$image3',`stock`='$stock' where `id`='$edit_id'";
    mysqli_query($conn,$sql_update);

    $sql_update_cart = "update `cart` set `name`='$name',`price`='$price',`image`='$image1' where `product_id`='$edit_id'";
    mysqli_query($conn,$sql_update_cart);

    header('location:view-more-product.php?v_id='.$row['id']);

} 

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark font-weight-bold">Edit Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="view-product.php">Products</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <!-- Full width column for premium look -->
          <div class="col-md-10">
            <div class="card card-primary card-outline shadow-lg rounded-lg border-0" style="border-top: 4px solid var(--brand-red);">
              <div class="card-header bg-white border-bottom-0 pb-0">
                <h3 class="card-title font-weight-bold" style="color: var(--brand-red);"><i class="fas fa-edit mr-2"></i> Update Product Details</h3>
              </div>
              <hr class="mt-3 mb-0">

              <form method="post" enctype="multipart/form-data">
                <div class="card-body p-4">
                  
                  <h5 class="mb-3 text-muted border-bottom pb-2">Basic Info</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Product Name/Title <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-tag"></i></span></div>
                          <input type="text" class="form-control" name="name" maxlength="40" required value="<?php echo htmlspecialchars(@$row['name']); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Price (₹) <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-rupee-sign"></i></span></div>
                          <input type="number" class="form-control" name="price" required value="<?php echo htmlspecialchars(@$row['price']); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Stock Status <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-boxes"></i></span></div>
                          <select class="form-control" name="stock" required>
                            <option value="In Stock" <?php if($row['stock']=="In Stock"){echo "selected";} ?>>In Stock</option>
                            <option value="Out of Stock" <?php if($row['stock']=="Out of Stock"){echo "selected";} ?>>Out of Stock</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>One Line Meta Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="one_line_title" maxlength="100" required value="<?php echo htmlspecialchars($row['one_line_title']); ?>">
                      </div>
                    </div>
                  </div>

                  <h5 class="mt-4 mb-3 text-muted border-bottom pb-2">Categories & Attributes</h5>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Category <span class="text-danger">*</span></label>
                        <select class="form-control" name="category" id="categorySelect" required onchange="updateSubcategories()">
                          <option value="Daily Wear Junction" <?php if($row['category']=="Daily Wear Junction"){echo "selected";} ?>>Daily Wear Junction</option>
                          <option value="Printed Cotton" <?php if($row['category']=="Printed Cotton"){echo "selected";} ?>>Printed Cotton</option>
                          <option value="Ready Made" <?php if($row['category']=="Ready Made"){echo "selected";} ?>>Ready Made</option>
                          <option value="Silk Material" <?php if($row['category']=="Silk Material"){echo "selected";} ?>>Silk Material</option>
                          <option value="Work Material" <?php if($row['category']=="Work Material"){echo "selected";} ?>>Work Material</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Sub-Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="type" id="typeSelect" required>
                          <option selected disabled>-Select Type of Product-</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Material <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="material" maxlength="50" required value="<?php echo htmlspecialchars($row['material']); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group bg-light p-3 rounded h-100">
                        <label class="d-block border-bottom pb-2 mb-3">Product Tags (Offers)</label>
                        <div class="icheck-danger d-inline mr-4">
                          <input type="checkbox" id="tagBestSeller" name="tag[]" value="Best-seller" <?php if(in_array("Best-seller", $tag)){echo "checked";} ?>>
                          <label for="tagBestSeller">Best-seller</label>
                        </div>
                        <div class="icheck-danger d-inline mr-4">
                          <input type="checkbox" id="tagFeatured" name="tag[]" value="Featured" <?php if(in_array("Featured", $tag)){echo "checked";} ?>>
                          <label for="tagFeatured">Featured</label>
                        </div>
                        <div class="icheck-danger d-inline mr-4">
                          <input type="checkbox" id="tagSale" name="tag[]" value="Sale" <?php if(in_array("Sale", $tag)){echo "checked";} ?>>
                          <label for="tagSale">Sale</label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="tagTopRate" name="tag[]" value="Top-rate" <?php if(in_array("Top-rate", $tag)){echo "checked";} ?>>
                          <label for="tagTopRate">Top-rate</label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group bg-light p-3 rounded h-100">
                        <label class="d-block border-bottom pb-2 mb-3">Available Colors</label>
                        <div class="d-flex flex-wrap">
                          <?php $all_colors = ['Black', 'Blue', 'Gray', 'Green', 'Red', 'White']; 
                          foreach($all_colors as $clr) { ?>
                          <div class="icheck-danger d-inline mr-4 mb-2">
                            <input type="checkbox" id="color<?php echo $clr; ?>" name="color[]" value="<?php echo $clr; ?>" <?php if(in_array($clr, $color)){echo "checked";} ?>>
                            <label for="color<?php echo $clr; ?>"><?php echo $clr; ?></label>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="form-group bg-light p-3 rounded">
                        <label class="d-block border-bottom pb-2 mb-3">Available Sizes</label>
                        <div class="d-flex flex-wrap">
                          <?php $all_sizes = ['S - Small', 'M - Medium', 'L - Large', 'XL - Extra Large', 'XXL - Extra Extra Large']; 
                          foreach($all_sizes as $sz) { 
                            $id_sz = explode(' ', $sz)[0]; ?>
                          <div class="icheck-danger d-inline mr-4 mb-2">
                            <input type="checkbox" id="size<?php echo $id_sz; ?>" name="size[]" value="<?php echo $sz; ?>" <?php if(in_array($sz, $size)){echo "checked";} ?>>
                            <label for="size<?php echo $id_sz; ?>"><?php echo $sz; ?></label>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <h5 class="mt-4 mb-3 text-muted border-bottom pb-2">Description & Details</h5>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Detailed Description <span class="text-danger">*</span></label>
                        <textarea rows="4" class="form-control" name="description" maxlength="500" required><?php echo htmlspecialchars($row['description']); ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Weight (KG) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="weight" maxlength="10" required value="<?php echo htmlspecialchars($row['weight']); ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Dimensions (CM) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="dimension" maxlength="20" required value="<?php echo htmlspecialchars($row['dimension']); ?>">
                      </div>
                    </div>
                  </div>

                  <h5 class="mt-4 mb-3 text-muted border-bottom pb-2">Product Images</h5>
                  <div class="row">
                    <!-- Image 1 -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Main Image</label>
                        <div class="custom-file mb-2">
                          <input type="file" class="custom-file-input" id="img1" name="image1" onchange="previewImage(this, 'preview1')">
                          <label class="custom-file-label" for="img1">Upload New...</label>
                        </div>
                        <div class="border rounded p-2 text-center bg-light" style="height: 220px;">
                          <img id="preview1" src="image/<?php echo $row['image1']; ?>" style="height:100%; width:100%; object-fit:contain;">
                        </div>
                      </div>
                    </div>
                    <!-- Image 2 -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Image 2</label>
                        <div class="custom-file mb-2">
                          <input type="file" class="custom-file-input" id="img2" name="image2" onchange="previewImage(this, 'preview2')">
                          <label class="custom-file-label" for="img2">Upload New...</label>
                        </div>
                        <div class="border rounded p-2 text-center bg-light" style="height: 220px;">
                          <img id="preview2" src="image/<?php echo $row['image2']; ?>" style="height:100%; width:100%; object-fit:contain;">
                        </div>
                      </div>
                    </div>
                    <!-- Image 3 -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Image 3</label>
                        <div class="custom-file mb-2">
                          <input type="file" class="custom-file-input" id="img3" name="image3" onchange="previewImage(this, 'preview3')">
                          <label class="custom-file-label" for="img3">Upload New...</label>
                        </div>
                        <div class="border rounded p-2 text-center bg-light" style="height: 220px;">
                          <img id="preview3" src="image/<?php echo $row['image3']; ?>" style="height:100%; width:100%; object-fit:contain;">
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                
                <div class="card-footer bg-light text-right">
                  <a href="view-product.php" class="btn btn-default mr-2"><i class="fas fa-times"></i> Cancel</a>
                  <button type="submit" class="btn btn-primary px-4 font-weight-bold" name="edited_product"><i class="fas fa-save"></i> Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script>
    const subcategoryMap = {
        "Daily Wear Junction": ["Bottom Wear", "Comfort Wear", "Cotton Printed Fabric", "Gown", "Kurti Set(Two piece set)", "Long Tissue Skirt", "Tunics", "co-rd set", "dupatta", "night wear"],
        "Printed Cotton": ["Casual Cotton Fabric", "Navratri Special Cotton Fabric", "Plain Cotton Fabric", "Printed Cotton Fabric", "Special Printed Cotton"],
        "Ready Made": ["Bollywood Style Blouse", "Classic Blouse", "Hand Work Blouse", "Peplum Blouse", "Stretchable Blouse", "Vintage Blouse"],
        "Silk Material": ["Apple Silk", "Banglore Silk", "Cotton silk", "Gaji Silk", "Maheshwari Silk", "Model silk", "Palin Tissue Silk", "Shantin Silk", "slub silk"],
        "Work Material": ["Bridal Fabric", "Brocade Fabric", "Chaniya Choli Fabric", "Dupatta Fabric", "Gawn Fabric", "Regular Embroidered Fabric", "Tissue Border Fabric", "Vintage Fabric"]
    };

    function updateSubcategories(selectedType = null) {
        const category = document.getElementById('categorySelect').value;
        const typeSelect = document.getElementById('typeSelect');
        
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

    // Image preview helper
    function previewImage(input, previewId) {
        var pre = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                pre.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    window.onload = function() {
        updateSubcategories("<?php echo htmlspecialchars($row['type']); ?>");
        // Update custom file label on select
        $('.custom-file-input').on('change',function(){
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        })
    };
  </script>

  <?php include_once 'footer.php'; ?>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<?php include_once 'scripts.php'; ?>