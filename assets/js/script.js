window.addEventListener("load", function () {
  setTimeout(function () {
    document.getElementById("preloader").style.display = "none";
  }, 500);
});

function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}

var verificationModal;

function signUp() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("Email");
  var pwd = document.getElementById("password");

  var form = new FormData();
  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("e", email.value);
  form.append("p", pwd.value);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      if (response == "success") {
        document.getElementById("msg1").innerHTML =
          "Registration Successful Activate Your Account";
        document.getElementById("msg1").classList = "alert alert-success";
        document.getElementById("msgdiv1").className = "d-block";
        var modal = document.getElementById("verification");
        verificationModal = new bootstrap.Modal(modal);
        verificationModal.show();
      } else {
        document.getElementById("msg1").innerHTML = response;
        document.getElementById("msgdiv1").className = "d-block";
        document.getElementById("msg1").classList = "alert alert-danger";
      }
    }
  };

  request.open("POST", "signUpProcess.php", true);
  request.send(form);
}

function userVerify(){

  var code = document.getElementById("code");

  var form = new FormData();
  form.append("c", code.value);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      if (response == "Success") {
        document.getElementById("msg2").innerHTML =
        "Account Successfully Activated";
        document.getElementById("msg2").classList = "alert alert-success";
        document.getElementById("msgdiv2").className = "d-block";
        window.location = "login.php";
      } else {
        document.getElementById("msg2").innerHTML = response;
        document.getElementById("msgdiv2").className = "d-block";
        document.getElementById("msg2").classList = "alert alert-danger";
      }
    }
  };

  request.open("POST", "verifyProcessUser.php", true);
  request.send(form);

}

function signIn() {
  var email = document.getElementById("email");
  var pwd = document.getElementById("pwd");
  var remember = document.getElementById("formCheck");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", pwd.value);
  form.append("r", remember.checked);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        document.getElementById("msg").innerHTML = "Login Successfull";
        document.getElementById("msg").className = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
        window.location = "index.php";
      } else {
        document.getElementById("msg").innerHTML = response;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "signInProcess.php", true);
  request.send(form);
}

var forgotPM;

function forgotPw() {
  var email = document.getElementById("email");

  var form = new FormData();
  form.append("e", email.value);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        alert("Verification code has been sent to your Email");
        var modal = document.getElementById("forgot");
        forgotPM = new bootstrap.Modal(modal);
        forgotPM.show();
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "forgotPasswordProcess.php", true);
  request.send(form);
}

function showPassword() {
  var textfield = document.getElementById("np");
  var button = document.getElementById("npb");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";
  } else {
    textfield.type = "Password";
    button.innerHTML = "Show";
  }
}

function showPassword1() {
  var textfield = document.getElementById("np1");
  var button = document.getElementById("npb1");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";
  } else {
    textfield.type = "Password";
    button.innerHTML = "Show";
  }
}

function resetPassword() {
  var email = document.getElementById("email");
  var newPassword = document.getElementById("np");
  var retypePassword = document.getElementById("np1");
  var Verification = document.getElementById("vcode");

  var form = new FormData();
  form.append("e", email.value);
  form.append("n", newPassword.value);
  form.append("r", retypePassword.value);
  form.append("v", Verification.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        alert("Password successfully updated");
        forgotPM.hide();
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "resetProcess.php", true);
  request.send(form);
}

function showLogPassword() {
  var textfield = document.getElementById("pwd");
  var button = document.getElementById("npb");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";
  } else {
    textfield.type = "Password";
    button.innerHTML = "Show";
  }
}

function updateInfo() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var city = document.getElementById("city");
  var district = document.getElementById("dis");
  var province = document.getElementById("pro");
  var line1 = document.getElementById("line1");
  var pcode = document.getElementById("pcode");

  var form = new FormData();
  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("m", mobile.value);
  form.append("c", city.value);
  form.append("d", district.value);
  form.append("p", province.value);
  form.append("l1", line1.value);
  form.append("pc", pcode.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        document.getElementById("msg").innerHTML =
          "Profile Successfuly Updated";
        document.getElementById("msg").className = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
        window.location.reload;
      } else {
        document.getElementById("msg").innerHTML = response;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "updateProcess.php", true);
  request.send(form);
}

function changeProfileImg() {
  var img = document.getElementById("profileimage");

  img.onchange = function () {
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);

    document.getElementById("loadImg").src = url;

    var form = new FormData();
    form.append("i", img.files[0]);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        var response = request.responseText;
        if (response == "Saved") {
          document.getElementById("msg1").innerHTML =
            "Your Profie Image Successfuly Added";
          document.getElementById("msg1").className = "alert alert-success";
          document.getElementById("msgdiv1").className = "d-block";
          window.location = "profile.php";
        } else if (response == "Updated") {
          document.getElementById("msg1").innerHTML =
            "Your Profie Image Successfuly Updated";
          document.getElementById("msg1").className = "alert alert-success";
          document.getElementById("msgdiv1").className = "d-block";
          window.location = "profile.php";
        } else {
          document.getElementById("msg1").innerHTML = response;
          document.getElementById("msgdiv1").className = "d-block";
        }
      }
    };

    request.open("POST", "imageUpdateProcess.php", true);
    request.send(form);
  };
}

var sortM;

function sortModal() {
  var modal = document.getElementById("modal");
  sortM = new bootstrap.Modal(modal);
  sortM.show();
}

function catProduct(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        window.location = "product.php";
        loadCat();
      }
    }
  };

  request.open("GET", "catProductProcess.php?id=" + id, true);
  request.send();
}

function loadCat() {
  var x = 0;

  var form = new FormData();
  form.append("p", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      document.getElementById("basicSearchResult").innerHTML = response;
    }
  };

  request.open("POST", "loadCatProcess.php", true);
  request.send(form);
}

var am;

function adminSignIn() {
  var email = document.getElementById("email");
  var pwd = document.getElementById("pwd");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", pwd.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        document.getElementById("msg").innerHTML = "Login Successful";
        document.getElementById("msg").classList = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
        m = document.getElementById("verificationModal");
        am = new bootstrap.Modal(m);
        am.show();
      } else {
        document.getElementById("msg").innerHTML = response;
        document.getElementById("msgdiv").className = "d-block";
        document.getElementById("msg").classList = "alert alert-danger";
      }
    }
  };

  request.open("POST", "adminLoginProcess.php", true);
  request.send(form);
}

function verify(){
  var code = document.getElementById("vcode");

  var form = new FormData();
  form.append("c", code.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "Success") {
        am.hide();
        window.location = "controlpanel.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "verificationProcess.php", true);
  request.send(form);
}

function logout() {
  alert("hi");
}

function changeProductImage() {
  var image = document.getElementById("imageuploader");

  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 3) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("i" + x).src = url;
      }
    } else {
      alert(
        file_count +
          " files. You are proceed to upload only 3 or less than 3 files."
      );
    }
  };
}

function saveProduct() {
  var title = document.getElementById("title");
  var price = document.getElementById("price");
  var desc = document.getElementById("desc");
  var dfee = document.getElementById("dfee");
  var cat = document.getElementById("cat");
  var qty = document.getElementById("qty");
  var image = document.getElementById("imageuploader");
  
  var colorElements = document.querySelectorAll('input[type="checkbox"][id^="color"]');
  var selectedColors = [];
  
  colorElements.forEach(function (checkbox) {
      if (checkbox.checked) {
          selectedColors.push(checkbox.value);
      }
  });

  var form = new FormData();
  form.append("t", title.value);
  form.append("p", price.value);
  form.append("d", desc.value);
  form.append("df", dfee.value);
  form.append("c", cat.value);
  form.append("q", qty.value);

  form.append("colors", selectedColors.join(","));

  var file_count = image.files.length;
  for (var x = 0; x < file_count; x++) {
      form.append("image" + x, image.files[x]);
  }

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
          var response = request.responseText;
          if (response == "success") {
              document.getElementById("msg1").innerHTML = "Product Successfully Saved";
              document.getElementById("msg1").className = "alert alert-success";
              document.getElementById("msgdiv1").className = "d-block";
              window.location.reload();
          } else {
              document.getElementById("msg1").innerHTML = response;
              document.getElementById("msgdiv1").className = "d-block";
          }
      }
  };

  request.open("POST", "saveProductProcess.php", true);
  request.send(form);
}


function loadMainImg(id) {
  var sample_img = document.getElementById("productImg" + id).src;
  var main_img = document.getElementById("mainImg");

  main_img.style.backgroundImage = "url(" + sample_img + ")";
}

function loadImg(id) {
  var sample_img = document.getElementById("productImg" + id).src;
  var main_img = document.getElementById("mainImg");

  main_img.style.backgroundImage = "url(" + sample_img + ")";
}

function change_image(image) {
  var container = document.getElementById("main-image");

  container.src = image.src;
}

function loadImg(id) {
  var mainImg = document.getElementById("mainImg");
  var img = document.getElementById("small-img" + id);

  mainImg.src = img.src;
}

var popoverTriggerList = [].slice.call(
  document.querySelectorAll('[data-toggle="popover"]')
);
var popoverList = popoverTriggerList.map(function (popoverTrigger) {
  return new bootstrap.Popover(popoverTrigger);
});

function send(id) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      if (response == "success") {
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "wishlistProcess.php?id=" + id, true);
  request.send();
}

var wishM;

function wishlog() {
  var modal = document.getElementById("modal");
  wishM = new bootstrap.Modal(modal);
  wishM.show();
}

function logwish() {
  window.location = "login.php";
}

const wish = document
  .getElementById("heart")
  .addEventListener("click", function () {
    window.location = "wishlist.php";
  });

function ine() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var msg = document.getElementById("message");

  var form = new FormData();
  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("e", email.value);
  form.append("m", msg.value);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        success("Sent", "Your Massage Succefully Sent", "success")
      } else {
        error("Failed", "Massage Failed to Send", "error");
      }
    }
  };

  request.open("POST", "contactProcess.php", true);
  request.send(form);
}

const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

function sent(id) {
  var qty = document.getElementById("qty_input");
  var s_id = document.getElementById("size");

  var form = new FormData();
  form.append("id", id);
  form.append("qty", qty.value);
  form.append("size", s_id.value);
  var selectedColorId = document
    .querySelector('input[name="color_radio"]:checked')
    .getAttribute("data-color-id");
  form.append("c", selectedColorId);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      if (response == "success") {
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "cartProcess.php", true);
  request.send(form);
}

function cart() {
  window.location = "cart.php";
}

function check_value(qty) {
  var input = document.getElementById("qty_input");
  var qty = qty;
  if (input.value <= 0) {
    input.value = 1;
  } else if (input.value > qty) {
    input.value = qty;
  }
}

var qty = qty;

var amodal;

function checkAdd() {
  var modal = document.getElementById("addmodal");

  amodal = new bootstrap.Modal(modal);
  amodal.show();
}

function addu() {
  window.location = "profile.php";
}

function initializeLogoutTimer() {
  var logoutTimer;

  function resetLogoutTimer() {
    clearTimeout(logoutTimer);
    logoutTimer = setTimeout(logoutUser, 20 * 60 * 1000);
  }

  function logoutUser() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "logout.php", true);
    xhr.send();
  }

  document.addEventListener("mousemove", resetLogoutTimer);
  document.addEventListener("keypress", resetLogoutTimer);

  resetLogoutTimer();
}

function saveInvoice1(orderId, p_id, mail, amount, qty, size, color) {
  var form = new FormData();
  form.append("o", orderId);
  form.append("i", p_id);
  form.append("m", mail);
  form.append("a", amount);
  form.append("q", qty);
  form.append("s", size);
  form.append("c", color);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "success") {
        window.location = "invoice.php?id=" + orderId;
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "saveInvoiceProcess1.php", true);
  request.send(form);
}

function remove(id) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        window.location.reload();
      } else if (response == "nuser") {
        window.location = "index.php?login first";
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "removeFromCartProcess.php?id=" + id, true);
  request.send();
}

function saveInvoice(orderId, p_id, mail, amount, qty, q_id, color) {
  var form = new FormData();
  form.append("o", orderId);
  form.append("i", p_id);
  form.append("m", mail);
  form.append("a", amount);
  form.append("q", qty);
  form.append("qi", q_id);
  form.append("c", color);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "success") {
        window.location = "invoice.php?id=" + orderId;
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "saveInvoiceProcess.php", true);
  request.send(form);
}

function printInvoice() {
  var restorePage = document.body.innerHTML;
  var btn = document.getElementById("btn");
  btn.classList.toggle("d-none");
  var page = document.getElementById("body").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorePage;
}

function price(price) {
  var qty = document.getElementById("qty_input");

  var priceNow = document.getElementById("price");

  priceNow.innerHTML = "RS " + price * qty.value + ".00";
}

var oModal;

function details(id) {
   
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      var product = JSON.parse(response);
      document.getElementById("title").innerHTML = "Title:- "+product.title;
      document.getElementById("price").innerHTML = "Price:- "+product.price;
      document.getElementById("dfee").innerHTML = "Delivery Fee:- "+product.delivery_fee;
      document.getElementById("qty").innerHTML = "Quantity:- "+product.quantity;
      document.getElementById("dat").innerHTML = "Date & Time:- "+product.date;
    }
  };

  var modal = document.getElementById("orderview");

  oModal = new bootstrap.Modal(modal);
  oModal.show();

  request.open("GET","detailsProcss.php?id="+id,true);
  request.send();
}

const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

function checkBuy(t) {
  var size = document.getElementById("size");
  var qty = document.getElementById("qty_input");
  var selectedColorId = document
    .querySelector('input[name="color_radio"]:checked')
    .getAttribute("data-color-id");

  var form = new FormData();
  form.append("t", t);
  form.append("s", size.value);
  form.append("q", qty.value);
  form.append("c", selectedColorId);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      alert(response);
    }
  };

  request.open("POST", "checkBuyProcess.php", true);
  request.send(form);
}

function userstatus(email) {

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        console.log("Request successful, reloading page.");
        window.location.reload();
      } else {
        alert("Something Went Wrong");
      }
    }
  };

  request.open("GET", "userStatusProcess.php?email=" + encodeURIComponent(email), true);
  request.send();
}

function userstatus2(email) {

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        console.log("Request successful, reloading page.");
        window.location.reload();
      } else {
        alert("Something Went Wrong");
      }
    }
  };

  request.open("GET", "userstatusprocess2.php?email=" + encodeURIComponent(email), true);
  request.send();
}

function cartStatus() {
 
   var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if(request.readyState == 4 && request.status == 200){
      var response = request.responseText;
      if(response === "end"){
        window.location = "cart.php";
      }else if(response === "continue"){
        window.location = "cart.php";
      }
    }
  }
  
  request.open("POST","cartStatus.php", true);
  request.send();
}

var total = 0;

function prom() {
  var totalElement = document.getElementById("total");
  var sub = document.getElementById("sub");
  var totalText = totalElement.textContent.trim();
  var numericValue = parseFloat(totalText.replace(/^Rs\.|\..*$/g, '').replace(',', '')); 

  var promocode = document.getElementById("promo").value;

  var form = new FormData();
  form.append("total", numericValue);
  form.append("promo", promocode);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "no") {
        error("Invalid Code", "Promo code Is Invalid", "error");
        window.location.reload();
      } else {
        var data = JSON.parse(response);
        var newTotal = parseFloat(data.new_total);
        totalElement.textContent = "Rs. " + newTotal.toFixed(2);
        var di = document.getElementById("di");
        var dis = document.getElementById("dis");
        di.classList.toggle("d-none");
        var di2 = document.getElementById("di2");
        di2.classList.toggle("d-none");
        dis.innerHTML = data.percentage + "%";
        total = newTotal; 
      }
    }
  };

  request.open("POST", "promocodeCheck.php", true);
  request.send(form);
}

function formSubmit() {

 /* var sub = document.getElementById("sub").value;
  var total = parseInt(sub);*/
  var to = parseInt(total);

  var form = new FormData();
  form.append("total", to); 

  var request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if (request.readyState == 4 && request.status == 200) {
      var response = JSON.parse(request.responseText);
      if (response.status === 'success') {
        window.location.href = response.url;
      } else {
        error("Error", response.message, "error");
      }
    }
  };

  request.open("POST", "cartBuyProcess.php", true);
  request.send(form);
}

function success(title , response , icon) {
  Swal.fire({
    title: title,
    text: response,
    icon: icon
  });
}

function error(title, response, icon) {
  Swal.fire({
    title: title,
    text: response,
    icon: icon,
    confirmButtonText: 'OK',
    confirmButtonColor: '#f76838',
  });
}

const stars = document.querySelectorAll('.rating input[type="radio"]');

    stars.forEach(star => {
        star.addEventListener('change', function() {
            const rating = document.querySelector('input[name="rating"]:checked').value;
            alert(rating);
            console.log(rating);
        });
});  

function search(page) {
  const sort = document.getElementById('sort').value;
  const search = document.getElementById('txt').value;
  window.location.href = `?page=${page}&sort=${sort}&search=${search}`;
}

function advancedSearch(page) {
  const sort = document.getElementById('sort').value;
  const search = document.getElementById('txt').value;
  const category = document.getElementById('advancedCat').value;
  const minPrice = document.getElementById('minPrice').value;
  const maxPrice = document.getElementById('maxPrice').value;
  const color = document.getElementById('advancedColor').value;
  
  let url = `?page=${page}`;
  
  if (sort != 0) {
    url += `&sort=${sort}`;
  }
  if (search) {
    url += `&search=${search}`;
  }
  if (category != 0) {
    url += `&category=${category}`;
  }
  if (minPrice != 0) {
    url += `&minPrice=${minPrice}`;
  }
  if (maxPrice != 0) {
    url += `&maxPrice=${maxPrice}`;
  }
  if (color != 0) {
    url += `&color=${color}`;
  }
  
  window.location.href = url;
}

function manageSearchProducts(page){

  var search = document.getElementById("msearch").value;

  window.location.href = `?page=${page}&search=${search}`;

}