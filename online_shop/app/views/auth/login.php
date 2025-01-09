

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="public/css/style.css">
</head>
<body style="background:#eee;">
<div class="wrapper" style=" margin-top: 70px;">
    <div class="content">
        <main>
            <div class="container-fluid">
                <div class="container-login100">
                    <div class="row justify-content-center pt-4">
                        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
                            <form action="login_post"  class="login100-form" method="post" id="loginForm">

                                 <span class="login100-form-title p-b-33">
                                        Login
                                 </span>

                                 <!-- validation oshibkalar, controllerdan gelyr -->
                                <?php if(isset($_SESSION['error'])){ ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $_SESSION['error']; ?>
                                    </div>
                                <?php }?>

                                <?php if(isset($_SESSION['success'])){ ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= $_SESSION['success']; ?>
                                    </div>
                                <?php }?>
                                <div class="wrap-input100 validate-input">
                                    <input class="input100" type="email" value="" autocomplete="off" name="email"
                                           placeholder="Email...">

                                    <span class="focus-input100-1">
                                    </span>

                                    <span class="focus-input100-2">
                                    </span>
                                </div>

                                <div class="wrap-input100 rs1 validate-input">

                                    <input class="input100" type="password" name="Password"

                                           placeholder="Password..." autocomplete="current-password">

                                </div>
                                    <!-- div to show reCAPTCHA -->
                                  <div  class="my-3">
                                      <div class="g-recaptcha"
                                           data-sitekey="6LcZ-Z8qAAAAAI4WpJaweSPKCEQAfo-R4VF-ETZD">
                                      </div>
                                  </div>
                                <button type="submit" class="login100-form-btn" id="login100-form-btn">
                                        Login
                                </button>

                                <p class="lead mt-3">
                                    <a href="/online_shop/register" class="text-center"> Register a new membership </a>

                                </p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            // Get the reCAPTCHA response token
            const recaptchaResponse = grecaptcha.getResponse();

            // Check if the reCAPTCHA is completed
            if (!recaptchaResponse) {
                // Prevent form submission
                e.preventDefault();
                alert('handle google captcha!');
            }
        });
    </script>
</body>
</html>