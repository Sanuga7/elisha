function changeStatus(id) {
    var product_id = id;
  
    var request = new XMLHttpRequest();
  
    request.onreadystatechange = function () {
      if ((request.status == 200) & (request.readyState == 4)) {
        var response = request.responseText;
        if (response == "deactivated" || response == "activated") {
          window.location.reload();
        } else {
          alert(response);
        }
      }
    };
  
    request.open("GET", "changeStatusProcess.php?id=" + product_id, true);
    request.send();
}

function sendid(id) {
    var request = new XMLHttpRequest();
  
    request.onreadystatechange = function () {
      if ((request.status == 200) & (request.readyState == 4)) {
        var response = request.responseText;
  
        if (response == "Success") {
          window.location = "updateProduct.php";
        } else {
          alert(response);
        }
      }
    };
  
    request.open("GET", "sendIdProcess.php?id=" + id, true);
    request.send();
}

function updateProduct(id) {

 var desc = document.getElementById("desc");
 var dfee = document.getElementById("dfee");
 var qty =  document.getElementById("qty");
 var img = document.getElementById("imageuploader");

 var colorElements = document.querySelectorAll('input[type="checkbox"][id^="color"]');
  var selectedColors = [];
  
  colorElements.forEach(function (checkbox) {
      if (checkbox.checked) {
          selectedColors.push(checkbox.value);
      }
  });

 var form = new FormData();
 form.append("d" , desc.value);
 form.append("df" , dfee.value);
 form.append("q" , qty.value);
 form.append("id", id);
 form.append("colors", selectedColors.join(","));

 var length = img.files.length;

 for (var i = 0; i < length; i++) {
  form.append("img" + i, img.files[i]);
 }

 var request = new XMLHttpRequest();
 request.onreadystatechange = function () {
  if(request.readyState == 4 || request.status == 200) {
    var response = request.responseText;
    if(response == "updated"){
      success ("Updated","Product Successfully Updated","success");
    }else{
      error ("Error", response ,"error");
    }
  }
 }

 request.open("POST", "updateProductProcess.php" ,true);
 request.send(form);
}  

function success(title , response , icon) {
  Swal.fire({
    title: title,
    text: response,
    icon: icon
  });
}

function error(title , response , icon) {
  Swal.fire({
    title: title,
    text: response,
    icon: icon
  });
}

function manageProductSearch(x) {
  
  var search = document.getElementById("msearch");

  var form = new FormData();
  form.append("s", search.value);
  form.append("p", x);
  
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if(request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      document.getElementById("mcontent").innerHTML = response;
    }
  }

  request.open("POST", "manageSearchProcess.php", true);
  request.send(form);
}

function manageUserSearch(x) {
  
  var search = document.getElementById("msearch");

  var form = new FormData();
  form.append("s", search.value);
  form.append("p", x);
  
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if(request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      document.getElementById("mcontent2").innerHTML = response;
    }
  }

  request.open("POST", "manageUserSearchProcess.php", true);
  request.send(form);
}

function replyMsg(id) {
  
  var msg = document.getElementById("msg");

  var form = new FormData();
  form.append("id", id);
  form.append("m", msg.value);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if(request.readyState == 4 && request.status == 200){
      var response = request.responseText;
      if(response == "success"){
        success("Success", "Message sent", "success").then(() => {
          window.location = "massage.php";
        });
      }else{
        error("Error", response, "error");
      }
    }
  }

  request.open("POST", "replyMessageProcess.php", true);
  request.send(form);
}

function addpromo() {
   
  var code = document.getElementById("code");
  var per = document.getElementById("per");

  var form = new FormData();
  form.append("c", code.value);
  form.append("p", per.value);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function (){
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if(response == "success"){
        window.location.reload();
      }else{
        alert(response);
      }
    }
  }

  request.open("POST", "addPromoProcess.php", true);
  request.send(form);
}

function promoStatus(x) {

   var form = new FormData();
   form.append("x", x);

   var request = new XMLHttpRequest();
   request.onreadystatechange = function (){
    if(request.readyState == 4 && request.status == 200){
      var response = request.responseText;
      if(response == "success"){
        window.location.reload();
      }else{
        alert(response);
      }
    }
   }

   request.open("POST", "promoStatusProcess.php", true);
   request.send(form);
}