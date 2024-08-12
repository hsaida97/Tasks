<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;

    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($fileType != "txt" && $fileType != "doc") {
        echo "Sorry, only TXT and Word files are allowed.";
        $uploadOk = 0;
    }


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $fileContent = file($target_file);
        $grades = [];
        $results = fopen("results.txt", "w");

        foreach ($fileContent as $line) {
            $parts = preg_split('/\s+/', trim($line));
            if (count($parts) == 3) {
                $name = $parts[0];
                $subject = $parts[1];
                $grade = (int) $parts[2];
                if ($grade != 5) {
                    $raisedGrade = $grade + 1;
                } else {
                    $raisedGrade = $grade;
                }
                $grades[] = ['name' => $name, 'subject' => $subject, 'grade' => $raisedGrade];
                fwrite($results, $name . " " . $subject . " " . $raisedGrade . "\n");
            }
        }
        fclose($results);
    }
}

