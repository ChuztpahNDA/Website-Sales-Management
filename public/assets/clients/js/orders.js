//hide block

function showCustomer()
{
    var formSelect = document.getElementById("selectCustomer");
    if (formSelect.style.display === "none") {
        formSelect.style.display = "block";
    } else {
        formSelect.style.display = "none";
    }


    var formShow = document.getElementById("showCustomer");
    if (formShow.style.display === "block") {
        formShow.style.display = "none";
    } else {
        formShow.style.display = "block";
    }

    var detail = document.getElementById('CustomerDetail');
    var arrDetail = detail.value.split('-');

    document.getElementById('name-phone').innerHTML = arrDetail[0].concat(" - ", arrDetail[1]);
    document.getElementById('phone').innerHTML = arrDetail[1];
    document.getElementById('address').innerHTML = arrDetail[2];

    // add ID to href
    document.getElementById('editCustomer').href = "/admin/Customer/".concat(arrDetail[3]).concat('/edit');
  }

// add div product
function addProduct()
{
    const sumValues = obj => Object.values(obj).reduce((a, b) => a + b, 0);
    const parent_productLists = document.getElementById("entries");
    var detailProduct = document.getElementById('ProductDetail').value.split('-');

    //create block Product
    var divProduct = document.createElement('tr');
    divProduct.setAttribute('id', 'product'.concat('_',detailProduct[0]));
    divProduct.setAttribute('name', 'product'.concat('_',detailProduct[0]));
    parent_productLists.appendChild(divProduct);

    // create Product name
    var nameProduct = document.createElement('td');
    nameProduct.textContent = detailProduct[1];
    divProduct.appendChild(nameProduct);

    // create Product quatity
    var Quatity = document.createElement('td');
    Quatity.setAttribute('id', 'quatity'.concat('_',detailProduct[0]));
    divProduct.appendChild(Quatity);

    // add tag imput in to tabel
    var inputQuatity = document.createElement('input');
    inputQuatity.setAttribute('type', 'number');
    inputQuatity.setAttribute('id', 'inputQuatity'.concat('_',detailProduct[0]));
    inputQuatity.setAttribute('name', ''.concat('',detailProduct[1]));
    inputQuatity.setAttribute('min', '1');
    inputQuatity.setAttribute('value', '1');
    inputQuatity.setAttribute('style', 'border: none; border-bottom: 2px solid black;');
    Quatity.appendChild(inputQuatity);

    // Create Product price
    var priceProduct = document.createElement('td');
    priceProduct.textContent = detailProduct[2];
    divProduct.appendChild(priceProduct);

    // Create total price
    var total_Price = document.createElement('td');
    total_Price.textContent = detailProduct[2]*inputQuatity.value;
    divProduct.appendChild(total_Price);

    // create JSON
    textTotalPriceProduct['SP_'.concat(detailProduct[1])] = detailProduct[2]*inputQuatity.value;

    // event click input quatity
    Quatity.addEventListener("click", function(){

        // list ID product
        listQuatity[''.concat(detailProduct[0])] = inputQuatity.value;

        // total price
        total_Price.textContent = detailProduct[2]*inputQuatity.value;
        textTotalPriceProduct['SP_'.concat(detailProduct[1])] = detailProduct[2]*inputQuatity.value;
        totalPrice = sumValues(textTotalPriceProduct);
        tagTotal.value = totalPrice;
        // payment
        total_price.value = Number(totalPrice) - Number(discountPrice.value);
    });

    //======= Payment========

    //show price total
    var tagTotal = document.getElementById('total');
    totalPrice = sumValues(textTotalPriceProduct);
    tagTotal.value = totalPrice;

    // Discount
    var discountPrice = document.getElementById('discount');
    var total_price = document.getElementById('total_price');
    total_price.value = Number(totalPrice) - Number(discountPrice.value);

    discountPrice.addEventListener("change", function(){
        discountPrice = document.getElementById('discount');
        total_price.value = Number(totalPrice) - Number(discountPrice.value);
    });

    // create input hiden
    var data = document.getElementById('ProductListID');
    data.value = data.value.concat(detailProduct[1], ';');
}

