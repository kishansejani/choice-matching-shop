<?php
include_once 'header.php';

if (isset($_GET['d_id'])) {
    $id = $_GET['d_id'];
    mysqli_query($conn, "DELETE FROM `subcategory` WHERE `id`='$id'");
    header('location:view-subcategory.php?success=1');
    exit;
}

if (isset($_GET['toggle_status'])) {
    $id = $_GET['toggle_status'];
    $status = $_GET['status'] == 1 ? 0 : 1;
    mysqli_query($conn, "UPDATE `subcategory` SET `status`='$status' WHERE `id`='$id'");
    echo "<script>window.location.href='view-subcategory.php?success=1'</script>";
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>View Sub-Categories</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Sequence</th>
                                <th>Status</th>
                                <th>Edit Data</th>
                                <th>Delete Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = mysqli_query($conn, "SELECT s.*, c.category_name FROM `subcategory` s JOIN `category` c ON s.category_id = c.id ORDER BY s.sequence ASC, s.id DESC");
                            while ($row = mysqli_fetch_assoc($res)) {
                                $status_btn = $row['status'] == 1 ? "btn-success" : "btn-secondary";
                                $status_text = $row['status'] == 1 ? "Active" : "Deactive";
                                echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['category_name']}</td>
                                    <td>{$row['subcategory_name']}</td>
                                    <td>{$row['sequence']}</td>
                                    <td><a href='?toggle_status={$row['id']}&status={$row['status']}' class='btn btn-xs $status_btn'>$status_text</a></td>
                                    <td>
                                        <a href='edit-subcategory.php?e_id={$row['id']}' class='btn btn-primary'>Edit</a>
                                    </td>
                                    <td>
                                        <a href='?d_id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
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
