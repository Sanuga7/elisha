<?php
include("connection.php");
include("header.php");
?>

<link rel="stylesheet" href="assets/css/tezt.css">
<style>
  .bg {
    background-image: url('assets/images/hero-image.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 90vh;
    position: relative;
  }

  .content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: black;
    z-index: 2;
  }

  .content h2 {
    font-size: 4rem;
    font-weight: bold;
  }

  .contact-form {
    margin-top: 20px;
  }

  .map {
    margin-top: 40px;
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

<div class="container-fluid bg">
  <div class="content justify-content-center align-content-center">
    <h2>Contact Us</h2>
    <p class="text-dark">Home<span class="text-secondary">/ Contact</span></p>
  </div>
</div>

<div class="container contact-form">
  <h3>Send a Message</h3>
    <div class="col-12">
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo isset($_SESSION["u"]) ? $_SESSION["u"]["fname"] : "" ?>" required>
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo isset($_SESSION["u"]) ? $_SESSION["u"]["lname"] : "" ?>" required>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_SESSION["u"]) ? $_SESSION["u"]["email"] : "" ?>" required>
    </div>
    <div class="form-group">
      <label for="message">Message:</label>
      <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
    </div>
    <button onclick="ine();" class="btn button">Send Message</button>
</div>

<div class="container">
  <div class="col-12">
    <div class="row">
      <div class="col-6 mt-4">
         <h3><span class="g">O</span>ur Services</h3>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus recusandae similique dolore laborum possimus labore architecto temporibus iusto asperiores alias nihil autem sint rem quaerat sequi, culpa, voluptatibus maiores blanditiis saepe distinctio ut nisi id inventore. Perferendis dol
          ores aperiam consequuntur odio ex voluptates at accusantium maiores tenetur, mollitia aliquid sequi?</p>
          <p class=""><i class="fa fa-phone g"></i> Phone Number: <span class="text-dark"> +94 777 XXX XXXX</span></p>
          <p class=""><i class="fa fa-mail-bulk g"></i> Email Address:<span class="text-dark"> elishacreation@gmail.com</span></p>
      </div>
      <div class="col-6">
        <div class="map">
          <h3><span class="g">O</span>ur Location</h3>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.010184391028!2d-122.41941548468195!3d37.77492977975862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085818cd9f9a75f%3A0x1d8d1b68e3a4c5b6!2sSan%20Francisco%2C%20CA%2C%20USA!5e0!3m2!1sen!2s!4v1606871079247!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include("footer.php");
?>