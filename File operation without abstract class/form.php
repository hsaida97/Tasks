<?php require_once "file.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container mt-3">
        <h2>Qiymetlerin cedvele daxil edilmesi</h2>
        <form action="table.php" method="POST" enctype="multipart/form-data" class="d-flex flex-column">
            <input type="text" id="docname" name="docname" class="form-control mb-2"
                placeholder="Fayl adini daxil edin">
            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control mb-2" required>
            <input type="submit" name="submit" class="btn btn-primary">
        </form>
    </div>
</body>

</html>