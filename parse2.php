<!doctype html>
    <!-- Developer: Raphael Klein - http://austrianmultimedia.at/ -->
    <head>
        <meta charset="utf-8" />
        <title>GCODE-File Parser</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h2>GCODE Parser</h2><i>v 0.1</i> <br /> <br />
        <?php    
            if ($_FILES["datafile"]["error"] > 0){
              echo "Error: " . $_FILES["datafile"]["error"] . "<br />";
            }
            else {
                $fileName = $_FILES["datafile"]["name"];
                echo "Upload: " . $fileName . "<br />";
                echo "Type: " . $_FILES["datafile"]["type"] . "<br />";
                echo "Size: " . ($_FILES["datafile"]["size"] / 1024) . " Kb<br />";

                // if (file_exists("upload/" . $_FILES["datafile"]["name"])) {
                //     echo $_FILES["datafile"]["name"] . " already exists. ";
                // }
                // else {
                    move_uploaded_file($_FILES["datafile"]["tmp_name"], "upload/" . $_FILES["datafile"]["name"]);
                    echo "Stored in: " . "upload/" . $_FILES["datafile"]["name"]. "<br /><br /><br />";
                // }
            }

            $sourceFile    = file_get_contents('upload/' .$fileName);
            $rows          = explode("\n", $sourceFile);
            array_shift($rows);
            $i = 0;

            $outputFile = "output/out_" .$fileName. ".xyz";
            $fh = fopen($outputFile, 'w') or die("can't open file");

            echo "<h2><a href='" .$outputFile. "'>" .$outputFile. "</a></h2><i>Option-Click -> Save target as</i><br /><br /><br /><br />";
            echo "<h3>File-Content: </h3>";

            $oldZ = "0.00";
            echo "<table border='1'>";
            foreach($rows as $row => $data) {
                $row_data = explode(" ", $data);

                if ($row_data[0] == "G1") {
                    $info[$row]['g'] = $row_data[0];
                    $info[$row]['x'] = $row_data[1];
                    $info[$row]['y'] = $row_data[2];
                    $info[$row]['z'] = $row_data[3];

                    if ($info[$row]['z'] == "") {
                        $z = $oldZ;
                    } else {
                        $firstCharOfZ = $info[$row]['z'][0];
                        if ($firstCharOfZ == "E" || $firstCharOfZ == "F" || $firstCharOfZ == "") {
                            $z = $oldZ;
                        } else {
                            $z = substr($info[$row]['z'], 1);
                        }
                    }

                    $x = substr($info[$row]['x'], 1);
                    $y = substr($info[$row]['y'], 1);
                    
                    $stringData = $x. " \t " .$y. " \t " .$z. "\r\n";
                    $utf8StringData = utf8_encode($stringData);
                    fwrite($fh, $utf8StringData);


                    echo "<tr>";
                        echo "<td>". $x ."</td>";
                        echo "<td>". $y ."</td>";
                        echo "<td>". $z ."</td>";
                    echo "</tr>";
                }
                $oldZ = $z;
                $i++;
            }
            fclose($fh);
            echo "</table>"; 

        ?>
</body>
</html>








