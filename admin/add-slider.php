<?php include_once 'header.php';


// if (isset($_POST['submit_slider']))
// {
//     $title = $_POST['title'];
//     $details = $_POST['details'];
//     $image = rand(1,1000000).$_FILES['image']['name'];

//     $path = 'image/'.$image;

//     move_uploaded_file($_FILES['image']['tmp_name'], $path);

//     $sql_insert = "insert into `slider` (`Title`,`Details`,`Image`) values ('$title','$details','$image')";
//     mysqli_query($conn,$sql_insert);

//     header('location:add-slider.php');

// }

if (isset($_POST['submit_slider']))
{
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $image = rand(1,1000000).$_FILES['image']['name'];

    $path = 'image/'.$image;

    if(move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
        $sql_insert = "insert into `slider`(`title`,`details`,`image`)values('$title','$details','$image')";
        mysqli_query($conn,$sql_insert);
    }

    header('location:add-slider.php');
}

?>

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Slider</h1>
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
            <div class="card card-dark">
              <div class="card-header" style="background: #13213B;">
                <h3 class="card-title">Add New Slider Image</h3>
              </div>
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label>Slider Title</label>
                    <input type="text" class="form-control" name="title" maxlength="20" required placeholder="Enter slide title">
                  </div>
                  <div class="form-group">
                    <label>Slider Details</label>
                    <input type="text" class="form-control" name="details" maxlength="50" required placeholder="Enter slide subtitle">
                  </div>
                  <div class="form-group">
                    <label>Select Slide Image</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="image" required id="slideImage">
                      <label class="custom-file-label" for="slideImage">Choose file...</label>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-light text-right">
                  <button type="submit" class="btn btn-primary" name="submit_slider">Add Slider Slide</button>
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