<?php
include_once 'header.php';

if (isset($_GET['d_id'])) {
    $id = $_GET['d_id'];
    mysqli_query($conn, "DELETE FROM `home_promo` WHERE `id`='$id'");
    header('location:manage-home-promo.php?deleted=1');
    exit;
}

if (isset($_GET['toggle_status'])) {
    $id = $_GET['toggle_status'];
    $status = $_GET['status'] == 1 ? 0 : 1;
    // Optional: make all others inactive if this one is activated
    if($status == 1) {
        mysqli_query($conn, "UPDATE `home_promo` SET `status`=0");
    }
    mysqli_query($conn, "UPDATE `home_promo` SET `status`='$status' WHERE `id`='$id'");
    echo "<script>window.location.href='manage-home-promo.php?success=1'</script>";
}

if (isset($_POST['add_promo'])) {
    $h1 = mysqli_real_escape_string($conn, $_POST['heading1']);
    $h2 = mysqli_real_escape_string($conn, $_POST['heading2']);
    $sub = mysqli_real_escape_string($conn, $_POST['subheading']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $icon = mysqli_real_escape_string($conn, $_POST['icon']);
    mysqli_query($conn, "INSERT INTO `home_promo` (heading1, heading2, subheading, link, icon, status) VALUES ('$h1', '$h2', '$sub', '$link', '$icon', 0)");
    header('location:manage-home-promo.php?added=1');
    exit;
}

if (isset($_GET['e_id'])) {
    $id = $_GET['e_id'];
    if (isset($_POST['update_promo'])) {
        $h1 = mysqli_real_escape_string($conn, $_POST['heading1']);
        $h2 = mysqli_real_escape_string($conn, $_POST['heading2']);
        $sub = mysqli_real_escape_string($conn, $_POST['subheading']);
        $link = mysqli_real_escape_string($conn, $_POST['link']);
        $icon = mysqli_real_escape_string($conn, $_POST['icon']);
        mysqli_query($conn, "UPDATE `home_promo` SET `heading1`='$h1', `heading2`='$h2', `subheading`='$sub', `link`='$link', `icon`='$icon' WHERE `id`='$id'");
        header('location:manage-home-promo.php?success=1');
        exit;
    }
    $edit_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `home_promo` WHERE `id`='$id'"));
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Manage Home Promo Banners</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Add/Edit Card -->
            <div class="card card-<?php echo isset($_GET['e_id']) ? 'warning' : 'primary'; ?>">
                <div class="card-header">
                    <h3 class="card-title"><?php echo isset($_GET['e_id']) ? 'Edit Promo' : 'Add New Promo'; ?></h3>
                </div>
                <form method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Heading 1 (Small)</label>
                                <input type="text" name="heading1" value="<?php echo @$edit_row['heading1']; ?>" class="form-control" placeholder="e.g. Luxe Watches" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Heading 2 (Bold)</label>
                                <input type="text" name="heading2" value="<?php echo @$edit_row['heading2']; ?>" class="form-control" placeholder="e.g. Season Sale" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Subheading</label>
                                <input type="text" name="subheading" value="<?php echo @$edit_row['subheading']; ?>" class="form-control" placeholder="e.g. Up to 50% off" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Link</label>
                                <input type="text" name="link" value="<?php echo @$edit_row['link']; ?>" class="form-control" value="product.php" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Background Icon</label>
                                <input type="text" name="icon" value="<?php echo @$edit_row['icon']; ?>" class="form-control" placeholder="zmdi zmdi-watch" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php if (isset($_GET['e_id'])) { ?>
                            <button type="submit" name="update_promo" class="btn btn-warning">Update Promo</button>
                            <a href="manage-home-promo.php" class="btn btn-default">Cancel</a>
                        <?php } else { ?>
                            <button type="submit" name="add_promo" class="btn btn-primary">Add Promo</button>
                        <?php } ?>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Heading</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = mysqli_query($conn, "SELECT * FROM `home_promo` ORDER BY id DESC");
                            while ($row = mysqli_fetch_assoc($res)) {
                                $status_btn = $row['status'] == 1 ? "btn-success" : "btn-secondary";
                                $status_text = $row['status'] == 1 ? "Active" : "Deactive";
                                echo "<tr>
                                    <td><b>{$row['heading1']}</b><br>{$row['heading2']}</td>
                                    <td><a href='?toggle_status={$row['id']}&status={$row['status']}' class='btn btn-xs $status_btn'>$status_text</a></td>
                                    <td><a href='?e_id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a></td>
                                    <td><a href='?d_id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
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
