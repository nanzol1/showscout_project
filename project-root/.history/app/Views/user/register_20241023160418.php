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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input type="text" name="first_name" id="first_name">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="last_name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email">
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <input type="submit" value="Regisztráció">
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