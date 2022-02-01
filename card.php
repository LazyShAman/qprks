<?php

echo '
    <div class="tab-pane fade mb-2" id="id'. $row['id'] .'">
        <h2>' . $row['ObjectName'] . '</h2>

        <div id="carouselExampleControls'. $i .'" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">';
            $IsAnyActive = False;
                for ($k = 0; $k < count($photos[$i]); $k++) {
                    if ($photos[$i][$k] != NULL) {
                        echo '
                        <div class="carousel-item'; if ($IsAnyActive == false) {echo ' active'; $IsAnyActive = True;}; 
                        echo '">
                            <img class="d-block w-100" src="'. $photos[$i][$k] .'">
                        </div>
                        ';
                    }
                }
            echo '
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls'. $i .'" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls'. $i .'" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="py-4">
                    <h4>Режим работы</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item '; if ($n==1) echo 'today text-dark bg-light'; echo '">'. $row['Monday'] .' - понедельник</li>
                    <li class="list-group-item '; if ($n==2) echo 'today text-dark bg-light'; echo '">'. $row['Tuesday'] .' - вторник</li>
                    <li class="list-group-item '; if ($n==3) echo 'today text-dark bg-light'; echo '">'. $row['Wednesday'] .' - среда</li>
                    <li class="list-group-item '; if ($n==4) echo 'today text-dark bg-light'; echo '">'. $row['Thursday'] .' - четверг</li>
                    <li class="list-group-item '; if ($n==5) echo 'today text-dark bg-light'; echo '">'. $row['Friday'] .' - пятница</li>
                    <li class="list-group-item '; if ($n==6) echo 'today text-dark bg-light'; echo '">'. $row['Saturday'] .' - суббота</li>
                    <li class="list-group-item '; if ($n==0) echo 'today text-dark bg-light'; echo '">'. $row['Sunday'] .' - воскресенье</li>
                </ul>

                <div class="py-4">
                    <h4>Контакты</h4>
                </div>
                <h6>Сайт: <a href="'. $row['WebSite'] .'">'. $row['WebSite'] .'</a></h6>
                <h6>Почта: <a href="mailto:'. $row['Email'] .'">'. $row['Email'] .'</a></h6>
                <h6>Номер: <a href="tel:'. $row['HelpPhone'] .'">'. $row['HelpPhone'] .'</a></h6>
            </div>
            
            <div class="col-lg-6">
            <div class="py-4">
                    <h4>Адрес</h4>
                </div>
                <h6>'. $row['Address'] .', '. $row['District'] .', '. $row['AdmArea'] .'</h6>

                <div id="'. $row['id'] .'" style="width: 100%; height: 400px"></div>
                <script type="text/javascript">
                    ymaps.ready(init);
                    function init() {
                        // Создание карты.
                        var myMap = new ymaps.Map("'. $row['id'] .'", {
                            // Порядок по умолчанию: «широта, долгота».
                            center: ['. $row['Longitude'] .', '. $row['Latitude'] .'],
                            // Уровень масштабирования. Допустимые значения:
                            // от 0 (весь мир) до 19.
                            zoom: 15
                        });

                        myMap.geoObjects
                            .add(new ymaps.Placemark(['. $row['Longitude'] .', '. $row['Latitude'] .'], {
                                balloonContent: "'. $row['ObjectName'] .'"
                            }, {
                                preset: "islands#icon",
                                iconColor: "#0095b6"
                            }));
                    }
                </script>
            </div>
        </div>
    </div>
';

?>