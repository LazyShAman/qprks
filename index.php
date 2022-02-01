<?php

$link = mysqli_connect("std-mysql.ist.mospolytech.ru", "std_1607_qprks", "1234567890", "std_1607_qprks");

if ($link == false) {
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
} else {
    print("Соединение установлено успешно");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QPRKs</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=eafd0fd3-a6e9-4550-b324-d9679fa63c0d&lang=ru_RU" type="text/javascript">
    </script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mx-0">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">QPRKs</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#a-list" onclick="togglediv('item')">Откройте список!</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <style>
        h1 {
            overflow: hidden;
            font-size: 8vw;
            text-align: center;
            margin: auto;
            margin-top: 7%;
            display: block;
        }
    </style>
    <section>
        <div class="parallax">
            <h1><a aria-current="page" href="#a-list" onclick="togglediv('item')" class="text-white" style="text-decoration: none;">АКВАПАРКИ МОСКВЫ</a></h1>
        </div>

        <a name="a-list"></a>
    </section>

    <section>
        <div id="item" style="display:none;">
            <div class="py-5">
                <h2 class="text-center">Найдите то, что придется по душе</h2>
            </div>

            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 mt-40">
                    <?php

                    $sql = 'SELECT * FROM `dataset_uni`';

                    echo '<ul class="nav nav-tabs">';

                    $result = mysqli_query($link, $sql);

                    $row = mysqli_fetch_array($result);
                    $temp = $row['ObjectName'];
                    include 'card_name.php';

                    $i = 0;
                    $photos[$i] = explode(" ", $row['Photo']);

                    while ($row = mysqli_fetch_array($result)) {
                        if ($row['ObjectName'] != $temp) {
                            include 'card_name.php';

                            $i += 1;
                            $photos[$i] = explode(" ", $row['Photo']);
                        } else if ($row['Photo'] != NULL) {
                            $photos[$i] = array_merge($photos[$i], explode(" ", $row['Photo']));
                        }
                        $temp = $row['ObjectName'];
                    }

                    echo '</ul>';
                    echo '<div class="tab-content py-4">';

                    $sql = 'SELECT * FROM `dataset_uni`';
                    $result = mysqli_query($link, $sql);

                    date_default_timezone_set("Europe/Moscow");
                    $n = date("w", mktime(0, 0, 0, date("m"), date("d"), date("Y")));

                    $row = mysqli_fetch_array($result);
                    $temp = $row['ObjectName'];
                    $i = 0;
                    include 'card.php';

                    while ($row = mysqli_fetch_array($result)) {
                        if ($row['ObjectName'] != $temp) {
                            $i++;
                            include 'card.php';
                        }
                        $temp = $row['ObjectName'];
                    }

                    echo '</div>';
                    ?>
                </div>
                <div class="col-lg-3"></div>
            </div>
    </section>
    </div>
    <section>
        <div class="parallax">
            <div class="mx-auto mt-4">
                <h5 class="text-white text-center" style="font-size: 1.7vw;">Выполнила Анна Саблина, гр. 201-361</h5>
                <h6 class="text-white text-center" style="font-size: 1.5vw;">Московский Политех | Москва 2022</h6>
            </div>
        </div>
    </section>

    <script>
        function togglediv(id) {
            var div = document.getElementById(id);
            div.style.display = div.style.display == "none" ? "block" : "none";
        }
    </script>
</body>

</html>