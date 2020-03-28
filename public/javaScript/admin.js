var baseUrl = "http://localhost/mvc/public";

function multiplCatDelete() {
  var checkBoxes = document.getElementsByName("catCheck");
  var value = "";
  for (i = 0; i < checkBoxes.length; i++) {
    if (checkBoxes[i].checked) {
      value += checkBoxes[i].value + ",";
    }
  }
  value = value.substr(0, value.length - 1);
  
  $.ajax({
    url: baseUrl+"/Categories/multipleDelete",
    type: "POST",
    data: { deleteId: value } 
  }).done(function(result) {
    location.replace(baseUrl+'/admin/categories/index');
  });
}


function multipleUserDelete() {
  var checkBoxes = document.getElementsByName("catCheck");
  var value = "";
  for (i = 0; i < checkBoxes.length; i++) {
    if (checkBoxes[i].checked) {
      value += checkBoxes[i].value + ",";
    }
  }
  value = value.substr(0, value.length - 1);
  
  $.ajax({
    url: baseUrl+"/admin/User/multipleDelete",
    type: "POST",
    data: { deleteId: value } 
  }).done(function(result) {
    location.replace(baseUrl+'/admin/user/index');
  });
}

function multipleVendorDelete() {
  var checkBoxes = document.getElementsByName("catCheck");
  var value = "";
  for (i = 0; i < checkBoxes.length; i++) {
    if (checkBoxes[i].checked) {
      value += checkBoxes[i].value + ",";
    }
  }
  value = value.substr(0, value.length - 1);
  
  $.ajax({
    url: baseUrl+"/admin/vendor/multipleDelete",
    type: "POST",
    data: { deleteId: value } 
  }).done(function(result) {
    location.replace(baseUrl+'/admin/vendor/index');
  });
}

function multiplProductDelete(){
    var checkBoxes = document.getElementsByName("productCheck");
    var value = "";
    for (i = 0; i < checkBoxes.length; i++) {
      if (checkBoxes[i].checked) {
        value += checkBoxes[i].value + ",";
      }
    }
    value = value.substr(0, value.length - 1);
  
    $.ajax({
      url: baseUrl+"/admin/Products/multipleDelete",
      type: "POST",
      data: { deleteId: value } 
    }).done(function(result) {
      location.replace(baseUrl+'/admin/products/index');
    });
}

function multiplCmsDelete(){   
    var checkBoxes = document.getElementsByName("cmsCheck");
    var value = "";
    for (i = 0; i < checkBoxes.length; i++) {
      if (checkBoxes[i].checked) {
        value += checkBoxes[i].value + ",";
      }
    }
    value = value.substr(0, value.length - 1);
  
    $.ajax({
      url: baseUrl+"/admin/cms/multipleDelete",
      type: "POST",
      data: { deleteId: value } 
    }).done(function(result) {
      location.replace(baseUrl+'/admin/cms/index');
    });
}