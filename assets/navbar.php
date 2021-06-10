<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Документ без названия</title>
    <?php
    session_start();
    require "package/connect_to_database.php";
    require "./assets/package/load.php";
    require "package/catalogHandler.php";
         if (!isset($_SESSION["user_id"])) {
             $_SESSION["user_id"]=false;
         }
        if (!isset($_SESSION["admin"])) {
             $_SESSION["admin"]=false;
         }
    if (!isset($_SESSION["check_login"])) {
             $_SESSION["check_login"]=false;
         }
    if (!isset($_SESSION["check_log"])) {
             $_SESSION["check_log"]=false;
         }
		 
		 if (!isset($_SESSION["catalogtype"])) {
             $_SESSION["catalogtype"]=null;
         }
    ?>
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <!-- Навигация -->

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F5F5F5">
        <div class="container">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Главная</a>
                    </li>
                    <?php
          if($_SESSION["user_id"]){
              ?>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">Мои заказы </a>
                    </li>
                    <?php
          }
          ?>
                    <li class="nav-item">
                        <a class="nav-link" href="catalog.php">Каталог </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="info.php">О нас</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="contacts.php">Контакты</a>
                    </li>
                </ul>
                <div class="d-flex flex-wrap">

                    <?php           if(!$_SESSION["user_id"]){ ?>
                    <button type="button" style=" margin-top: 1vh;margin-bottom: 1vh" class="btn btn-warning" data-toggle="modal" data-target="#Auth">Войти/Зарегистрироваться</button>
                    <?php }           if($_SESSION["user_id"]){ ?>

                    <button class="btn btn-outline-warning" type="button" onclick="showCart()">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="#D6327D" class="bi bi-cart2" viewBox="0 0 16 16">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                            </svg>
                        </span>
                    </button>

                    <a class="btn btn-outline-warning" type="button" href="assets/formHandlers/Exit.php" style="margin-left:20px;">
                        Выйти
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
    <!-- Корзина товаров -->

    <div class="cart" id="allcart" style="display: none;">
        <div class="cart-top" id="Cart">

        </div>
        <div class="d-flex justify-content-between itogo" id="itogo">
            <div class="p-2">
                <h5 id="summ"></h5>
            </div>
            <div class="p-2"><button class="btn btn-outline-warning" data-toggle="modal" data-target="#order" id="createorder">Оформить заказ</button></div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal3Label">Оформить заказ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" action='assets/formHandlers/Order.php' method='post'>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="formGroupExampleInput">Введите адрес доставки</label>
                            <input type="text" class="form-control" id="addressdel" name="addressdel">
                            <div class="invalid-feedback">
                                Пожалуйста, введите адрес доставки.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Выберите дату доставки</label>
                            <input type="text" name="daterange" id="daterange" value="01/01/2018" />

                            <div class="invalid-feedback">
                                Пожалуйста, выберите дату доставки.
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" style="display:none" name="itemmas" id="itemmas" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" onClick="test()" class="btn btn-outline-warning">Заказать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal" id="Auth" tabindex="-1" role="Auth" aria-labelledby="AuthLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AuthLabel">Вход</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="./assets/formHandlers/Auth.php" method="post" id="entered" class="needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="form-group" style="position: relative">
                            <label for="categoryname">Логин:</label>
                            <input type="email" class="form-control" name="login_login" id="login_login" placeholder="" autocomplete="on" required>
                            <div class="invalid-tooltip">
                                Введите логин
                            </div>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="categoryname">Пароль:</label>
                            <input type="password" class="form-control" name="login_password" id="login_password" placeholder="" autocomplete="off" required>
                            <div class="invalid-tooltip">
                                Введите пароль
                            </div>
                        </div>

                        <h6 class="text-danger" style="display: none;" id="check_password_login">*Неверные логин и пароль*</h6>
                    </div>
                    <div class="modal-footer" style="justify-content: space-between">
                        <button type="submit" class="btn btn-warning">Войти</button>
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal" data-toggle="modal" data-target="#Registration">Зарегистрироваться</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Модалки регистрации -->

    <div class="modal" id="Registration" tabindex="-2" role="Registration" aria-labelledby="RegistrationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RegistrationLabel">Регистрация</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="./assets/formHandlers/Reg.php" method="post" class="needs-validation" novalidate>
                    <div class="modal-body">


                        <div class="form-group" style="position: relative">
                            <label for="name">Введите имя</label>
                            <input type="text" pattern="[а-яА-Я]{1,20}" class="form-control" name="name" id="name" placeholder="" required>
                            <div class="invalid-tooltip">
                                Введите имя
                            </div>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="surname">Введите фамилию</label>
                            <input type="text" pattern="[а-яА-Я]{1,20}" class="form-control" name="surname" id="surname" placeholder="" required>
                            <div class="invalid-tooltip">
                                Введите фамилию
                            </div>
                        </div>

                        <div class="form-group" style="position: relative">
                            <label for="login_registration">Введите электронную почту</label>
                            <input type="email" class="form-control" name="login_registration" id="login_registration" placeholder="" autocomplete="off" required>
                            <div class="invalid-tooltip">
                                Введите электронную почту
                            </div>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="categopassword_registrationryname">Введите пароль</label>
                            <input type="text" class="form-control" name="password_registration" autocomplete="off" id="password_registration" placeholder="" required>
                            <div class="invalid-tooltip">
                                Введите пароль
                            </div>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="second_password">Повторите пароль</label>
                            <input type="text" class="form-control" name="second_password" autocomplete="off" id="second_password" placeholder="" required>
                            <div class="invalid-tooltip">
                                Введите пароль
                            </div>
                        </div>
                        <h6 class="text-danger" style="display: none;" id="check_same_password">*Пароли не совпадают*</h6>

                        <div class="form-group" style="position: relative">
                            <label for="phone_number">Введите номер телефона</label>
                            <input type="tel" pattern="+7([0-9]{3})[0-9]{3}-[0-9]{4}" class="form-control input-medium bfh-phone" id="phone_number" name="phone_number" autocomplete="off" required>
                            <div class="invalid-tooltip">
                                Введите номер телефона
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer" style="justify-content: space-between">
                        <button type="submit" class="btn btn-warning" onClick="validate_reg_form()">Зарегистрироваться</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
if ($_SESSION["check_log"]) {
             ?>
    <div class="toast fade show" style="position: absolute;bottom: 0px;right: 0px;" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Ошибка</strong>
            <small></small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Неверные логин или пароль
        </div>
    </div>
    <?php }

if ($_SESSION["check_login"]) {
             ?>
    <div class="toast fade show" style="position: absolute;bottom: 0px;right: 0px;" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Ошибка</strong>
            <small></small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Данный логин занят, выберите другой
        </div>
    </div>
    <?php } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>
    <script type="text/javascript">
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // вешаем маску на телефон
        $('#phone_number').inputmask("+7(999)999-9999");

        // добавляем правило для валидации телефона
        jQuery.validator.addMethod("checkMaskPhone", function(value, element) {
            return /\+\d{1}\(\d{3}\)\d{3}-\d{4}/g.test(value);
        });

        // получаем нашу форму по class
        var form = $('#registrate');

        // включаем валидацию в форме
        form.validate();

        // вешаем валидацию на поле с телефоном по классу
        $.validator.addClassRules({
            'phone-field': {
                checkMaskPhone: true,
            }
        });

    </script>
</body>
<script type="text/javascript">
    var cartitemsstr
    <?php
    if($_SESSION["clear_storage"]==true){?>
    localStorage.clear();
    <?php
    }
         $_SESSION["clear_storage"]=false;

    ?>
    cartitemsstr = localStorage.getItem("cartitems");
    console.log(cartitemsstr)
    if (cartitemsstr == null) {
        var cartitems = [];
        document.getElementById("createorder").disabled = true;

    } else {
        var cartitems = cartitemsstr.split(',');
    }


    inputCart(window.cartitems)

    function showCart() {
        var Cart = document.getElementById("allcart");
        if (Cart.style.display == "none") {
            Cart.style.display = "block"
        } else if (Cart.style.display == "block") {
            Cart.style.display = "none";

        }
    }

    function inputCart(array) {

        document.getElementById("itemmas").value = JSON.stringify(array);
        var Cartcatalog = document.getElementById("Cart")
        Cartcatalog.innerHTML = "";
        var occurrences = {};

        let summ = document.getElementById("summ");
        let summa = 0;
        for (var i = 0; i < array.length; i++) {
            occurrences[array[i]] = (occurrences[array[i]] || 0) + 1;
        }
        var inuse = [];
        array.forEach(function(item, i, array) {
            if (item == "") {
                return;
            } else {
                let curitem = window.itemsarr.filter(arritem => arritem["item_id"] == item);
                if (inuse.includes(item)) {
                    return;
                } else {
                    summa += (Number(curitem[0]["cost"]) * Number(occurrences[curitem[0]["item_id"]]));
                    let media = document.createElement("div");
                    media.className = "media";
                    media.innerHTML = '<img class="d-flex mr-3" style="width: 100px; height:80px;" src="' + curitem[0]["photo_link"] + '" alt="Generic placeholder image"><div class="media-body"><h5 class="mt-0">' + curitem[0]["item_name"] + '</h5><div class="d-flex justify-content-between align-content-center"><div class="p-2"><div class="input-group form-inline"><div class="input-group-prepend" style ="width: 3rem;"><button class="btn btn-warning" type="button" onclick="minusfromCart(' + curitem[0]["item_id"] + ')">-</button></div><input type="text" class="form-control" value="' + Number(occurrences[curitem[0]["item_id"]]) + 'шт.   ' + (Number(curitem[0]["cost"]) * Number(occurrences[curitem[0]["item_id"]])) + 'р." placeholder="" aria-label="" aria-describedby="basic - addon1 "><div class="input-group-append" style ="width: 3rem;"><button class="btn btn-warning " type="button" onclick="plusfromCart(' + curitem[0]["item_id"] + ')">+</button></div></div> </div><div class="p-2 d-flex flex-wrap align-content-center"><button class="deletefromCart " onclick="deletefromCart(' + item + ')"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"25 \" height=\"25 \" fill=\"#A2000C\" class=\"bi bi-trash\" viewBox=\"0 0 16 16\"><path d=\"M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z\"/><path fill-rule=\"evenodd\" d=\"M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z\"/></svg></button></div></div></div>';
                    Cartcatalog.appendChild(media);
                    inuse.push(item);
                }
            }

        })
        var test = cartitems.filter(item => item != "")
        createorder = document.getElementById("createorder")
        if (test.length == 0) {
            createorder.disabled = true;
            createorder.className = "btn btn-warning"
        } else {
            createorder.disabled = false;
            createorder.className = "btn btn-outline-warning"

        }
        summ.innerHTML = "Итого: " + summa + "р.";
    }

    function deletefromCart(item_id) {
        while (window.cartitems.indexOf(String(item_id)) != -1) {
            delete window.cartitems[window.cartitems.indexOf(String(item_id))];
        }
        window.cartitems = window.cartitems.filter(item => item != "")
        localStorage.setItem("cartitems", window.cartitems.join());
        document.getElementById("itemmas").value = JSON.stringify(window.cartitems);
        inputCart(cartitems)

    }

    function plusfromCart(item_id) {
        window.cartitems.push(String(item_id));
        localStorage.setItem("cartitems", window.cartitems.join());
        inputCart(cartitems)
    }

    function minusfromCart(item_id) {
        console.log(window.cartitems);
        console.log(window.cartitems.indexOf(String(item_id)));

        delete window.cartitems[window.cartitems.indexOf(String(item_id))];
        localStorage.setItem("cartitems", window.cartitems.join());
        inputCart(cartitems)
    }



    let inp = document.querySelector('#phone_number');

    // Проверяем фокус
    inp.addEventListener('focus', _ => {
        // Если там ничего нет или есть, но левое
        if (!/^\+\d*$/.test(inp.value))
            // То вставляем знак плюса как значение
            inp.value = '+';
    });

    inp.addEventListener('keypress', e => {
        // Отменяем ввод не цифр
        if (!/\d/.test(e.key))
            e.preventDefault();
    });

</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
    $('#daterange').daterangepicker({
        "singleDatePicker": true,
        "timePicker": true,
        "timePicker24Hour": true,
        "timePickerIncrement": 30,
        minDate: new Date(),
        "locale": {
            "format": "YYYY-MM-DD HH:mm",
            "separator": " - ",
            "applyLabel": "Выбрать",
            "cancelLabel": "Отменить",
            "fromLabel": "От",
            "toLabel": "До",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "Вс",
                "Пн",
                "Вт",
                "Ср",
                "Чт",
                "Пт",
                "Сб"
            ],
            "monthNames": [
                "Январь",
                "Февраль",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь"
            ],
            "firstDay": 1
        },
        "autoApply": true,
        "linkedCalendars": false,
        "showCustomRangeLabel": false,
        "alwaysShowCalendars": true,
        "opens": "center",
        "buttonClasses": "btn btn-sm btn-warning"
    }, function(start, end, label) {

    });

</script>

</html>
