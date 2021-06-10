<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Заказы</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet">
</head>

<body>
    <?php
      require "./assets/navbar.php";
      ?>

    <div class="order-container">
        <?php if ($_SESSION["admin"]){?>
        <div class="input-group" style="margin-bottom:20px;">
            <input type="text" class="form-control" id="search">
            <div class="input-group-append">
                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg></span>
            </div>
        </div>
        <?php } ?>
        <div class="btn-group btn-group-toggle" style="width:100%" data-toggle="buttons">
            <label class="btn btn-outline-secondary" id="olddate">
                <input type="checkbox" autocomplete="off" onchange="orderlist('old')"> Полученные заказы
            </label>
            <label class="btn btn-outline-secondary" id="currentdate">
                <input type="checkbox" autocomplete="off" onchange="orderlist('current')"> Текущие заказы
            </label>
        </div>
        <table style="min-width: 1280px;" class="table table-hover" style="overflow: scroll" id="orderTable">
            <thead>
                <tr>
                    <th>Номер заказа</th>
                    <th>Дата заказа</th>
                    <?php if ($_SESSION["admin"]){?>
                    <th>ФИО заказчика</th>
                    <th>номер телефона</th>
                    <?php } ?>
                    <th>Дата Доставки</th>
                    <th>Адрес Доставки</th>
                    <th>Состав заказа</th>
                    <?php if ($_SESSION["admin"]){?>
                    <th></th>
                    <th></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody id="orderlist">

            </tbody>
        </table>
        <div class="modal show" id="editorder" name="editorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenteredLabel">Редактирование заказа</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="./assets/formHandlers/editorder.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Адрес доставки</label>
                                <input type="text" class="form-control" id="editaddress" name="editaddress" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Выберите дату доставки</label>
                                <input type="text" name="dateedit" id="dateedit" value="01/01/2018" />

                                <div class="invalid-feedback">
                                    Пожалуйста, выберите дату доставки.
                                </div>
                            </div>
                                <button type="button" style="width: 100%" data-toggle="modal" data-target="#addtoord" class="btn btn-outline-warning">Добавить товар
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                </button>

                            <table class="table table-hover" style="overflow: scroll" id="orderTable">
                                <thead>
                                    <tr>
                                        <th>Название товара</th>
                                        <th>Количество товара</th>
                                    </tr>
                                </thead>
                                <tbody id="curorderlist">

                                </tbody>
                            </table>
                            <input type="text" style="display:none" name="mas" id="mass" placeholder="">
                            <input type="text" style="display:none" name="orderidcur" id="orderidcur" placeholder="">

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Сохранить</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


            <div class="modal show" id="addtoord" name="addtoord" tabindex="-1" role="dialog" aria-labelledby="curlabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="curlabel">Добавление в заказ</h5>
                        <button type="button" id="closeadd" name="closeadd" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="selectitem" >Выберите товар</label>
                                <select class="custom-select" id="selectitem" name="selectitem">
                                    <?php $sql = "select * FROM items";
                                    $results= $conn->query($sql);
                                    while ($result = mysqli_fetch_array($results)) {?>
                                          <option value="<?php echo $result['item_id'] ?>"><?php echo $result['item_name'] ?></option>
                                    <?php
                                    }                                
                                    ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="count">Количество товара</label>
                                <input style="width: 100%" type="Number" min="1" id="count" name="count" />

                                <div class="invalid-feedback">
                                    Пожалуйста введите количество товара
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="addtoorderfunction()" class="btn btn-warning">Добавить</button>
                        </div>


                </div>
            </div>
        </div>


    </div>
    <?php
      require "./assets/footer.php";
    ?>
    <script>
        orderlist("current");
        var ordersfortable = [];
var currentorderid
        function orderlist(type) {
            var orderstable = document.getElementById("orderlist");
            orderstable.innerHTML = "";
            switch (type) {

                case "old":
                    document.getElementById("olddate").classList.add("active")
                    document.getElementById("currentdate").classList.remove("active")

                    ordersfortable = ordersarr.filter(item => (new Date() - new Date(item["delivery_date"].substr(0, 10))) > 0);
                    break;
                case "current":
                    document.getElementById("olddate").classList.remove("active")
                    document.getElementById("currentdate").classList.add("active")

                    ordersfortable = ordersarr.filter(item => (new Date() - new Date(item["delivery_date"].substr(0, 10))) < 0);
                    break;
            }
            var curuser = null;
            ordersfortable.map(function(item) {
                var tr = document.createElement('tr')
                tr.innerHTML = ""
                let curitem_in_order = itemsinordersarr.filter(cur => cur["order_id"] == item["order_id"])
                var thid = document.createElement('th');
                var thdate = document.createElement('td');
                var thdeldate = document.createElement('td');
                <?php if ($_SESSION["admin"]){?>
                var FIO = document.createElement('td');
                var phone = document.createElement('td');
                var edit = document.createElement('td');
                var drop = document.createElement('td');
                <?php } ?>
                var thaddr = document.createElement('td');
                var th = document.createElement('td');
                thid.innerHTML = item["order_id"]
                tr.appendChild(thid);
                thdate.innerHTML = item["date"]
                tr.appendChild(thdate);
                <?php if ($_SESSION["admin"]){?>
                curuser = usersarr.filter(user => user["user_id"] == item["user_id"]);
                FIO.innerHTML = curuser[0]["FIO"]
                tr.appendChild(FIO);
                phone.innerHTML = curuser[0]["phone"]
                tr.appendChild(phone);
                <?php } ?>
                thdeldate.innerHTML = item["delivery_date"]
                tr.appendChild(thdeldate);
                thaddr.innerHTML = item["delivery address"]
                tr.appendChild(thaddr);
                let str = "";
                var occurrences = {};
                for (var i = 0; i < curitem_in_order.length; i++) {
                    occurrences[curitem_in_order[i]["item_id"]] = (occurrences[curitem_in_order[i]["item_id"]] || 0) + 1;
                }
                var idmas = Object.keys(occurrences);
                idmas.map(function(cur) {
                    let curitem = itemsarr.filter(id => id["item_id"] == Number(cur))
                    str += curitem[0]["item_name"] + " " + occurrences[cur] + "шт.<br>";
                })
                th.innerHTML = str
                tr.appendChild(th);

                <?php if ($_SESSION["admin"]){?>
                edit.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#6FF66F" class="bi bi-pencil-square edit" onclick="edit(' + item["order_id"] + ')" data-toggle="modal" data-target="#editorder" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/> <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>'
                tr.appendChild(edit);
                drop.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#FF7373" onclick="droporder(' + item["order_id"] + ')"  class="bi bi-trash edit" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>'
                tr.appendChild(drop);
                <?php } ?>

                orderstable.appendChild(tr);
            })
        }




        document.getElementById("search").oninput = function tableSearch() {
            var phrase = document.getElementById('search');
            var table = document.getElementById('orderTable');
            var regPhrase = new RegExp(phrase.value, 'i');
            var flag = false;
            for (var i = 1; i < table.rows.length; i++) {
                flag = false;
                for (var j = table.rows[i].cells.length - 1; j >= 0; j--) {
                    flag = regPhrase.test(table.rows[i].cells[2].innerHTML);
                    if (flag) break;
                }
                if (flag) {
                    table.rows[i].style.display = "";
                } else {
                    table.rows[i].style.display = "none";
                }

            }
        }

        function edit(order) {

            currentorderid = order;
            var occurrences = {};
            let str = "";
            var curorderlist = document.getElementById("curorderlist");
            var address = document.getElementById("editaddress");
            var date = document.getElementById("dateedit");
            var mas = document.getElementById("mass");
            var orderidcur = document.getElementById("orderidcur");
            var curorder = ordersarr.filter(ord => ord["order_id"] == order);
            address.value = curorder[0]["delivery address"]
            date.value = curorder[0]["delivery_date"]
            orderidcur.value = curorder[0]["order_id"]
            curorderlist.innerHTML = "";
            let curitem_in_order = itemsinordersarr.filter(cur => cur["order_id"] == order);
            for (var i = 0; i < curitem_in_order.length; i++) {
                occurrences[curitem_in_order[i]["item_id"]] = (occurrences[curitem_in_order[i]["item_id"]] || 0) + 1;
            }
            var idmas = Object.keys(occurrences);
            var currentorderlisting = [];
            idmas.map(function(cur) {
                var tr = document.createElement('tr')
                var currentitem = [];
                var itemnam = document.createElement('td');
                var itemcount = document.createElement('td');

                let curitem = itemsarr.filter(id => id["item_id"] == Number(cur))

                var select = document.createElement('select');
                var num = document.createElement('input');

                itemsarr.forEach(function(element, key) {
                    if (element["item_name"] == curitem[0]["item_name"]) {
                        select[key] = new Option(element["item_name"], element["item_name"], true, true);
                    } else {
                        select[key] = new Option(element["item_name"], element["item_name"], false, false);

                    }
                });


                currentitem.push(curitem[0]["item_name"])
                currentitem.push(curitem[0]["item_id"])
                currentitem.push(occurrences[cur])
                currentorderlisting.push(currentitem)
                select.value = curitem[0]["item_name"]
                select.classList.add("custom-select")
                select.setAttribute("data-live-search", true)
                var previous = curitem[0]["item_name"]
                select.onchange = function() {
                    var cur = currentorderlisting.filter(item => item[0] == previous);
                    var newcur = [];
                    var forcurid = itemsarr.filter(item => item["item_name"] == select.value)
                    previous = select.value
                    newcur.push(select.value)
                    newcur.push(forcurid[0]["item_id"])
                    newcur.push(Number(num.value))
                    currentorderlisting.forEach(function(item, i) {
                        if (item == cur[0]) currentorderlisting[i] = newcur;
                    });
                    mas.value = JSON.stringify(currentorderlisting);
                    console.log(currentorderlisting)


                }

                itemnam.appendChild(select);
                tr.appendChild(itemnam);
                num.classList.add("form-control")
                num.oninput = function() {
                    var cur = currentorderlisting.filter(item => item[0] == curitem[0]["item_name"]);
                    var newcur = [];
                    newcur.push(select.value)
                    newcur.push(curitem[0]["item_id"])
                    newcur.push(Number(num.value))
                    currentorderlisting.forEach(function(item, i) {
                        if (item == cur[0]) currentorderlisting[i] = newcur;
                    });
                    mas.value = JSON.stringify(currentorderlisting);
                }
                num.value = occurrences[cur]
                itemcount.appendChild(num);
                tr.appendChild(itemcount);
                curorderlist.appendChild(tr);
            })
            mas.value = JSON.stringify(currentorderlisting);

        }

        function droporder(order) {
            console.log()
        }

        function droporder(order) {
            let form = document.createElement('form');
            form.action = "./assets/formHandlers/droporder.php";
            form.method = 'POST';
            form.innerHTML = '<input name="order" value="' + order + '">';
            document.body.append(form);
            form.submit();
        }

            function addtoorderfunction(){
                for (var i = 0; i < document.getElementById("count").value; i++) {
                let max = getMaxValue(itemsinordersarr)+1;
                let obj = {
                    0: max,
                    1: currentorderid,
                    2: document.getElementById("selectitem").options[document.getElementById("selectitem").options.selectedIndex].value,
                    record_id: max,
                    order_id: currentorderid,
                    item_id: document.getElementById("selectitem").options[document.getElementById("selectitem").options.selectedIndex].value
                }
                itemsinordersarr.push(obj);
                console.log(obj)
                console.log(itemsinordersarr)
                }
                edit(currentorderid)
                document.getElementById("closeadd").click();
            }


            function getMaxValue(array){
    var max = Number(array[0]["record_id"]); // берем первый элемент массива
    for (var i = 0; i < array.length; i++) { // переберем весь массив
        // если элемент больше, чем в переменной, то присваиваем его значение переменной
        if (max < Number(array[i]["record_id"])) max = Number(array[i]["record_id"]); 
    }
    // возвращаем максимальное значение
    return max;
}
        $('#dateedit').daterangepicker({
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

    <script src="js/bootstrap-4.4.1.js"></script>
    <script src="js/bootstrap-combobox.js"></script>

</body>

</html>
