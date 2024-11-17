<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="contact.css" />
    <!-- <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script> -->
  </head>
  <body>

    <div class="container">
      <div class="navbar">
        <div class="icon_2">
            <h2 class="logo">Trade<span>Track</span></h2>
        </div>
  
        <div class="menu">
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="#">ACCOUNT</a></li>
                <li><a href="#">MESSAGE</a></li>
                <li><a href="about.html">ABOUT US</a></li>
                <li><a href="contact.html">CONTACT US</a></li>
            </ul>
        </div>
            
    </div>
      <img src="img/shape.png" class="square" alt="" />
      <div>
        <div class="contact-info">
          <h3 class="title">Let's get in touch</h3>
          <p class="text">
            The company it self is a very successful company. I often get pains to refuse the words of the present!
          </p>

          <div class="info">
            <div class="information">
              <img src="add.png" class="icon" alt="" />
              <p>UCSC colombo Srilanka</p>
            </div>
            <div class="information">
              <img src="email.jpg" class="icon" alt="" />
              <p>tradetrack@gmail.com</p>
            </div>
            <div class="information">
              <img src="call.png" class="icon" alt="" />
              <p>123-456-789</p>
            </div>
          </div>

          <div class="social-media">
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
          </div>
        </div>

        <div class="contact-form">
          

          <form  autocomplete="off">
            <h3 class="title">Contact us</h3>
            <div class="input-container">
              <input type="text" name="name" class="input" />
              <label for="">Username</label>
              <span>Username</span>
            </div>
            <div class="input-container">
              <input type="email" name="email" class="input" />
              <label for="">Email</label>
              <span>Email</span>
            </div>
            <div class="input-container">
              <input type="tel" name="phone" class="input" />
              <label for="">Phone</label>
              <span>Phone</span>
            </div>
            <div class="input-container textarea">
              <textarea name="message" class="input"></textarea>
              <label for="">Message</label>
              <span>Message</span>
            </div>
            <input type="submit" value="Send" class="btn" />
          </form>
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>