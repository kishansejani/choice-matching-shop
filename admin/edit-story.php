<?php include_once 'header.php';

$sql_select = "select * from `about`";
$data = mysqli_query($conn,$sql_select);
$row = mysqli_fetch_assoc($data);

if (isset($_POST['edited_story']))
{
    $s_detail = mysqli_real_escape_string($conn, $_POST['s_detail']);
    $image_s = $_FILES['image']['name'];

    if($image_s=="")
    {
        $image = $row['story_image'];
    }
    else
    {
        if(file_exists('image/'.$row['story_image'])) {
            unlink('image/'.$row['story_image']);
        }

        $image = rand(1,1000000).$_FILES['image']['name'];
        $path = 'image/'.$image;
        move_uploaded_file($_FILES['image']['tmp_name'],$path);
    }

    $sql_update = "update `about` set `story_detail`='$s_detail',`story_image`='$image'";
    mysqli_query($conn,$sql_update);

    header('location:manage-about.php');
}

?>

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Our Story</h1>
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
          <div class="col-md-8">
            <div class="card card-dark">
              <div class="card-header" style="background: #13213B;">
                <h3 class="card-title">Edit Our Story</h3>
              </div>
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label>Story Details</label>
                    <textarea rows="10" class="form-control" name="s_detail" maxlength="1500" required><?php echo htmlspecialchars($row['story_detail']); ?></textarea>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>New Story Image</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="storyImg" name="image">
                          <label class="custom-file-label" for="storyImg">Choose file</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label>Current Image</label>
                      <div style="width: 150px; height: 150px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                        <img src="image/<?php echo $row['story_image']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-light text-right">
                  <a href="manage-about.php" class="btn btn-secondary mr-2">Cancel</a>
                  <button type="submit" class="btn btn-primary" name="edited_story">Update Story</button>
                </div>
              </form>
            </div>
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