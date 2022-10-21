<?php

require_once '../../vendor/autoload.php';

use App\Classes\FormValidator;

use App\Classes\FileGenerator;

use App\Classes\DataSorter;

$validator = new FormValidator($_POST);

$fileGenerator = new FileGenerator();


if ($validator->validateForm() == true) {
    $fileGenerator->generateFileWithData($_POST['fileSize']);

    $dataSorter = new DataSorter($fileGenerator->filePath, $_POST['ramSize']);

    $dataSorter->quicksortRun();
    $dataSorter->writeSortedData();

    $result = [];

    $result['path'][] = $fileGenerator->filePath;
    $result['ramSize'][] = $_POST['ramSize'];
    $result['time'][] = $dataSorter->time;
    $result['iterationCount'][] = $dataSorter->iterationCount;

} else {
    header("Location: ../index.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Результат</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
        </div>
        <div class="col">
            <div>
                <h3>Результат:</h3>
                <ul>
                    <?php foreach ($result as $key => $item): ?>
                        <li><?= $item[$key] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="col">
        </div>
    </div>
</div>
</body>
</html>