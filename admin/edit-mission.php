<?php 
include_once 'header.php';

$sql_select = "select * from `about`";
$data = mysqli_query($conn,$sql_select);
$row = mysqli_fetch_assoc($data);

if (isset($_POST['edited_mission']))
{
    $m_detail = mysqli_real_escape_string($conn, $_POST['m_detail']);
    $image_m = $_FILES['image']['name'];

    if($image_m=="")
    {
        $image = $row['mission_image'];
    }
    else
    {
        if(file_exists('image/'.$row['mission_image'])) {
            unlink('image/'.$row['mission_image']);
        }

        $image = rand(1,1000000).$_FILES['image']['name'];
        $path = 'image/'.$image;
        move_uploaded_file($_FILES['image']['tmp_name'],$path);
    }

    $sql_update = "update `about` set `mission_detail`='$m_detail',`mission_image`='$image'";
    mysqli_query($conn,$sql_update);

    header('location:manage-about.php');
}

?>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Our Mission</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="manage-about.php">About Us</a></li>
              <li class="breadcrumb-item active">Edit Mission</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card card-dark">
              <div class="card-header" style="background: #13213B;">
                <h3 class="card-title">Update Mission Details</h3>
              </div>
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                   <div class="form-group">
                    <label>Mission Details</label>
                    <textarea rows="10" class="form-control" name="m_detail" maxlength="1500" required><?php echo htmlspecialchars($row['mission_detail']); ?></textarea>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>New Mission Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="missionImg" name="image">
                                <label class="custom-file-label" for="missionImg">Choose image</label>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6 text-center">
                        <label>Current Image</label>
                        <div style="border: 1px solid #ddd; padding: 5px; border-radius: 8px; width: 180px; margin: 0 auto;">
                            <img src="image/<?php echo $row['mission_image']; ?>" style="width: 100%; height: 120px; object-fit: cover;">
                        </div>
                      </div>
                  </div>
                </div>
                <div class="card-footer bg-light text-right">
                  <a href="manage-about.php" class="btn btn-secondary mr-2">Cancel</a>
                  <button type="submit" class="btn btn-primary" name="edited_mission">Update Mission</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

<?php 
include_once 'footer.php'; 
include_once 'scripts.php'; 
?>