<?php 
include_once 'header.php';

// Sanitize and check e_id
$edit_id = isset($_GET['e_id']) ? mysqli_real_escape_string($conn, $_GET['e_id']) : 0;

$sql_select = "select * from `blog` where `id`='$edit_id'";
$data = mysqli_query($conn, $sql_select);
$row = mysqli_fetch_assoc($data);

if (!$row) {
    echo "<div class='content-wrapper'><section class='content'><div class='container-fluid'><div class='alert alert-danger mt-3'>Blog post not found!</div></div></section></div>";
    include_once 'footer.php';
    exit;
}

$current_tags = explode(', ', $row['tag']);

if (isset($_POST['edited_blog'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $s_details = mysqli_real_escape_string($conn, $_POST['s_details']);
    $f_details = mysqli_real_escape_string($conn, $_POST['f_details']);
    $tag_str = isset($_POST['tag']) ? mysqli_real_escape_string($conn, implode(', ', $_POST['tag'])) : '';
    $image_s = $_FILES['image']['name'];

    if ($image_s == "") {
        $image = $row['image'];
    } else {
        if (!empty($row['image']) && file_exists('image/' . $row['image'])) {
            unlink('image/' . $row['image']);
        }

        $image = rand(1, 1000000) . $_FILES['image']['name'];
        $path = 'image/' . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
    }

    $sql_update = "update `blog` set `title`='$title', `short_detail`='$s_details', `full_detail`='$f_details', `tag`='$tag_str', `image`='$image' where `id`='$edit_id'";
    
    if (mysqli_query($conn, $sql_update)) {
        echo "<script>window.location.href='view-blog.php';</script>";
        exit;
    } else {
        $error = mysqli_error($conn);
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Blog Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="view-blog.php">Blogs</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-dark">
                        <div class="card-header" style="background: #13213B;">
                            <h3 class="card-title">Update Blog Details</h3>
                        </div>
                        
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                                
                                <div class="form-group">
                                    <label>Title of Blog</label>
                                    <input type="text" class="form-control" name="title" maxlength="70" required value="<?php echo htmlspecialchars($row['title']); ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label>Short Details (Intro)</label>
                                    <textarea class="form-control" name="s_details" maxlength="250" required rows="3"><?php echo htmlspecialchars($row['short_detail']); ?></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label>Full Content</label>
                                    <textarea rows="10" class="form-control" name="f_details" maxlength="5000" required><?php echo htmlspecialchars($row['full_detail']); ?></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label>Tags</label>
                                    <div class="row">
                                        <?php 
                                        $available_tags = ["Best-seller", "Fashion", "Streetstyle", "Craft", "Lifestyle", "Featured", "Sale", "Top-rate"];
                                        foreach($available_tags as $t) {
                                            $checked = in_array($t, $current_tags) ? "checked" : "";
                                            echo "<div class='col-sm-3'><div class='custom-control custom-checkbox'>
                                                    <input class='custom-control-input' type='checkbox' id='tag_$t' name='tag[]' value='$t' $checked>
                                                    <label for='tag_$t' class='custom-control-label'>$t</label>
                                                  </div></div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Change Image</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="blogImage" name="image">
                                                <label class="custom-file-label" for="blogImage">Choose new file...</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Current Image</label>
                                        <div style="border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                            <img src="image/<?php echo $row['image']; ?>" style="width: 100%; max-height: 150px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-light text-right">
                                <a href="view-blog.php" class="btn btn-secondary mr-2">Cancel</a>
                                <button type="submit" class="btn btn-primary" name="edited_blog">Save Changes</button>
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