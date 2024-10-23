<div class="container-fluid register-fluid">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="register-box">
                    <div class="register-head">
                        <div class="register-imgbox">
                            <img src="<?=base_url('assets/images/reg_header.jpg')?>" alt="Register header image">
                        </div>
                    </div>
                    <div class="register-body">
                        <div class="col-12">
                            <div class="regular-title register-title">
                                Regisztráció
                            </div>
                        </div>
                        <div class="col-12">
                            <form action="<?=base_url('regUser')?>" method="POST">
                                <div class="row">
                                    <div class="col-6 text-center">
                                        <div class="form-group">
                                            <label for="validationServer01" class="form-label">First name</label>
                                            <input type="text" name="first_name" id="first_name" placeholder="Vezetéknév" required>
                                            <div class="valid-feedback">
                                            Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="last_name" placeholder="Keresztnév" required>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" placeholder="E-mail cím" required>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" placeholder="Jelszó" required>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="form-group">
                                            <input type="password" name="password2" id="password2" placeholder="Jelszó 2x" required>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <input type="submit" value="Regisztráció" class="standard-btn">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>