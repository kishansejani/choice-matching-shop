<?php
include_once 'header.php';

if (isset($_POST['add_brand'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $image = time() . '_' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $image);
    mysqli_query($conn, "INSERT INTO `home_brands` (image, name, status) VALUES ('$image', '$name', 1)");
    header('location:manage-home-brands.php?success=1');
    exit;
}

if (isset($_GET['d_id'])) {
    $id = $_GET['d_id'];
    mysqli_query($conn, "DELETE FROM `home_brands` WHERE `id`='$id'");
    header('location:manage-home-brands.php?deleted=1');
    exit;
}

if (isset($_GET['toggle_status'])) {
    $id = $_GET['toggle_status'];
    $status = $_GET['status'] == 1 ? 0 : 1;
    mysqli_query($conn, "UPDATE `home_brands` SET `status`='$status' WHERE `id`='$id'");
    echo "<script>window.location.href='manage-home-brands.php?success=1'</script>";
}

// Handle Update
if (isset($_POST['update_brand'])) {
    $id = $_POST['brand_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    
    if ($_FILES['image']['name'] != '') {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $image);
        mysqli_query($conn, "UPDATE `home_brands` SET `name`='$name', `image`='$image' WHERE `id`='$id'");
    } else {
        mysqli_query($conn, "UPDATE `home_brands` SET `name`='$name' WHERE `id`='$id'");
    }
    header('location:manage-home-brands.php?success=1');
    exit;
}

// Fetch brand for editing
$edit_row = null;
if (isset($_GET['e_id'])) {
    $id = $_GET['e_id'];
    $edit_res = mysqli_query($conn, "SELECT * FROM `home_brands` WHERE `id`='$id'");
    $edit_row = mysqli_fetch_assoc($edit_res);
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Manage Featured Brands</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header" style="background: <?php echo $edit_row ? 'var(--primary-color)' : 'transparent'; ?>; color: <?php echo $edit_row ? '#fff' : 'inherit'; ?>;">
                    <h3 class="card-title font-weight-bold"><?php echo $edit_row ? 'Update Brand Details' : 'Add New Brand'; ?></h3>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="brand_id" value="<?php echo @$edit_row['id']; ?>">
                    <div class="card-body row">
                        <div class="form-group col-md-6">
                            <label>Brand Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo @$edit_row['name']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Brand Image/Logo <?php if($edit_row) echo "(Leave empty to keep current)"; ?></label>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="brandImg" <?php if(!$edit_row) echo 'required'; ?>>
                                <label class="custom-file-label" for="brandImg">Choose file</label>
                            </div>
                            <?php if($edit_row) { ?>
                                <div class="mt-2 p-1 border rounded d-inline-block bg-light">
                                    <small class="d-block mb-1">Current Logo:</small>
                                    <img src="../images/<?php echo $edit_row['image']; ?>" height="40" class="rounded">
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <?php if($edit_row) { ?>
                            <button type="submit" name="update_brand" class="btn btn-primary px-4 shadow-sm">Save Changes</button>
                            <a href="manage-home-brands.php" class="btn btn-outline-secondary px-4 ml-2">Cancel</a>
                        <?php } else { ?>
                            <button type="submit" name="add_brand" class="btn btn-primary px-4 shadow-sm">Add Brand</button>
                        <?php } ?>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = mysqli_query($conn, "SELECT * FROM `home_brands` ORDER BY id DESC");
                            while ($row = mysqli_fetch_assoc($res)) {
                                $status_btn = $row['status'] == 1 ? "btn-success" : "btn-secondary";
                                $status_text = $row['status'] == 1 ? "Active" : "Deactive";
                                echo "<tr>
                                    <td><img src='../images/{$row['image']}' style='height: 50px;'></td>
                                    <td>{$row['name']}</td>
                                    <td><a href='?toggle_status={$row['id']}&status={$row['status']}' class='btn btn-xs $status_btn'>$status_text</a></td>
                                    <td>
                                        <a href='?e_id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                                    </td>
                                    <td>
                                        <a href='?d_id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
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
