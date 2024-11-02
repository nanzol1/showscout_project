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
                            <form action="<?=base_url('regUser')?>" method="POST" id="reglog_form" class="needs-validation" novalidate>
                                <div class="row">
                                    <?php if(session('error')):?>
                                        <div class="col-12 text-center">
                                            <?=session('error')?>
                                        </div>
                                    <?php endif;?>
                                    <div class="col-12 text-center">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="validationCustom01" name="username" placeholder="Felhasználónév" required>
                                            <label for="validationCustom01" id="warning-label" class="warning-label"></label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" id="validationCustom03" placeholder="E-mail cím" required>
                                            <label for="validationCustom03" id="warning-label-email" class="warning-label"></label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control" id="validationCustom04" placeholder="Jelszó" required>
                                            <label for="validationCustom04" id="warning-label-password" class="warning-label"></label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="form-group">
                                            <input type="password" name="password2" class="form-control" id="validationCustom05" placeholder="Jelszó 2x" required>
                                            <label for="validationCustom05" id="warning-label-password2" class="warning-label"></label>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <input type="submit" value="Regisztráció" class="standard-btn submit-btn">
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
<script>
    function docReady(fn) {
        if (document.readyState === "complete" || document.readyState === "interactive") {
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }    

    docReady(function(){
        (function () {
          'use strict'

          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.querySelectorAll('.needs-validation');

          // Loop over them and prevent submission
          Array.prototype.slice.call(forms)
            .forEach(function (form) {
              form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                  event.preventDefault()
                  event.stopPropagation()
                }
            
              }, false)
            })
        })()
        addEventListener('DOMContentLoaded', (e) =>{
            e.preventDefault();
            let password = document.getElementById('validationCustom04');
            let password2 = document.getElementById('validationCustom05');
            let email = document.getElementById('validationCustom03');
            let logreg_form =  document.querySelector('#reglog_form');
            let button =document.querySelector('.submit-btn');
            let regExp = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/;
            let userRegExp = /^[a-zA-Z0-9][a-zA-Z0-9]{3,}$/;
            let username = document.getElementById('validationCustom01');
            let passwrd = document.getElementById('warning-label-password');
            let passwrd2 = document.getElementById('warning-label-password2');
            let inputs = document.querySelectorAll('input');
            let emailExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            inputs.forEach(input => {
                input.addEventListener('change', (e) => {
                    const label = document.querySelector(`label[for='${e.target.id}']`);
                    console.log(e.target.id);

                    if (e.target.id === 'validationCustom01') {
                        if (username.value.length < 4) {
                            label.innerText = "A felhasználónév minimum 4 karakter kell legyen!";
                            username.classList.add('is-invalid');
                        } else if (!username.value.match(userRegExp)) {
                            label.innerText = "A felhasználónév formátuma nem megfelelő!";
                            username.classList.add('is-invalid');
                        } else {
                            label.innerText = "";
                            username.classList.remove('is-invalid');
                            username.classList.add('is-valid');
                        }
                    } else if (e.target.id === 'validationCustom03') {
                        if (!email.value.match(emailExp)) {
                            label.innerText = "Az email formátuma nem megfelelő!";
                            email.classList.add('is-invalid');
                        } else {
                            label.innerText = "";   
                            email.classList.remove('is-invalid');
                            email.classList.add('is-valid');
                        }
                    } else if (e.target.id === 'validationCustom04') {
                        if (password.value.length > 0 && !password.value.match(regExp)) {
                            label.innerText = "A jelszó formátuma nem megfelelő!";
                            password.classList.add('is-invalid');
                        } else {
                            label.innerText = "";
                            password.classList.remove('is-invalid');
                            password.classList.add('is-valid');
                        }
                    } else if (e.target.id === 'validationCustom05') {
                        if (password2.value.length > 0 && !password2.value.match(regExp)) {
                            label.innerText = "A jelszó formátuma nem megfelelő!";
                            password2.classList.add('is-invalid');
                        } else {
                            label.innerText = "";
                            password2.classList.remove('is-invalid');
                            password2.classList.add('is-valid');
                        }
                    }
                });
            });
            logreg_form.addEventListener('submit',(e) =>{
                e.preventDefault();
                let valid = true;
                if(username.value.length <= 0){
                    document.getElementById('warning-label').innerHTML = "A mező kitöltése kötelező!";
                    valid = false;
                    username.classList.add('is-invalid');
                }else{
                    document.getElementById('warning-label').innerHTML = "";
                    if(!username.value.match(userRegExp)){
                        document.getElementById('warning-label').innerHTML = "Nem megfelelő a felhasználónév formátuma!";
                        valid = false;
                    username.classList.add('is-invalid');

                    }
                }
                if(password.value.length <= 0){
                    document.getElementById('warning-label-password').innerHTML = "A mező kitöltése kötelező!";
                    valid = false;
                    password.classList.add('is-invalid');
                }else{
                    document.getElementById('warning-label-password').innerHTML = "";
                    if(!password.value.match(regExp)){
                        document.getElementById('warning-label-password').innerHTML = "Nem megfelelő a jelszó formátuma!";
                        valid = false;
                        password.classList.add('is-invalid');
                    }
                }
                if(password2.value.length <= 0){
                    document.getElementById('warning-label-password2').innerHTML = "A mező kitöltése kötelező!";
                    valid = false;
                    password2.classList.add('is-invalid');
                }else{
                    document.getElementById('warning-label-password2').innerHTML = "";
                    if(!password2.value.match(regExp)){
                        document.getElementById('warning-label-password2').innerHTML = "Nem megfelelő a jelszó formátuma!";
                        valid = false;
                        password2.classList.add('is-invalid');
                    }
                }
                if(email.value.length <= 0){
                    document.getElementById('warning-label-email').innerHTML = "A mező kitöltése kötelező!";
                    valid = false;
                    email.classList.add('is-invalid');
                }else{
                    document.getElementById('warning-label-email').innerHTML = "";
                    if(!email.value.match(emailExp)){
                        document.getElementById('warning-label-email').innerHTML = "Nem megfelelő az email formátuma!";
                        valid = false;
                        email.classList.add('is-invalid');
                        
                    }
                }
                if(password2.value != password.value){
                    passwrd2.innerHTML = "A két jelszó nem egyezik egymással!";
                    valid = false;
                    password2.classList.add('is-invalid');
                }
               if(valid){
                logreg_form.submit();
               }
            });
        });
    });
</script>