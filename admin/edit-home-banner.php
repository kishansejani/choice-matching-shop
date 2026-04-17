<?php
include_once 'header.php';

$id = $_GET['e_id'];
if (isset($_POST['update_banner'])) {
    $tag = mysqli_real_escape_string($conn, $_POST['tag']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);

    if ($_FILES['image']['name'] != '') {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $image);
        mysqli_query($conn, "UPDATE `home_banners` SET `image`='$image', `tag`='$tag', `title`='$title', `subtitle`='$subtitle', `link`='$link' WHERE `id`='$id'");
    } else {
        mysqli_query($conn, "UPDATE `home_banners` SET `tag`='$tag', `title`='$title', `subtitle`='$subtitle', `link`='$link' WHERE `id`='$id'");
    }
    header('location:manage-home-banners.php?success=1');
    exit;
}

$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `home_banners` WHERE `id`='$id'"));
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Home Banner (<?php echo strtoupper($row['position']); ?>)</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Current Image</label><br>
                            <img src="../images/<?php echo $row['image']; ?>" style="height: 100px; border-radius: 8px; margin-bottom: 10px;">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tag (e.g. New Arrivals)</label>
                            <input type="text" name="tag" value="<?php echo $row['tag']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" value="<?php echo $row['title']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Subtitle</label>
                            <input type="text" name="subtitle" value="<?php echo $row['subtitle']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Link URL</label>
                            <input type="text" name="link" value="<?php echo $row['link']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="update_banner" class="btn btn-primary">Update Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>
