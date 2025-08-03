<?php

include "connection.php";
include "header.php";

if (!isset($_GET["id"]) || !isset($_GET["p"]) || !isset($_SESSION["u"])) {
?>
  <script>
    window.location = "index.php";
  </script>
<?php
} else {

  $id = $_GET["id"];
  $p = $_GET["p"];

?>
  <style>
    .rating {
      display: flex;
      flex-direction: row-reverse;
      justify-content: center;
      align-items: center;
      font-size: 2rem;
      color: #d3d3d3;
    }

    .rating input {
      display: none;
    }

    .rating label {
      cursor: pointer;
    }

    .rating input:checked~label {
      color: #ffb600;
    }

    .rating label:hover,
    .rating label:hover~label {
      color: #ffb600;
    }

    .feedback-form {
      margin-top: 20px;
    }

    .feedback-form textarea {
      width: 100%;
      height: 100px;
      margin-bottom: 10px;
    }

    .button {
    color: white;
    background-color: #f76838;
    border-radius: 8px;
  }

  .button:hover{
    color: #f76838;
    background-color: transparent;
    transition: background-color 0.3s ease;
    border: #f76838 1px solid;
  }
  </style>
  <div class="container mt-5">
    <div class="col-12">
      <h3>Feedback About Your Product</h3>
      <div class="row">
        <div class="col-lg-5 col-12">
          <?php
          
           $i_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '".$p."' LIMIT 1");
           $data = $i_rs->fetch_assoc();
          
          ?>
          <img src="<?php echo $data["img_path"]; ?>" width="100%" alt="Product Image">
        </div>
        <div class="col-lg-7 col-12">
          <h4 class="text-center mb-4">Rate Us:</h4>
          <div class="feedback-form">
            <div class="rating">
              <input type="radio" name="rating" id="star1" value="1"><label for="star1" class="fas fa-star"></label>
              <input type="radio" name="rating" id="star2" value="2"><label for="star2" class="fas fa-star"></label>
              <input type="radio" name="rating" id="star3" value="3"><label for="star3" class="fas fa-star"></label>
              <input type="radio" name="rating" id="star4" value="4"><label for="star4" class="fas fa-star"></label>
              <input type="radio" name="rating" id="star5" value="5"><label for="star5" class="fas fa-star"></label>
            </div>
            <textarea id="feedback" placeholder="Write your feedback here..." class="mt-3"></textarea>
            <input type="hidden" id="product" value="<?php echo $p; ?>">
            <input type="hidden" name="user_id" value="<?php echo $id; ?>">
            <input type="hidden" id="rating_value" name="rating_value">
            <button class="btn button" onclick="sendRating();">Submit</button>
          </div>
          <div id="thx">
             <h4 class="d-none text-center">Thanks For Your FeedBack</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>

 var rating = 0;

    document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating input[type="radio"]');

    stars.forEach(star => {
        star.addEventListener('change', function() {
            const rating1 = document.querySelector('input[name="rating"]:checked').value;
            rating = rating1
        });
    });
});

function sendRating() {
        const feedback = document.getElementById("feedback").value;
        const product = document.getElementById("product").value;
        let new_rating = 0;

        switch(rating) {
            case '5':
                new_rating = 1;
                break;
            case '4':
                new_rating = 2;
                break;
            case '3':
                new_rating = 3;
                break;
            case '2':
                new_rating = 4;
                break;
            case '1':
                new_rating = 5;
                break;
        }

        const form = new FormData();
        form.append("f", feedback);
        form.append("r", new_rating);
        form.append("p", product);

        const request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                if (request.status == 200) {
                    const response = request.responseText;
                    if (response.trim() == "success") {
                        alert("success");
                    } else {
                        alert(response);
                    }
                } else {
                    alert("Request failed with status:", request.status);
                }
            }
        };

        request.open("POST", "addFeedback.php", true);
        request.send(form);
    }
    </script>

<?php
}

include "footer.php";

?>
