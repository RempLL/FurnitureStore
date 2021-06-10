<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Каталог</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet">
</head>

<body>
    <?php
      require "./assets/navbar.php";
      ?>
    <div class="container" id="item" style="margin-top: 2vh; display: none">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-12 col-md-6 col-lg-4">
                <img src="images/homepage/home4.jpg" class="item-photo" alt="" id="itemphoto">
            </div>
            <div class="col-12 col-md-6 col-lg-8 ">
                <h2 id="itemname">Товар</h2>
                <p id=itemdescription>Описание</p>
                <div class="align-items-center">
                    <h5 id=itemcost>Описание</h5>
                    <button id="purch_btn" class="btn btn<?php if($_SESSION["user_id"]) echo "-outline"?>-warning" <?php if(!$_SESSION["user_id"]) echo "disabled" ?>>Добавить в корзину</button>
                </div>
            </div>
            <button class="close_item" onclick="closeitem()">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>

            </button>
        </div>
        <div class="row">
            <table class="table table-reflow">
                <tbody>
                    <tr>
                        <th scope="row">Цвет</th>
                        <td id="charcolour">Table cell</td>
                    </tr>
                    <tr>
                        <th scope="row">Материал</th>
                        <td id="charmaterial">Table cell</td>
                    </tr>
                    <tr>
                        <th scope="row">Производитель</th>
                        <td id="charmaker">Table cell</td>
                    </tr>
                    <tr>
                        <th scope="row">В наличии</th>
                        <td id="charquantity">Table cell</td>
                    </tr>
                    <tr>
                        <th scope="row">Длина</th>
                        <td id="charlength">Table cell</td>
                    </tr>
                    <tr>
                        <th scope="row">Ширина</th>
                        <td id="charwidth">Table cell</td>
                    </tr>
                    <tr>
                        <th scope="row">Высота</th>
                        <td id="charheight">Table cell</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="container" style="margin-top: 2vh" id="catalog_page">
        <nav aria-label="breadcrumb" id="cat_nav">
            <ol class="breadcrumb" id="catalog_navigation">
            </ol>
        </nav>
        <?php if ($_SESSION["admin"]){  ?> <div class="d-flex justify-content-end" style="width:100%;margin-bottom:10px">
            <button type="button" onclick="addeditcat('null','category')" data-toggle="modal" data-target="#categoryaddedit" class="btn btn-outline-warning" id="addeditsmthng">Добавить категорию</button>
        </div>
        <?php } ?>

        <div id="sort" style="display:none;">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sort-nav" aria-controls="sort-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" style="flex-direction:column;" id="sort-nav" style="padding-bottom:10px;">
                    <ul class="navbar-nav mr-auto catalog-sort">
                        <li class="nav-item sort-element" id="sort-price">
                            <div>
                                <h5>Цена</h5>
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 44px;margin-bottom:10px">
                                        <span class="input-group-text">От</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" onchange="min_price(this.value)">

                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend" style="width: 44px;margin-bottom:10px">
                                    <span class="input-group-text">До</span>
                                </div>
                                <input type="number" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" onchange="max_price(this.value)">
                            </div>
                        </li>
                        <li class="nav-item sort-element">
                            <h5>Цвет</h5>
                            <select class="custom-select" id="sort_colour" onchange="colourselect(this.value)">
                                <option value="0" selected></option>
                                <option value="Черный">Черный</option>
                                <option value="Белый">Белый</option>
                                <option value="Коричневый">Коричневый</option>
                                <option value="Бежевый">Бежевый</option>
                                <option value="Красный">Красный</option>
                                <option value="Зеленый">Зеленый</option>
                                <option value="Желтый">Желтый</option>
                                <option value="Синий">Синий</option>
                                <option value="Голубой">Голубой</option>
                                <option value="Фиолетовый">Фиолетовый</option>
								<option value="Разноцветный">Разноцветный</option>
                            </select>
                            <h5>Материал</h5>
                            <select class="custom-select" id="sort_material" onchange="materialselect(this.value)">
                                <option value="0" selected></option>
                                <option value="Кожа">Кожа</option>
                                <option value="Каучук">Каучук</option>
                                <option value="Кож. зам">Кож. зам</option>
                            </select>
                        </li>
                        <li class="nav-item sort-element">
                            <h5>Производитель</h5>
                            <select class="custom-select" id="sort_maker" onchange="makerselect(this.value)">
                                <option value="0" selected></option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <h5>В наличии</h5>
                            <select class="custom-select" id="sort-maker" onchange="quantityselect(this.value)">
                                <option value="0">Не выбрано</option>
                                <option value="yes">В наличии</option>
                                <option value="no">Сейчас нет</option>
                            </select>
                        </li>
                    </ul>
                    <ul class="navbar-nav mr-auto catalog-sort" style="margin-top:20px">
                        <li class="nav-item sort-element" id="sort-price">
                            <div>
                                <div class="input-group" style="margin-bottom:10px">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Ширина</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" onchange="max_width(this.value)">

                                </div>
                            </div>
                        </li>
                        <li class="nav-item sort-element" id="sort-price">
                            <div>
                                <div class="input-group" style="margin-bottom:10px">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Длина</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" onchange="max_length(this.value)">
                                </div>
                            </div>
                        </li>
                        <li class="nav-item sort-element" id="sort-price">
                            <div>
                                <div class="input-group" style="margin-bottom:10px">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Высота</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" onchange="max_height(this.value)">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>



        <div class="row text-center" id="catalog" style="margin-top:10px;">

        </div>
    </div>
    <div class="modal" id="categoryaddedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="position:relative">
                <form enctype="multipart/form-data" action="./assets/formHandlers/addedit.php" method="post" class="needs-validation" novalidate>
                    <input type="text" style="display:none" name="addeditype" id="addeditypecat" placeholder="">
                    <input type="text" style="display:none" name="item" id="curcategory" placeholder="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cataddedittitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" style="position: relative">
                            <label for="categoryname">Название категории</label>
                            <input type="text" pattern="[а-яА-Я\s]{1,30}" class="form-control" name="categoryname" id="categoryname" placeholder="" required>
                            <div class="invalid-tooltip">
                                Пожалуйста введите название категории
                            </div>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="categorydescription">Описание категории</label>
                            <input type="text" class="form-control" pattern="^[А-Яа-яЁё\s-.?!)(,:]+$" name="categorydescription" id="categorydescription" required>
                            <div class="invalid-tooltip">
                                Пожалуйста введите описание категории
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="categoryfile" name="file" accept="image/jpeg,image/jpg" lang="ru" required>
                            <label class="custom-file-label" for="categoryfile">Выберите фото</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" onclick="checkform()" class="btn btn-warning">Сохранить</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



    <div class="modal" id="subcategoryaddedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" action="./assets/formHandlers/addedit.php" method="post" class="needs-validation" novalidate>
                    <input type="text" style="display:none" name="addeditype" id="addeditypesub">
                    <input type="text" style="display:none" name="item" id="cursubcategory">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subcataddedittitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" style="position: relative">
                            <label for="subcategoryname">Название подкатегории</label>
                            <input type="text" pattern="[а-яА-ЯЁё\s-.?!)(,:]{1,40}" class="form-control" name="subcategoryname" id="subcategoryname" placeholder="" required>
                            <div class="invalid-tooltip">
                                Пожалуйста введите название подкатегории
                            </div>
                        </div>

                        <div class="form-group" style="position: relative">
                            <label for="subcategorycatselect" class="form-label">Выберите категорию</label>
                            <select class="form-select custom-select" name="subcategorycatselect" id="subcategorycatselect" required>
                            </select>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-group" style="position: relative">
                            <label for="subcategorydescription">Описание подкатегории</label>
                            <input type="text" class="form-control" pattern="^[А-Яа-яЁё\s-.?!)(,:]+$" name="subcategorydescription" id="subcategorydescription" required>
                            <div class="invalid-tooltip">
                                Пожалуйста введите описание подкатегории
                            </div>
                        </div>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="subcategoryfile" accept="image/jpeg,image/jpg" lang="ru" name="file" required>
                            <label class="custom-file-label" for="subcategoryfile">Выберите фото</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" onclick="checkform()" class="btn btn-warning">Сохранить</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal bd-example-modal-xl" id="itemaddedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" action="./assets/formHandlers/addedit.php" method="post" class="needs-validation" novalidate>
                    <input type="text" style="display:none" name="addeditype" id="addeditypeitem">
                    <input type="text" style="display:none" name="item" id="curitem">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemaddedittitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" style="position: relative">
                            <label for="itemnameadd">Название товара</label>
                            <input type="text" pattern="[A-Za-zа-яА-ЯЁё\s-.?!)(,:]{1,40}" class="form-control" name="itemnameadd" id="itemnameadd" placeholder="" required>
                            <div class="invalid-tooltip">
                                Пожалуйста введите название товара
                            </div>
                        </div>

                        <div class="form-group" style="position: relative">
                            <label for="itemsubselect" class="form-label">Выберите подкатегорию</label>
                            <select class="form-select custom-select" id="itemsubselect" name="itemsubselect" required>
                            </select>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-group" style="position: relative">
                            <label for="itemdescription">Описание товара</label>
                            <input type="text" class="form-control" pattern="^[А-Яа-яЁё\s-.?!)(,:]+$" name="itemdescription" id="itemdescription" required>
                            <div class="invalid-tooltip">
                                Пожалуйста введите описание товара
                            </div>
                        </div>
                        <div class="input-group" style="justify-content: space-between">
                            <div class="form-group" style="position: relative; width:20rem;">
                                <label for="itemlength">Длина товара</label>
                                <input type="text" class="form-control" pattern="[0-9]{1,10}" name="itemlength" id="itemlength" required>
                            </div>
                            <div class="form-group" style="position: relative; width:20rem;">
                                <label for="itemwidth">Ширина товара</label>
                                <input type="text" class="form-control" pattern="[0-9]{1,10}" name="itemwidth" id="itemwidth" required>

                            </div>
                            <div class="form-group" style="position: relative; width:20rem;">
                                <label for="itemheight">Высота товара</label>
                                <input type="text" class="form-control" pattern="[0-9]{1,10}" name="itemheight" id="itemheight" required>

                            </div>
                        </div>

                        <div class="input-group" style="justify-content: space-between">
                            <div class="form-group" style="position: relative; width:20rem;">
                                <label for="itemseleсtcolour" class="form-label">Выберите цвет</label>
                                <select class="form-select custom-select" name="itemseleсtcolour" id="itemseleсtcolour" required>
                                    <option value="" disabled selected></option>
                                    <option value="Черный">Черный</option>
                                    <option value="Белый">Белый</option>
                                    <option value="Коричневый">Коричневый</option>
                                    <option value="Бежевый">Бежевый</option>
                                    <option value="Красный">Красный</option>
                                    <option value="Зеленый">Зеленый</option>
                                    <option value="Желтый">Желтый</option>
                                    <option value="Синий">Синий</option>
                                    <option value="Голубой">Голубой</option>
                                    <option value="Фиолетовый">Фиолетовый</option>
                                    <option value="Розовый">Розовый</option>
									<option value="Разноцветный">Разноцветный</option>
                                </select>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="form-group" style="position: relative; width:20rem;">
                                <label for="itemseleсtmat" class="form-label">Выберите материал</label>
                                <select class="form-select custom-select" name="itemseleсtmat" id="itemseleсtmat" required>
                                    <option value="" disabled selected></option>
                                    <option value="жаккард">жаккард</option>
                                    <option value="трикотаж">трикотаж</option>
                                    <option value="поликоттон">поликоттон</option>
                                    <option value="стекло">стекло</option>
                                    <option value="металл">металл</option>
                                    <option value="дерево">дерево</option>
                                    <option value="пластик">пластик</option>
                                    <option value="флок">флок</option>
                                    <option value="кожа">кожа</option>
                                </select>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="form-group" style="position: relative; width:20rem;">
                                <label for="itemseleсtmaker" class="form-label">Выберите производителя</label>
                                <select class="form-select custom-select" id="itemseleсtmaker" name="itemseleсtmaker" required>
                                    <option value="" disabled selected></option>
                                    <option value="Pushe">Pushe</option>
                                    <option value="E-style">E-style</option>
                                    <option value="ROM">ROM</option>
                                    <option value="Woodville">Woodville</option>
                                    <option value="Kartell">Kartell</option>
                                    <option value="R-home">R-home</option>
                                    <option value="Hoff">Hoff</option>
                                    <option value="La Forma">La Forma</option>
                                    <option value="Horeca">Horeca</option>
                                    <option value="ESTA">ESTA</option>
                                    <option value="Askona">Askona</option>
                                    <option value="Dreamline">Dreamline</option>
                                </select>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="input-group" style="justify-content: space-between">
                            <div class="form-group" style="position: relative; width:30rem;">
                                <label for="itemquantity">Количество товара</label>
                                <input type="text" class="form-control" pattern="[0-9]{1,10}" name="itemquantity" id="itemquantity" required>
                            </div>
                            <div class="form-group" style="position: relative; width:30rem;">
                                <label for="additemcost">Цена единицы товара</label>
                                <input type="text" class="form-control" pattern="[0-9]{1,10}" name="additemcost" id="additemcost" required>

                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="itemfile" accept="image/jpeg,image/jpg" name="file" lang="ru" required>
                            <label class="custom-file-label" for="itemfile">Выберите фото</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" onclick="checkform()" class="btn btn-warning">Сохранить</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



    <?php
      require "./assets/footer.php";
      require "./assets/package/catalogHandler.php";

      ?>
    <script type="text/javascript">
        catalog = document.getElementById("catalog");
        catalog_navigation = document.getElementById("catalog_navigation");
        <?php if ($_SESSION["admin"]){  ?>

        addeditsmthng = document.getElementById("addeditsmthng");
        <?php }?>
        sort = document.getElementById("sort");
        let categorynow = "";
        let subcategorynow = "";
        let sortarr = [];
        let div = document.createElement('div');
                showelements(categoriesarr, "category");

        <?php if($_SESSION["catalogtype"]!=null){ ?>
        search_subcategories('<?php echo $_SESSION["catalogtype"] ?>')
        <?php
                                                }
		$_SESSION["catalogtype"]=null;
        ?>

        function showelements(array, type) {
            catalog.innerHTML = "";
            <?php if ($_SESSION["admin"]){  ?>

            switch (type) {

                case "category":
                    addeditsmthng.innerHTML = "Добавить категорию";
                    addeditsmthng.setAttribute("data-target", "#categoryaddedit");
                    addeditsmthng.setAttribute('onclick', "addeditcat(null, 'category')");

                    break;
                case "subcategory":
                    addeditsmthng.innerHTML = "Добавить подкатегорию";
                    addeditsmthng.setAttribute("data-target", "#subcategoryaddedit");
                    addeditsmthng.setAttribute('onclick', "addeditcat(null, 'subcategory')");

                    break;
                case "item":
                    addeditsmthng.innerHTML = "Добавить Товар";
                    addeditsmthng.setAttribute("data-target", "#itemaddedit");
                    addeditsmthng.setAttribute('onclick', "addeditcat(null, 'item')");
                    break;
            }
            <?php }?>

            array.map(function(item) {
                div = document.createElement('div');
                div.className = "col-xl-3 col-lg-4 col-sm-6 col-12";
                div.style.marginBottom = "20px"

                let admin = "";
                <?php
                    if ($_SESSION["admin"]){
                    ?>
                admin = '<div class="d-flex justify-content-center" ><div class="p-2"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#6FF66F" class="bi bi-pencil-square edit" onclick="addeditcat(\'' + item[0].valueOf() + '\',\'' + type + '\')"data-toggle="modal" data-target="#' + type + 'addedit" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/> <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg></div> <div class="p-2"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#FF7373" onclick="dropcat(\'' + item[0].valueOf() + '\',\'' + type + '\')"  class="bi bi-trash edit" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></div></div>'
                <?php }?>

                if (type === "category") {
                    sort.style.display = "none";


                    div.innerHTML = "<div class='card catalog_card'><img class='card-img-top' onclick='search_subcategories(\"" + item[0].valueOf() + "\")')  src='" + item["photo_link"] + "' alt='Card image cap'><div class='card-body catalog_category_name' onclick='search_subcategories(\"" + item[0].valueOf() + "\")')><p  class='card-text'>" + item[type + "_name"] + "</p></div>" + admin + "</div> "




                    catalog_navigation.innerHTML = '<li id="catalog_catalog" class="breadcrumb-item active" aria-current="page" onclick="showelements(categoriesarr, \'category\')" style="cursor: pointer;">Каталог</li>';




                }
                if (type === "subcategory") {
                    sort.style.display = "none";

                    div.innerHTML = "<div class='card catalog_card'><img class='card-img-top' onclick='search_items(\"" + item[0].valueOf() + "\")') src='" + item["photo_link"] + "' alt='Card image cap'><div class='card-body catalog_category_name' onclick='search_items(\"" + item[0].valueOf() + "\")')><p class='card-text'>" + item[type + "_name"] + "</p></div>" + admin + "</div>"

                    catalog_navigation.innerHTML = '<li id="catalog_catalog" class="breadcrumb-item active" aria-current="page" onclick="showelements(categoriesarr, \'category\')" style="cursor: pointer;">Каталог</li><li id="catalog_category" class="breadcrumb-item active" aria-current="page" onclick="search_subcategories(categorynow)" style="cursor: pointer;">' + categorynow + '</li>';




                }
                if (type === "item") {
                    sort.style.display = "block";

                    div.innerHTML = "<div class='card catalog_card' ><img onclick='openProduct(\"" + item['item_id'].valueOf() + "\")' class='card-img-top'  src='" + item["photo_link"] + "'><div class='card-body catalog_category_name'><h5 class='card-title' onclick='openProduct(\"" + item['item_id'].valueOf() + "\")'>" + item['item_name'] + "</h5><h6 class='card-title' onclick='openProduct(\"" + item['item_id'].valueOf() + "\")'>" + item['cost'] + "р.</h6><button id='additem" + item['item_id'] + "' class='btn <?php if($_SESSION["user_id"]) echo "btn-outline-warning" ?> <?php if(!$_SESSION["user_id"]) echo "btn-warning" ?>' style='margin-bottom: 10px;' onclick='ItemToCart(\"" + item['item_id'].valueOf() + "\")'  <?php if(!$_SESSION["user_id"]) echo "disabled" ?> >В корзину</button></div>" + admin + "</div>"

                    catalog_navigation.innerHTML = '<li id="catalog_catalog" class="breadcrumb-item active" aria-current="page" onclick="showelements(categoriesarr, \'category\')" style="cursor: pointer;">Каталог</li><li id="catalog_category" class="breadcrumb-item active" aria-current="page" onclick="search_subcategories(categorynow)" style="cursor: pointer;">' + categorynow + '</li><li id="catalog_subcategory" class="breadcrumb-item active" aria-current="page" onclick="search_items(subcategorynow)" style="cursor: pointer;">' + subcategorynow + '</li>';



                }
                catalog.appendChild(div);
            })
        }



        function addeditcat(cat, type) {
            document.getElementById("categoryname").value = null;
            document.getElementById("categorydescription").value = null;
            document.getElementById("categoryname").value = null;
            if (cat != null) {
                switch (type) {

                    case "category":
                        var curcategory = categoriesarr.filter(item => item["category_name"] == cat);
                        document.getElementById("cataddedittitle").innerHTML = "Редактирование категории"
                        document.getElementById("categoryname").value = curcategory[0]["category_name"]
                        document.getElementById("curcategory").value = curcategory[0]["category_name"]
                        document.getElementById("addeditypecat").value = "category"
                        document.getElementById("categorydescription").value = curcategory[0]["description"]
                        document.getElementById("categoryfile").required = false;
                        break;
                    case "subcategory":
                        var subcurcategory = subcategoriesarr.filter(item => item["subcategory_name"] == cat);
                        document.getElementById("subcataddedittitle").innerHTML = "Редактирование подкатегории"
                        document.getElementById("subcategoryname").value = subcurcategory[0]["subcategory_name"]
                        document.getElementById("cursubcategory").value = subcurcategory[0]["subcategory_name"]
                        document.getElementById("addeditypesub").value = "subcategory"
                        document.getElementById("subcategorydescription").value = subcurcategory[0]["description"]
                        document.getElementById("subcategoryfile").required = false;
                        categoriesarr.forEach(function(element, key) {
                            if (element["category_name"] == subcurcategory[0]["category_name"]) {
                                document.getElementById("subcategorycatselect")[key] = new Option(element["category_name"], element["category_name"], true, true);
                            } else {
                                document.getElementById("subcategorycatselect")[key] = new Option(element["category_name"], element["category_name"], false, false);
                            }

                        });
                        break;
                    case "item":
                        var item = itemsarr.filter(item => item["item_id"] == cat);
                        console.log(item);
                        document.getElementById("itemaddedittitle").innerHTML = "Редактирование товара"
                        document.getElementById("itemnameadd").value = item[0]["item_name"]
                        document.getElementById("curitem").value = item[0]["item_name"]
                        document.getElementById("addeditypeitem").value = "item"
                        document.getElementById("itemdescription").value = item[0]["description"]
                        document.getElementById("itemlength").value = item[0]["length"]
                        document.getElementById("itemwidth").value = item[0]["width"]
                        document.getElementById("itemheight").value = item[0]["height"]
                        document.getElementById("itemquantity").value = item[0]["quantity"]
                        document.getElementById("additemcost").value = item[0]["cost"]


                        document.querySelector('#itemseleсtcolour').value = item[0]["colour"]
                        document.querySelector('#itemseleсtmat').value = item[0]["material"]
                        document.querySelector('#itemseleсtmaker').value = item[0]["maker"]
                        document.getElementById("itemfile").required = false;
                        var cursub = subcategoriesarr.filter(item => item["category_name"] == String(categorynow));
                        document.getElementById("itemsubselect").innerHTML = ""
                        cursub.forEach(function(element, key) {
                            if (element["subcategory_name"] == item[0]["subcategory_name"]) {
                                document.getElementById("itemsubselect")[key] = new Option(element["subcategory_name"], element["subcategory_name"], true, true);
                            } else {
                                document.getElementById("itemsubselect")[key] = new Option(element["category_name"], element["subcategory_name"], false, false);
                            }

                        });
                        break;
                }
            } else {
                switch (type) {

                    case "category":
                        document.getElementById("categoryname").value = ""
                        document.getElementById("categorydescription").value = ""

                        document.getElementById("categoryfile").required = true;
                        document.getElementById("cataddedittitle").innerHTML = "Добавление категории"
                        document.getElementById("curcategory").value = "null"
                        document.getElementById("addeditypecat").value = "category"
                        break;
                    case "subcategory":
                        document.getElementById("subcategoryfile").required = true;
                        document.getElementById("subcataddedittitle").innerHTML = "Добавление подкатегории"
                        document.getElementById("cursubcategory").value = "null"
                        document.getElementById("addeditypesub").value = "subcategory"
                        document.getElementById("subcategoryname").value = ""
                        document.getElementById("subcategorydescription").value = ""
                        categoriesarr.forEach(function(element, key) {
                            document.getElementById("subcategorycatselect")[key] = new Option(element["category_name"], element["category_name"], false, false);
                        });
                        break;
                    case "item":
                        document.getElementById("itemfile").required = true;
                        document.getElementById("itemaddedittitle").innerHTML = "Добавление товара"
                        document.getElementById("curitem").value = "null";
                        document.getElementById("addeditypeitem").value = "item";
                        document.getElementById("itemsubselect").innerHTML = ""

                        document.getElementById("itemnameadd").value = ""

                        document.getElementById("itemdescription").value = ""
                        document.getElementById("itemlength").value = ""
                        document.getElementById("itemwidth").value = ""
                        document.getElementById("itemheight").value = ""
                        document.getElementById("itemquantity").value = ""
                        document.getElementById("additemcost").value = ""
                        document.querySelector('#itemseleсtcolour').value = ""
                        document.querySelector('#itemseleсtmat').value = ""
                        document.querySelector('#itemseleсtmaker').value = ""


                        console.log(categorynow)
                        var cursub = subcategoriesarr.filter(item => item["category_name"] == String(categorynow));
                        cursub.forEach(function(element, key) {
                            document.getElementById("itemsubselect")[key] = new Option(element["subcategory_name"], element["subcategory_name"], false, false);
                        });
                        break;
                        break;
                }
            }
        }

        function dropcat(cat, type) {
            let form = document.createElement('form');
            form.action = "./assets/formHandlers/dropcsi.php";
            form.method = 'POST';
            form.innerHTML = '<input name="name" value="' + cat + '"><input name="type" value="' + type + '">';
            document.body.append(form);
            form.submit();
        }

        function showNoMessage() {
            catalog.innerHTML = '<div class="jumbotron" style="width:100%"><h1 class="display-3">Упс, тут ничего нет</h1><p class="lead">Попробуйте зайти позже, мы постараемся завезти товар.</p><hr class="my-2"></div>';

        }

        function min_price(minprice) {
            if (minprice == "") delete sortarr["min_price"];
            else sortarr["min_price"] = minprice;
            sort_items(itemsearch, sortarr);
        }

        function max_price(maxprice) {
            if (maxprice == "") delete sortarr["max_price"];
            else sortarr["max_price"] = maxprice;
            sort_items(itemsearch, sortarr);
        }

        function colourselect(colour) {
            if (colour == "0") delete sortarr["colour"];
            else sortarr["colour"] = colour;
            sort_items(itemsearch, sortarr);
        }

        function materialselect(material) {
            if (material == "0") delete sortarr["material"];
            else sortarr["material"] = material;
            sort_items(itemsearch, sortarr);
        }

        function makerselect(maker) {
            if (maker == "0") delete sortarr["maker"];
            else sortarr["maker"] = maker;
            sort_items(itemsearch, sortarr);
        }

        function quantityselect(quantity) {
            if (quantity == "0") delete sortarr["quantity"];
            else sortarr["quantity"] = quantity;
            sort_items(itemsearch, sortarr);
        }

        function max_width(width) {
            if (width == "") delete sortarr["width"];
            else sortarr["width"] = width;
            sort_items(itemsearch, sortarr);
        }

        function max_length(itemlength) {
            if (itemlength == "") delete sortarr["itemlength"];
            else sortarr["itemlength"] = itemlength;
            sort_items(itemsearch, sortarr);
        }

        function max_height(height) {
            if (height == "") delete sortarr["height"];
            else sortarr["height"] = height;
            sort_items(itemsearch, sortarr);
        }
        //option = new Option(text, value, defaultSelected, selected);

        // Example starter JavaScript for disabling form submissions if there are invalid fields

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

    </script>
    <script src="js/bootstrap-4.4.1.js"></script>
</body>

</html>
