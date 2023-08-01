<?php
if (isset($_POST['id']) && isset($_POST['text'])) {
    $id = $_POST['id'];
    $text = $_POST['text'];
    $con = mysqli_connect("us-cdbr-east-06.cleardb.net", "b34e5df2471635", "6ffed3a5", "heroku_eb7517145b609d1");
    $result = array();
    $result['data'] = array();

    // Fetch data from the database
    $select = "SELECT * FROM wine_label WHERE inbound_list_id = '$id' AND status_completed = 0 ";  
    mysqli_set_charset($con, "utf8");
    $response = mysqli_query($con, $select);

    // Loop through the database rows and compare with the text
    while ($row = mysqli_fetch_array($response)) {
        // Extract data from the row
        $wine_name = $row['11'];
        $vintage = $row['10'];

        // Use regular expressions to extract wine name and vintage from the text
        $pattern = "/$wine_name.*$vintage/i"; // Case-insensitive matching
        if (preg_match($pattern, $text)) {
            // If wine name and vintage are found in the text, add the data to the result
            $index['wine_name'] = $wine_name;
            $index['vintage'] = $vintage;
            $index['region_of_production'] = $row['8'];
            $index['quantity'] = $row['7'];
            $index['model_name'] = $row['6'];
            $index['importer_information'] = $row['5'];
            $index['grape_variety'] = $row['4'];
            $index['brand_name'] = $row['3'];
            $index['bottle_information'] = $row['2'];
            $index['alcohol_content'] = $row['1'];
            $index['wine_label_id'] = $row['0'];

            array_push($result['data'], $index);
        }
    }

    if (count($result['data']) > 0) {
        $result['success'] = "1";
        $result['extractedtext'] = $text;
    } else {
        $result['success'] = "0";
        $result['extractedtext'] = $text;
    }
} else {
    $result = array("status" => "failed", "message" => "Barcode ID and Text needed");
}

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
