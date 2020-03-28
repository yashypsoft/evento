var baseUrl = "http://localhost/mvc/public";

function searchProduct(){
    searchItem = $('#searchItem').val();
    searchItem = searchItem.replace(/ /g,"-"); 
    console.log(searchItem);
    
    if (searchItem!="") {
        location.replace(baseUrl+'/product/search/'+searchItem);   
    }
}

