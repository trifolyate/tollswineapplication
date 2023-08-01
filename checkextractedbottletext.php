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

    // Function to calculate the similarity between two strings
    function calculateSimilarity($text1, $text2) {
        // Convert both strings to lowercase for case-insensitive comparison
        $text1 = strtolower($text1);
        $text2 = strtolower($text2);

        // Calculate the similarity using the similar_text function
        similar_text($text1, $text2, $similarityPercentage);

        return $similarityPercentage;
    }

    // Replace \n with a blank space in the extracted text
    $text = str_replace("\n", " ", $text);

    // Loop through the database rows and compare with the text
    while ($row = mysqli_fetch_array($response)) {
        // Extract data from the row
        $wine_name = $row['11'];

        // Convert both strings to lowercase for case-insensitive comparison
        $text = strtolower($text);
        $wine_name = strtolower($wine_name);

        // Calculate the similarity between the extracted text and wine name
        $similarity = calculateSimilarity($text, $wine_name);

        // If similarity is greater than or equal to 60% or the original wine name is contained within the extracted text,
        // add the data to the result
        if ($similarity >= 60 || strpos($text, $wine_name) !== false) {
            $index['wine_name'] = $row['11'];
            $index['vintage'] = $row['10'];
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
