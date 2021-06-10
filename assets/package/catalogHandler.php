  <script type="text/javascript">
      var itemsearch = []

      function search_subcategories(category) {
          var subcategorysearch = subcategoriesarr.filter(subcategory => subcategory["category_name"] === category)
          categorynow = category;
          subcategorynow = "";
          console.log('<?php echo $_SESSION["catalogtype"] ?>')
          if (typeof subcategorysearch[0] === 'undefined') {
              <?php if ($_SESSION["admin"]){  ?>

              addeditsmthng.innerHTML = "Добавить подкатегорию";
              addeditsmthng.setAttribute("data-target", "#subcategoryaddedit");
              addeditsmthng.setAttribute('onclick', "addeditcat(null, 'subcategory')");
              <?php } ?>
              showNoMessage();

          }
          else{
              showelements(subcategorysearch, "subcategory")
          }

      }

      function search_items(subcategory) {
          itemsearch = itemsarr.filter(item => item["subcategory_name"] === subcategory)
          subcategorynow = subcategory;
          sort_select(itemsearch);
          if (typeof itemsearch[0] === 'undefined'){
              <?php if ($_SESSION["admin"]){  ?>

          addeditsmthng.innerHTML = "Добавить Товар";
          addeditsmthng.setAttribute("data-target", "#itemaddedit");
          addeditsmthng.setAttribute('onclick', "addeditcat(null, 'item')");
          <?php } ?>
          showNoMessage();
      }
      else{
          showelements(itemsearch, "item");
      }

      }

      function sort_items(itemarray, sort_array) {
          let itemssort = itemarray;
          if (sort_array["min_price"] != undefined) {
              itemssort = itemssort.filter(item => Number(item["cost"]) >= Number(sort_array["min_price"]))
          }
          if (sort_array["max_price"] != undefined) {
              itemssort = itemssort.filter(item => Number(item["cost"]) <= Number(sort_array["max_price"]))
          }
          if (sort_array["colour"] != undefined) {
              itemssort = itemssort.filter(item => String(item["colour"]) == String(sort_array["colour"]))
          }

          if (sort_array["material"] != undefined) {
              itemssort = itemssort.filter(item => String(item["material"]) == String(sort_array["material"]))
          }

          if (sort_array["maker"] != undefined) {
              itemssort = itemssort.filter(item => String(item["maker"]) == String(sort_array["maker"]))
          }

          if ((sort_array["quantity"]) != undefined) {
              if (sort_array["quantity"] == "yes") {
                  itemssort = itemssort.filter(item => Number(item["quantity"]) > 0)
              } else {
                  itemssort = itemssort.filter(item => Number(item["quantity"]) <= 0)
              }
          }

          if (sort_array["width"] != undefined) {
              itemssort = itemssort.filter(item => (Number(item["width"]) <= (Number(sort_array["width"]) + 10)) && (Number(item["width"]) >= (Number(sort_array["width"]) - 10)))
          }

          if (sort_array["itemlength"] != undefined) {
              itemssort = itemssort.filter(item => (Number(item["length"]) <= (Number(sort_array["itemlength"]) + 10)) && (Number(item["length"]) >= (Number(sort_array["itemlength"]) - 10)))
          }


          if (sort_array["height"] != undefined) {
              itemssort = itemssort.filter(item => (Number(item["height"]) <= (Number(sort_array["height"]) + 10)) && (Number(item["height"]) >= (Number(sort_array["height"]) - 10)))
          }

          if (typeof itemssort[0] === 'undefined') {
              showNoMessage();
          } else {
              showelements(itemssort, "item");
          }
      }

      function openProduct(item_id) {
          catalog_page = document.getElementById("catalog_page");
          item = document.getElementById("item");
          catalog_page.style.display = "none";
          item.style.display = "block";
          let currentarr = itemsarr.filter(item => (item["item_id"] == item_id))
          let currentitem = currentarr[0];
          itemname = document.getElementById("itemname");
          itemname.innerHTML = currentitem["item_name"];
          itemdescription = document.getElementById("itemdescription");
          itemdescription.innerHTML = currentitem["description"];
          itemcost = document.getElementById("itemcost");
          itemcost.innerHTML = currentitem["cost"] + " р.";
          charcolour = document.getElementById("charcolour");
          charcolour.innerHTML = currentitem["colour"];
          charmaterial = document.getElementById("charmaterial");
          charmaterial.innerHTML = currentitem["material"];
          charmaker = document.getElementById("charmaker");
          charmaker.innerHTML = currentitem["maker"];
          charquantity = document.getElementById("charquantity");
          charquantity.innerHTML = currentitem["quantity"];
          charlength = document.getElementById("charlength");
          charlength.innerHTML = currentitem["length"] + "см.";
          charwidth = document.getElementById("charwidth");
          charwidth.innerHTML = currentitem["width"] + "см.";
          charheight = document.getElementById("charheight");
          charheight.innerHTML = currentitem["height"] + "см.";

          purch_btn = document.getElementById("purch_btn")
          purch_btn.onclick = function() {
              ItemToCart(item_id)
          }
          itemphoto = document.getElementById("itemphoto");
          itemphoto.src = currentitem["photo_link"];

      }

      function closeitem() {
          catalog_page = document.getElementById("catalog_page");
          item = document.getElementById("item");
          catalog_page.style.display = "block";
          item.style.display = "none";
      }

      function sort_select(itemarray) {
          let colourArray = [];
          let materialArray = [];
          let makerArray = [];
          itemarray.forEach(function(item, i, itemarray) {
              if (!colourArray.includes(itemarray[i]["colour"])) {
                  colourArray[i] = itemarray[i]["colour"];
              }
              if (!materialArray.includes(itemarray[i]["material"])) {
                  materialArray[i] = itemarray[i]["material"];
              }
              if (!makerArray.includes(itemarray[i]["maker"])) {
                  makerArray[i] = itemarray[i]["maker"];
              }
          })
          sort_colour = document.getElementById("sort_colour");
          sort_material = document.getElementById("sort_material");
          sort_maker = document.getElementById("sort_maker");
          sort_colour.innerHTML = "<option value= '0' selected>Не выбрано</option>";
          sort_material.innerHTML = "<option value= '0' selected>Не выбрано</option>";
          sort_maker.innerHTML = "<option value= '0' selected>Не выбрано</option>";
          var opt;
          colourArray.forEach(function(colour, i, colourarray) {
              opt = document.createElement('option');
              opt.value = colour;
              opt.innerHTML = colour;
              sort_colour.appendChild(opt);
          });
          materialArray.forEach(function(material, i, materialarray) {
              opt = document.createElement('option');
              opt.value = material;
              opt.innerHTML = material;
              sort_material.appendChild(opt);
          });
          makerArray.forEach(function(maker, i, makerarray) {
              opt = document.createElement('option');
              opt.value = maker;
              opt.innerHTML = maker;
              sort_maker.appendChild(opt);
          });

      }

      function ItemToCart(item_id) {
          window.cartitems.push(item_id);
          localStorage.setItem("cartitems", window.cartitems.join());
          inputCart(cartitems)

      }

  </script>
