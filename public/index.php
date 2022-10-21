<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Генерация файла с отсортированными целыми числами</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
        </div>
        <div class="col">
            <h3 class="text-center">Форма добавления значений для генерации</h3>
            <form action="show/showInfo.php" method="post">
                <div class="mb-3">
                    <label for="ramSize">Размер используемой ОЗУ: </label><input type="number" name="ramSize">
                </div>
                <div class="mb-3">
                    <label for="fileSize">Размер файла: </label><input type="number" name="fileSize">
                </div>
                <input type="submit" class="btn btn-primary" value="Сгенерировать">
            </form>
        </div>
        <div class="col">
        </div>
    </div>
</div>
</body>
</html>
