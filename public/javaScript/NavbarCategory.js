var baseUrl = "http://localhost/mvc/public";

function displayCategory() {
  $.ajax({
    url: baseUrl+"/category/index"
  }).done(function(result) {
    data = JSON.parse(result);

    navCategory = "";
    for (const key in data) {
      const element = data[key];
      if (element["parent_category"] == 0) {
        navCategory += `
         <a>${element["category_name"]}</a>
         <div class="uk-navbar-dropdown">
             <ul class="uk-nav uk-navbar-dropdown-nav">`;
        for (const subkey in data) {
          const subdata = data[subkey];
          if (subdata["parent_category"] == element["id"]) {
            navCategory += `<li>
                  <a href="${baseUrl}/category/view/${subdata["url_key"]}">
                  ${subdata["category_name"]}</a>
                </li>`;
          }
        }
        navCategory += `</ul>
         </div>`;
      }
    }
    $('.category').html(navCategory);
    
  });
}

displayCategory();
