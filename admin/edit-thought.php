<?php 
include_once 'header.php';

$sql_select = "select * from `about`";
$data = mysqli_query($conn,$sql_select);
$row = mysqli_fetch_assoc($data);

if (isset($_POST['edited_thought']))
{
    $thought = mysqli_real_escape_string($conn, $_POST['thought']);
    $thought_by = mysqli_real_escape_string($conn, $_POST['thought_by']);

    $sql_update = "update `about` set `best_thought`='$thought',`thought_by`='$thought_by'";
    mysqli_query($conn,$sql_update);

    header('location:manage-about.php');
}

?>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Best Thought</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="manage-about.php">About Us</a></li>
              <li class="breadcrumb-item active">Edit Thought</li>
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
                <h3 class="card-title">Update Thought</h3>
              </div>
              <form method="post">
                <div class="card-body">
                   <div class="form-group">
                    <label>The Thought/Quote</label>
                    <textarea rows="5" class="form-control" name="thought" maxlength="1500" required><?php echo htmlspecialchars(@$row['best_thought']); ?></textarea>
                  </div>
                  
                  <div class="form-group">
                    <label>Author Name</label>
                    <input type="text" class="form-control" name="thought_by" maxlength="50" required value="<?php echo htmlspecialchars(@$row['thought_by']); ?>">
                  </div>
                </div>
                <div class="card-footer bg-light text-right">
                   <a href="manage-about.php" class="btn btn-secondary mr-2">Cancel</a>
                  <button type="submit" class="btn btn-primary" name="edited_thought">Update Thought</button>
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