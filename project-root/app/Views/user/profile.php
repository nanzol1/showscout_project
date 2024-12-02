<style>
    html{
        height: 100%;
    }
    body{
        height: 100%;
        position: relative;
    }
</style>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-4 pb-5">
            <div class="author-card pb-3">
                <div class="author-card-cover"></div>
                    <?php if(isset($profile_img) && !empty($profile_img)):?>
                        <?php if($isDefault):?>
                            <div class="author-card-profile">
                                <div class="author-card-avatar"><img src="<?=base_url('assets/images/profile/default/').$profile_img?>" alt="Profile picture">
                            </div>
                        <?php else:?>
                            <div class="author-card-profile">
                                <div class="author-card-avatar"><img src="<?=base_url('assets/images/profile/').$profile_img?>" alt="Profile picture">
                            </div>
                        <?php endif;?>
                    <?php else:?>
                        <div class="author-card-profile">
                            <div class="author-card-avatar"><img src="<?=base_url('assets/images/profile/default/ea2c882fd7b2fea7d607c1ebafad9827.jpg')?>" alt="Profile picture">
                        </div>
                    <?php endif;?>
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
        let dynamicContent = `<div class="container-fluid" id="act_onlay_event">
            <div class="act_onlay_event"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="pselecter-box">
                            <div class="regular-text profile_ptitle mb-3">
                                Válassz a meglévő profilképek közül, vagy tölts fel egy sajátot!
                            </div>
                            <div class="pselector-images">
                                <?php foreach($images as $item):?>
                                    <div class="pselector-defaults">
                                        <button class="img_btn" data-pid="<?=$pid?>" data-imgp="<?=$item?>" name="profile_img"><img src="<?=base_url('assets/images/profile/default/').$item?>" alt="Default image"></button>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <form action="<?=base_url('profile/updateUserPicture/').$pid?>" enctype="multipart/form-data" method="POST" id="profile_form">
                                <input type="file" name="userfile" size="20">
                                <input type="text" name="isimg" value="" id="isimg" hidden>
                                <br><br>
                                <input type="submit" value="Alkalmaz" class="standard-btn upload-btn">
                            </form>
                            <div class="button-block">
                                <button type="button" class="standard-btn undo-btn">Mégse</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        $('.author-card-avatar').on('click',function(){
            $(dynamicContent).insertAfter('header');
            $('#act_onlay_event').toggle(500,function(){
                $('.undo-btn').on('click',function(){
                    $('#act_onlay_event').toggle(500,function(){
                        $('#act_onlay_event').remove();
                    });
                });
                $('.img_btn').on('click',function(){
                    let imgp = $(this).attr('data-imgp');
                    let pid = $(this).attr('data-pid');
                    let formData = new FormData();
                    formData.append('profile_img',imgp);
                    $.ajax({
                        url:'<?=base_url('profile/updateUserPicture/')?>'+pid,
                        method:"POST",
                        data:formData,
                        processData: false, 
                        contentType: false,
                        success:function(response){
                            console.log("Sikeres: "+response.status);
                            location.reload();
                        },
                        error:function(xhr,error,status){
                            console.log(xhr.responseText());
                            console.log('Error: '+error+" "+"Status: "+status);
                        }
                    });
                });
            });
        });
    });
</script>