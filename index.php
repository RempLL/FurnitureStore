<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet">
    <link href="http://bootstraptema.ru/plugins/2015/date-range/daterangepicker.css" rel="stylesheet">

</head>

<body>
    <?php
      require "./assets/navbar.php"
      ?>
    <hr>
    <h2 class="text-center">Популярные категории</h2>
    <hr>
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-4 col-md-6 pb-1 pb-md-0 column">
                <div class="card" id="Шкафы" style="cursor:pointer" onclick="gotocatalog(id)">
                    <img class="card-img-top" src="images/homepage/home1.jpg" style="height: 20rem;" alt="Card image cap">
                    <div class="card-img-overlay homepage-card">
                        <h5 class="card-title">Шкафы</h5>
                        <p class="card-text">Универсальная система хранения для вашего дома</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1 pb-md-0 column">
                <div class="card" id="Диваны"style="cursor:pointer" onclick="gotocatalog(id)">
                    <img class="card-img-top" src="images/homepage/home2.jpg" style="height: 20rem;" alt="Card image cap">
                    <div class="card-img-overlay homepage-card">
                        <h5 class="card-title">Диваны</h5>
                        <p class="card-text">Для тех кто ищет диван, сочетающий в себе практичность, комфорт и доступность.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1 pb-md-0 column">
                <div class="card" id="Столы" style="cursor:pointer" onclick="gotocatalog(id)">
                    <img class="card-img-top" src="images/homepage/home3.jpg" style="height: 20rem;" alt="Card image cap">
                    <div class="card-img-overlay homepage-card">
                        <h5 class="card-title">Столы</h5>
                        <p class="card-text">Cамые практичные и стильные столы от производителя.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 pb-1 pb-md-0 column">
                <div class="card" id="Стулья" style="cursor:pointer" onclick="gotocatalog(id)">
                    <img class="card-img-top" src="images/homepage/home4.jpg" style="height: 20rem;" alt="Card image cap">
                    <div class="card-img-overlay homepage-card">
                        <h5 class="card-title">Стулья</h5>
                        <p class="card-text">С нашей помощью вы с легкостью дополните интерьер качественными и стильными стульями.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1 pb-md-0 column">
                <div class="card" id="Матрасы" style="cursor:pointer" onclick="gotocatalog(id)">
                    <img class="card-img-top" src="images/homepage/home5.jpg" style="height: 20rem;" alt="Card image cap">
                    <div class="card-img-overlay homepage-card">
                        <h5 class="card-title">Матрасы</h5>
                        <p class="card-text">Для вас мы подобрали лучшие матрасы для восстановления сил ночью.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1 pb-md-0 column">
                <div class="card" id="Комоды" style="cursor:pointer" onclick="gotocatalog(id)">
                    <img class="card-img-top" src="images/homepage/home6.jpg" style="height: 20rem;" alt="Card image cap">
                    <div class="card-img-overlay homepage-card">
                        <h5 class="card-title">Комоды</h5>
                        <p class="card-text">Удобные и качественные комоды для вашей спальни и гостиной.</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>

    <?php
          require "./assets/footer.php"
?>
    <script src="http://bootstraptema.ru/plugins/2015/date-range/daterangepicker.js"></script>
    <script src="js/bootstrap-4.4.1.js"></script>

    <script type="text/javascript">
        function gotocatalog(id) {
            form = document.createElement("form");
            form.action = "./assets/formHandlers/gotocatalog.php";
            form.method = 'POST';
            form.innerHTML = '<input name="id" value="' + id + '">'
            document.body.append(form);
            form.submit();
        }

    </script>
</body>

</html>
