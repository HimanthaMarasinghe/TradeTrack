<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TRADE TRACK Login</title>
        <link rel="stylesheet" href="<?=ROOT?>/css/login.css">

    </head>
    <body>
        <section class="header">
        <div class="wrapper">
            
            <form class="loginform" action="" method="POST">

                <img src="<?=ROOT?>/images/Logo/Logo2.png">
                <h1>Weclome</h1>
                <div class="input-box">
                    <input type="text" placeholder="Phone Number" name="phone" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" pattern="\d{10}" title="Please enter a valid 10-digit phone number" required>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <button class="login-button" type="submit">Login</button>
                <div class="register-link">
                    <p>Don't have an account? <a href="<?=LINKROOT?>/register">Register Now</a></p>
                </div>
            
            </form>
            <div class="right">
                <img src="<?=ROOT?>/images/Assets/login-background.jpg"> </div>
        </div>
        
        <?php if (isset($data['error'])): ?>
            <div class="warning-message">
              <?= $data['error'] ?>
            </div>
        <?php endif; ?>
        

    </section> 
    </body>
</html>