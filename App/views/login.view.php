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
            
            <form class="loginform" action="">

                <img src="<?=ROOT?>/images/Logo/Logo2.png">
                <h1>Weclome</h1>
                <div class="input-box">
                    <input type="text" placeholder="Phone Number" required>
        
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" required>
                   
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox" name="remember-me"> Remember Me
                    </label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button class="login-button" type="submit">Login</button>
                <div class="register-link">
                    <p>Don't have an account? <a href="#">Register Now</a></p>
                </div>
            
            </form>
            <div class="right">
                <img src="<?=ROOT?>/images/Assets/login-background.jpg"> </div>
        </div>
        
        

    </section> 
    </body>
</html>