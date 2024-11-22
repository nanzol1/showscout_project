<div class="container mt-5">
    <div class="row">
        <div class="col-lg-4 pb-5">
            <div class="author-card pb-3">
                <div class="author-card-cover"></div>
                <div class="author-card-profile">
                    <div class="author-card-avatar"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Profile picture">
                    </div>
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg"><?=$user['username'] ?? 'Felhasználónév'?></h5><span class="author-card-position"><?=$register_date ?? 'Regisztráció dátuma'?></span>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush">
                    <a class="list-group-item active" href="#">
                        <i class="fe-icon-user text-muted"></i>Profilom
                    </a>
                </nav>
            </div>
        </div>
        <div class="col-lg-8 pb-5">
            <?=session('success')?>
            <?=session('error')?>
            <form class="row" action="<?=base_url('profile/updateUser')?>" method="POST" id="profile_form">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="account-fn">Felhasználónév</label>
                        <input class="form-control" type="text" name="username" id="account-fn" value="<?=$user['username'] ?? 'Felhasználónév'?>" placeholder="<?=$user['username'] ?? 'Felhasználónév'?>" required="">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="account-email">E-mail cím</label>
                        <input class="form-control" type="email" name="email" id="account-email" value="<?=$user['email'] ?? 'E-mail cím'?>" placeholder="<?=$user['email'] ?? 'E-mail cím'?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-pass">Új jelszó</label>
                        <input class="form-control" type="password" name="password" id="account-pass">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-confirm-pass">Új jelszó megerősítése</label>
                        <input class="form-control" type="password" name="password2" id="account-confirm-pass">
                    </div>
                </div>
                <div class="col-12">
                    <hr class="mt-2 mb-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <button class="btn btn-style-1 btn-primary" type="submit" data-toast="" data-toast-position="topRight" data-toast-type="success" data-toast-icon="fe-icon-check-circle" data-toast-title="Success!" data-toast-message="Your profile updated successfuly.">Profil frissítése</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    addEventListener('DOMContentLoaded',(e) =>{
        $('#profile_form').on('submit',function(e){
            e.preventDefault();
            let isValid = false;
            if($('#account-pass').val().match(/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/)){
                if($('#account-pass').val() == $('#account-confirm-pass').val()){
                    isValid = true;
                }
                if(isValid){
                    $('#profile_form')[0].submit();
                }
            }
        });
    });
</script>