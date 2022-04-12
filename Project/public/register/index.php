<?php include_once "../partials/headerLogin.php"; ?>

<!-- REGISTER PAGE -->
    <main class="login register">
        <div class = "register-container">
        <h2 class="header">Sign Up</h2>
            <!-- Input form for login -->
        <section class="login-form">
            <form action="register.php" method="post" class="">
                <input type="text" class="" name="username" id="username" placeholder="Username.." required>
                <input type="email" class="" name="email" id="email" placeholder="Email..." required>
                <input type="password" class="" name="password" id="pswd" placeholder="Password..." required>
                <input type="submit" class="submit-button" value="Sign Up">
            </form>
            <!-- Text at the bottom of login and register forms -->
            <div class="login-options">
                <a>Already a member?</a><a href="../login/index.php" style="color: #E1C45F">Sign In.</a>
            </div>
            <div class="msg"></div>
        </section>
        </div>

    </main>
<!-- Script that shows message -->
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


