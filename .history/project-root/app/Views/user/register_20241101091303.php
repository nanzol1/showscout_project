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
                                    <div class="col-12 text-center">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="validationCustom01" name="username" id="username" placeholder="Felhasználónév" required>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" id="validationCustom03" id="email" placeholder="E-mail cím" required>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control" id="validationCustom04" id="password" placeholder="Jelszó" required>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="form-group">
                                            <input type="password" name="password2" id="password2" class="form-control" id="validationCustom05" id="password2" placeholder="Jelszó 2x" required>
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
            
                form.classList.add('was-validated')
              }, false)
            })
        })()
        addEventListener('DOMContentLoaded', (e) =>{
            e.preventDefault();
            let password = document.getElementById('password');
            let password2 = document.getElementById('password2');
            let logreg_form =  document.querySelector('#reglog_form');
            let button =document.querySelector('.submit-btn');
            let regExp = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/;
            if(!password.value.match(regExp) || password.value != password2.value){
                button.setAttribute('disabled','');
            }
            logreg_form.addEventListener("change", (e) => {
                e.preventDefault();
                if(!password.value.match(regExp) || password.value != password2.value){
                    console.log("Kitöltve: " + e.target.name);
                    console.log("Nem ugyanaz: " + e.target.name);
                    button.setAttribute("disabled","");
                }else{
                    console.log("Egyezés: " + e.target.name);
                    button.removeAttribute("disabled");
                }
            });
        });
    });
</script>