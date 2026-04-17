<?php
include_once 'header.php';

if (isset($_GET['d_id'])) {
    $id = $_GET['d_id'];
    mysqli_query($conn, "DELETE FROM `home_benefits` WHERE `id`='$id'");
    header('location:manage-home-benefits.php?deleted=1');
    exit;
}

if (isset($_GET['toggle_status'])) {
    $id = $_GET['toggle_status'];
    $status = $_GET['status'] == 1 ? 0 : 1;
    mysqli_query($conn, "UPDATE `home_benefits` SET `status`='$status' WHERE `id`='$id'");
    echo "<script>window.location.href='manage-home-benefits.php?success=1'</script>";
}

if (isset($_POST['add_benefit'])) {
    $icon = mysqli_real_escape_string($conn, $_POST['icon']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
    mysqli_query($conn, "INSERT INTO `home_benefits` (icon, title, subtitle, status) VALUES ('$icon', '$title', '$subtitle', 1)");
    header('location:manage-home-benefits.php?added=1');
    exit;
}

if (isset($_GET['e_id'])) {
    $id = $_GET['e_id'];
    if (isset($_POST['update_benefit'])) {
        $icon = mysqli_real_escape_string($conn, $_POST['icon']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
        mysqli_query($conn, "UPDATE `home_benefits` SET `icon`='$icon', `title`='$title', `subtitle`='$subtitle' WHERE `id`='$id'");
        header('location:manage-home-benefits.php?success=1');
        exit;
    }
    $edit_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `home_benefits` WHERE `id`='$id'"));
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Manage Home Benefits</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Add/Edit Card -->
            <div class="card card-<?php echo isset($_GET['e_id']) ? 'warning' : 'primary'; ?>">
                <div class="card-header">
                    <h3 class="card-title"><?php echo isset($_GET['e_id']) ? 'Edit Benefit' : 'Add New Benefit'; ?></h3>
                </div>
                <form method="post">
                    <div class="card-body row">
                        <div class="form-group col-md-4">
                            <label>Icon Class</label>
                            <input type="text" name="icon" value="<?php echo @$edit_row['icon']; ?>" class="form-control" placeholder="e.g. zmdi zmdi-truck" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Title</label>
                            <input type="text" name="title" value="<?php echo @$edit_row['title']; ?>" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Subtitle</label>
                            <input type="text" name="subtitle" value="<?php echo @$edit_row['subtitle']; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php if (isset($_GET['e_id'])) { ?>
                            <button type="submit" name="update_benefit" class="btn btn-warning">Update Benefit</button>
                            <a href="manage-home-benefits.php" class="btn btn-default">Cancel</a>
                        <?php } else { ?>
                            <button type="submit" name="add_benefit" class="btn btn-primary">Add Benefit</button>
                        <?php } ?>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = mysqli_query($conn, "SELECT * FROM `home_benefits` ORDER BY id ASC");
                            while ($row = mysqli_fetch_assoc($res)) {
                                $status_btn = $row['status'] == 1 ? "btn-success" : "btn-secondary";
                                $status_text = $row['status'] == 1 ? "Active" : "Deactive";
                                echo "<tr>
                                    <td><i class='{$row['icon']}' style='font-size: 24px;'></i></td>
                                    <td>{$row['title']}</td>
                                    <td>{$row['subtitle']}</td>
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
