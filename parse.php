<?php

    
    // if ($_FILES["datafile"]["error"] > 0){
    //   echo "Error: " . $_FILES["datafile"]["error"] . "<br />";
    // }
    // else {
    //     echo "Upload: " . $_FILES["datafile"]["name"] . "<br />";
    //     echo "Type: " . $_FILES["datafile"]["type"] . "<br />";
    //     echo "Size: " . ($_FILES["datafile"]["size"] / 1024) . " Kb<br />";

    //     if (file_exists("upload/" . $_FILES["datafile"]["name"])) {
    //         echo $_FILES["datafile"]["name"] . " already exists. ";
    //     }
    //     else {
    //         echo "File doesn't exist!";
    //         move_uploaded_file($_FILES["datafile"]["tmp_name"], "upload/" . $_FILES["datafile"]["name"]);
    //         echo "Stored in: " . "upload/" . $_FILES["datafile"]["name"];
    //     }
    // }

    
    $sourceFile    = file_get_contents('1_small_testblock_export.gcode');
    $rows          = explode("\n", $sourceFile);
    array_shift($rows);
    $i = 0;

    // $myFile = "outputFile.txt";
    // $fh = fopen($myFile, 'w') or die("can't open file");
    // $stringData = "Bobby Bopper\n";
    // fwrite($fh, $stringData);
    // $stringData = "Tracy Tanner\n";
    // fwrite($fh, $stringData);
    // fclose($fh);





    foreach($rows as $row => $data) {

        $row_data = explode(' ', $data);

        if ($row_data[0] == "G1") {
            $info[$row]['g']       = $row_data[0];
            $info[$row]['x']       = $row_data[1];
            $info[$row]['y']       = $row_data[2];
            $info[$row]['z']       = $row_data[3];

            // echo $i. " " .$info[$row]['g']. " " .$info[$row]['x']. " " .$info[$row]['y']. " " .$info[$row]['z'];
            echo $info[$row]['g']. " " .$info[$row]['x']. " " .$info[$row]['y']. " " .$info[$row]['z'];
            echo '<br />';
        }
        $i++;
    }

?>