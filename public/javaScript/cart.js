var quantity = parseInt($(".cartQuantity").text());
var maxStock = $(".cartQuantity").attr("max");
var baseUrl = "http://localhost/mvc/public";
function addToCart(id) {
  {
    $.ajax({
      url: baseUrl+"/addToCart/index",
      method: "POST",
      data: { productId: id, quantity: quantity }
    }).done(function(result) {
      console.log(result);

      alert("Added to Cart");
    });
  }
}



function displayCartDetails() {
  $.ajax({
    url: baseUrl+"/addToCart/displayCartDetails"
  }).done(function(result) {
    var carddetails = JSON.parse(result);

    console.log(carddetails);

    if (carddetails != "") {
      table = ` <table class="uk-table uk-table-divider">
                    <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>  
                    <th>Action</th>
                    </tr> `;
               
      for (const key in carddetails) {   
        const element = carddetails[key];
        table += `<tr>`;
        for (const key in element) {
          if (key != "id") {
            table += `<td> ${element[key]} </td>`;
          }
        }
        table += `<td><button class="uk-button uk-button-danger uk-button-small"
      onclick="deleteCartItem(${carddetails[key]["id"]})" >Remove</button> </td>`;
        table += `</tr>`;
      }
      table += `</table>`;
    } else {
      table = "<p>Nothing in cart</p>";
    }
    $(".shoppingcart").html(table);
  });
}

function deleteCartItem(id) {
  $.ajax({
    url: baseUrl+"/addToCart/deleteCartItem",
    method: "POST",
    data: { productId: id }
  }).done(function(result) {
    alert("Delete item successfully");
    displayCartDetails();
  });
}

function incrementQuantity() {
  if (quantity <= maxStock) {
    quantity = quantity + 1;
    $(".cartQuantity").html(quantity);
  } else {
    alert("Max Product limit reached");
  }
}

function decrementQuantity() {
  if (quantity > 1) {
    quantity = quantity - 1;
    $(".cartQuantity").html(quantity);
  }
}
