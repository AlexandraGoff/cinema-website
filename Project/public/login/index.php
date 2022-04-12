<?php include_once "../partials/headerLogin.php"; ?>
<!-- LOGIN PAGE -->
    <main class="login">
        <div class="login-container">
        <h2 class="header">Login</h2>
            <!-- form for user input -->
        <section class="login-form">
            <!-- Authentication -->
            <form action="authenticate.php" method="post">
                <!-- User input for username with cookies -->
                <input type="text" class="" name="username" id="username" placeholder="Username..." value="<?php  if (isset($_COOKIE["username"])) {
                    echo $_COOKIE["username"];
                }
                else{
                    echo "";
                } ?>" required>
                <input type="password" class="" name="password" id="pswd" placeholder="Password..." required>
                <input type="submit" class="submit-button" value="Sign In">
            </form>
            <div class="login-options">
                <div>
                    <!-- text on the bottom of login container -->
                    <a>Not a member?</a><a href="../register" style="color: #E1C45F"> Sign Up.</a>
                </div>
            </div>
        </section>
        </div>
    </main>
    <div class="msg"></div>
<!-- Script that shows message-->
    <script>
        let form = document.querySelector('.register form');
        form.onsubmit = function(event) {
            event.preventDefault();
            let form_data = new FormData(form);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.onload = function () {
                document.querySelector('.msg').innerHTML = this.responseText;
                document.querySelector('.msg').classList.add('show');
                let close = document.querySelector('.close');
                close.addEventListener("click", function(){
                    document.querySelector('.msg').classList.remove('show');
                });
            };
            xhr.send(form_data);
        };
    </script>
<?php include_once '../partials/footer.php';


