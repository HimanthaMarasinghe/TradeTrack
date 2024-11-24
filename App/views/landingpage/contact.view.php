<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="<?=ROOT?>/css/contact.css" />
    <!-- <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script> -->
  </head>
  <body>

    <div class="container">
      <?php $this->component("LandingPageNavigation") ?>
      <img src="img/shape.png" class="square" alt="" />
      <div>
        <div class="contact-info">
          <h3 class="title">Let's get in touch</h3>

          <div class="info">
            <div class="information">
              <img src="<?=ROOT?>/images/Assets/add.png" class="icon_2" alt="" />
              <p>UCSC colombo Srilanka</p>
            </div>
            <div class="information">
              <img src="<?=ROOT?>/images/Assets/email.jpg" class="icon_2" alt="" />
              <p>tradetrack@gmail.com</p>
            </div>
            <div class="information">
              <img src="<?=ROOT?>/images/Assets/call.png" class="icon_2" alt="" />
              <p>123-456-789</p>
            </div>
          </div>

          <!-- <div class="social-media">
            <p>Connect with us :</p>
            <div class="social-icons">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </div> -->
        </div>

        <div class="contact-form">
          

          <form  autocomplete="off">
            <h3 class="title">Contact us</h3>
            <div class="input-container">
              <input type="text" name="name" class="input" placeholder="name"/>
            </div>
            <div class="input-container">
              <input type="email" name="email" class="input" placeholder="E-mail"/>
            </div>
            <div class="input-container">
              <input type="tel" name="phone" class="input" placeholder="Phone number"/>
            </div>
            <div class="input-container textarea">
              <textarea name="message" class="input" placeholder="Message"></textarea>
            </div>
            <input type="submit" value="Send" class="btn" />
          </form>
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>