<?php
if (isset($_POST['wine_label_id'])) {
    $wineLabelId = $_POST['wine_label_id'];
    $con = mysqli_connect("us-cdbr-east-06.cleardb.net", "b34e5df2471635", "6ffed3a5", "heroku_eb7517145b609d1");

    // Update the status_completed column to 1
    $updateQuery = "UPDATE wine_label SET status_completed = 1 WHERE id = '$wineLabelId'";
    mysqli_set_charset($con, "utf8");
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        $result = array("status" => "success", "message" => "Status updated successfully");
    } else {
        $result = array("status" => "failed", "message" => "Failed to update status");
    }
} else {
    $result = array("status" => "failed", "message" => "Wine Label ID needed");
}

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
