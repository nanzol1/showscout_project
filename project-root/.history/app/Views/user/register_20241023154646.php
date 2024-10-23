<div class="container-fluid">
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
                            <div class="regular-title">
                                Regisztráció
                            </div>
                        </div>
                        <form action="<?=base_url('regUser')?>" method="POST">
                            <div class="col-6">
                                <input type="text" name="first_name" id="first_name">
                            </div>
                            <div class="col-6">
                                <input type="text" name="last_name" id="last_name">
                            </div>
                            <div class="col-12">
                                <input type="email" name="email" id="email">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>