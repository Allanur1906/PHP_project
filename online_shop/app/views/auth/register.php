

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
<div class="wrapper">
    <div class="content">
        <main>
            <div class="container-fluid">
                <div class="container-login100">
                    <div class="row justify-content-center py-4">
                        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
                            <form action="post_register"  class="login100-form" method="post" id="loginForm">

                                 <span class="login100-form-title p-b-33">
                                        Register
                                 </span>

                                <?php if(isset($_SESSION['error'])){ ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $_SESSION['error']; ?>
                                    </div>
                                <?php }?>

                                <div class="wrap-input100 validate-input">
                                    <input class="input100" type="text" value="<?= htmlspecialchars($_SESSION['form_data']['first_name'] ?? ''); ?>" autocomplete="off"
                                           name="first_name_input"
                                           placeholder="enter first name...">

                                    <span class="focus-input100-1">
                                    </span>

                                    <span class="focus-input100-2">
                                    </span>
                                </div>

                                <div class="wrap-input100 validate-input">
                                    <input class="input100" type="text" value="<?= htmlspecialchars($_SESSION['form_data']['last_name'] ?? ''); ?>"
                                           autocomplete="off" name="last_name_input"
                                           placeholder="enter last name..." required>

                                    <span class="focus-input100-1">
                                    </span>

                                    <span class="focus-input100-2">
                                    </span>
                                </div>

                                <div class="wrap-input100 validate-input">
                                    <input class="input100" type="email" value="<?= htmlspecialchars($_SESSION['form_data']['email'] ?? ''); ?>" autocomplete="off" name="email"
                                           placeholder="enter email..." required>

                                    <span class="focus-input100-1">
                                    </span>

                                    <span class="focus-input100-2">
                                    </span>
                                </div>

                                <div class="wrap-input100 rs1 validate-input">

                                    <input class="input100" type="password" name="password"

                                           placeholder="Password..." autocomplete="current-password" required>

                                </div>

                                <div class="wrap-input100 rs1 validate-input">

                                    <input class="input100" type="password" name="retype_password"
                                           placeholder="retype password..." autocomplete="current-password" required>
                                </div>
                                    <!-- div to show reCAPTCHA -->
                                  <div  class="my-3">
                                      <div class="g-recaptcha"
                                           data-sitekey="6LcZ-Z8qAAAAAI4WpJaweSPKCEQAfo-R4VF-ETZD">
                                      </div>
                                  </div>
                                <button type="submit" class="login100-form-btn" id="login100-form-btn">
                                    <div class="btntext">
                                        register
                                    </div>

                                    <div class="spinnershow d-none">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>

                                    </div>
                                </button>

                                <p class="lead mt-3 d-flex justify-content-between">
                                    <span>Already have an account?</span>
                                    <a href="/online_shop/login" class="text-center"> Login </a>

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