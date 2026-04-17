<?php
include_once 'header.php';

if (isset($_GET['d_id'])) {
    $id = $_GET['d_id'];
    mysqli_query($conn, "DELETE FROM `home_banners` WHERE `id`='$id'");
    header('location:manage-home-banners.php?success=1');
    exit;
}

if (isset($_GET['toggle_status'])) {
    $id = $_GET['toggle_status'];
    $status = $_GET['status'] == 1 ? 0 : 1;
    mysqli_query($conn, "UPDATE `home_banners` SET `status`='$status' WHERE `id`='$id'");
    echo "<script>window.location.href='manage-home-banners.php?success=1'</script>";
}

if (isset($_POST['add_banner'])) {
    $tag = mysqli_real_escape_string($conn, $_POST['tag']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    
    $image = time() . '_' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $image);
    
    mysqli_query($conn, "INSERT INTO `home_banners` (image, tag, title, subtitle, link, position, status) VALUES ('$image', '$tag', '$title', '$subtitle', '$link', '$position', 1)");
    header('location:manage-home-banners.php?added=1');
    exit;
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Manage Home Banners</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Banner Position</h3>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body row">
                        <div class="form-group col-md-4">
                            <label>Position</label>
                            <select name="position" class="form-control">
                                <option value="hero">Hero (Large)</option>
                                <option value="sm1">Small 1</option>
                                <option value="sm2">Small 2</option>
                                <option value="strip1">Strip 1 (Top)</option>
                                <option value="strip2">Strip 2 (Bottom)</option>
                            </select>
                            <small class="text-muted">Note: Multiple banners for one position will show the newest active one.</small>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tag</label>
                            <input type="text" name="tag" class="form-control" placeholder="New Arrivals">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Subtitle</label>
                            <input type="text" name="subtitle" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Link</label>
                            <input type="text" name="link" class="form-control" value="product.php">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="add_banner" class="btn btn-primary">Add Banner</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = mysqli_query($conn, "SELECT * FROM `home_banners` ORDER BY id DESC");
                            while ($row = mysqli_fetch_assoc($res)) {
                                $status_btn = $row['status'] == 1 ? "btn-success" : "btn-secondary";
                                $status_text = $row['status'] == 1 ? "Active" : "Deactive";
                                echo "<tr>
                                    <td><b>" . strtoupper($row['position']) . "</b></td>
                                    <td><img src='../images/{$row['image']}' style='height: 50px;'></td>
                                    <td>{$row['title']}</td>
                                    <td><a href='?toggle_status={$row['id']}&status={$row['status']}' class='btn btn-xs $status_btn'>$status_text</a></td>
                                    <td>
                                        <a href='edit-home-banner.php?e_id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                                    </td>
                                    <td>
                                        <a href='?d_id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Delete this banner?\")'>Delete</a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>
