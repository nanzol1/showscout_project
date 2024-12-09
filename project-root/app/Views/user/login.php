<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 pb-5">

            <div class="card shadow-sm">
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <h3 class="text-center mb-4">Bejelentkezés</h3>
                    <form action="login/authenticate" method="POST">
                        <?= csrf_field() ?>

                        <div class="form-group mb-3">
                            <label for="username">Felhasználónév</label>
                            <input class="form-control" type="text" id="username" name="username" placeholder="Felhasználónév" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Jelszó</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Jelszó" required>
                            <div class="mt-2">
                                <input type="checkbox" onclick="togglePassword()"> Jelszó megjelenítése
                            </div>
                        </div>
                        <script>
                            function togglePassword() {
                                var x = document.getElementById("password");
                                x.type = x.type === "password" ? "text" : "password";
                            }
                        </script>

                        <div class="form-group mb-3">
                            <button class="btn btn-primary w-100" type="submit">Bejelentkezés</button>
                        </div>

                    </form>

                    <div class="mt-3 text-center">
                        <p>Nem rendelkezik még fiókkal? <a href="register">Regisztráljon itt</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
