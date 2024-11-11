<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('public/css/style.css') ?>">
    <title>Bejelentkezés</title>
</head>
<body>
    <div class="container">
        <h2>Bejelentkezés</h2>
        <?php if (session()->getFlashdata('error')):?>
            <div class="alert alert-danger">
                <?= session()-> getFlashdata('error')?>
            </div>
        <?php endif; ?>
         <form action="<?= site_url('login/authenticate')?>" method="post">
            <?=csrf_field()?>
            <div class="form-group">
                <label for="username">Felhasználónév</label>
                <input type="text" id="username" name="username" class="form-control" value="<?= old('username')?>" required>
            </div>
            <div class="form-group">
                <label for="password">Jelszó</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Bejelentkezés</button>
         </form>
         <p>Ha még nincs fiókod, regisztrálj <a href="<?= site_url('register') ?>">itt</a>.</p>
    </div>
</body>
</html>