<?php require_once "file.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
    <style>
        body {
            background-color: #2039;
        }

        .table {
            border: 4px solid #000;
            width: 50%;
        }
    </style>

</head>

<body>
    <div class="container d-flex justify-content-center">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploader = new GradeFileUploader("uploads/");
            $uploader->uploadFile($_FILES["fileToUpload"]);
            $grades = $uploader->getGrades();
        }
        ?>

        <table id="data" class="table table-bordered mt-5 text-center">
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>Fenn</th>
                    <th>Qiymet</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($grades)): ?>
                    <?php foreach ($grades as $grade): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($grade['name']); ?></td>
                            <td><?php echo htmlspecialchars($grade['subject']); ?></td>
                            <td><?php echo htmlspecialchars($grade['grade']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>