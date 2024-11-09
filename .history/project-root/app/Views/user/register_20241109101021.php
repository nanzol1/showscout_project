<div class="container-fluid register-fluid">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-10">
            <div class="registration-container">
               <h1>Regisztráció</h1>
               <div class="form-box">
                  <form action="<?=base_url('regUser')?>" method="POST" id="reglog_form">
                     <div class="form-row">
                        <div class="form-group">
                           <label for="validationCustom01" id="warning-label" class="warning-label">Vezetéknév</label>
                           <input type="text" id="validationCustom01" placeholder="Vezetéknév">
                        </div>
                        <div class="form-group">
                           <label for="validationCustom02" id="warning-label-first-name" class="warning-label">Keresztnév</label>
                           <input type="text" id="validationCustom02" placeholder="Keresztnév">
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group">
                           <label for="validationCustom03" id="warning-label-username" class="warning-label">Felhasználónév</label>
                           <input type="text" id="validationCustom03" placeholder="Felhasználónév">
                        </div>
                        <div class="form-group">
                           <label for="validationCustom04" id="warning-label-email" class="warning-label">Email</label>
                           <input type="email" id="validationCustom04" placeholder="example@example.com">
                        </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group">
                           <label for="validationCustom05" id="warning-label-password" class="warning-label">Jelszó</label>
                           <input type="password" id="validationCustom05" placeholder="Jelszó">
                        </div>
                        <div class="form-group">
                           <label for="validationCustom06" id="warning-label-password2" class="warning-label">Jelszó megerősítése</label>
                           <input type="password" id="validationCustom06" placeholder="Jelszó megerősítése">
                        </div>
                     </div>
                     <div class="form-group full-width">
                        <button type="submit" value="Regisztráció" class="standard-btn submit-btn">Regisztráció</button>
                     </div>
                  </form>
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
           'use strict';
   
           // Fetch all the forms we want to apply custom Bootstrap validation styles to
           var forms = document.querySelectorAll('.needs-validation');
   
           // Loop over them and prevent submission
           Array.prototype.slice.call(forms)
               .forEach(function (form) {
                   form.addEventListener('submit', function (event) {
                       if (!form.checkValidity()) {
                           event.preventDefault();
                           event.stopPropagation();
                       }
                   }, false);
               });
       })();
   
       addEventListener('DOMContentLoaded', (e) => {
           e.preventDefault();
           let password = document.getElementById('validationCustom05'); // Password field
           let password2 = document.getElementById('validationCustom06'); // Confirm Password field
           let email = document.getElementById('validationCustom04'); // Email field
           let username = document.getElementById('validationCustom03'); // Username field
           let lastName = document.getElementById('validationCustom01'); // Last Name field
           let lastNameRegExp = /^(?![-\s])([A-ZÁÉÍÓÖŐÚÜ][a-záéíóöőúü]+)(?:[-\s][A-ZÁÉÍÓÖŐÚÜ][a-záéíóöőúü]+)*$/;
           let firstName = document.getElementById('validationCustom02'); // First Name field
           let firstNameRegExp = /^(?!\s)([A-ZÁÉÍÓÖŐÚÜ][a-záéíóöőúü]+)(?: [A-ZÁÉÍÓÖŐÚÜ][a-záéíóöőúü]+)*(?<!\s)$/;
           let logreg_form = document.querySelector('#reglog_form');
           let button = document.querySelector('.submit-btn');
           let regExp = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/;
           let userRegExp = /^[a-zA-Z0-9][a-zA-Z0-9]{3,}$/;
           let passwrd = document.getElementById('warning-label-password');
           let passwrd2 = document.getElementById('warning-label-password2');
           let inputs = document.querySelectorAll('input');
           let emailExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
   
           inputs.forEach(input => {
               input.addEventListener('change', (e) => {
                   const label = document.querySelector(`label[for='${e.target.id}']`);
                   console.log(e.target.id);
   
                   if (e.target.id === 'validationCustom01') { // Last Name
                   if (lastName.value.length < 1) {
                       label.innerText = "A mező kitöltése kötelező!";
                       lastName.classList.add('is-invalid');
                   } else if (!lastName.value.match(lastNameRegExp)) {
                       label.innerText = "Nem megfelelő a vezetéknév formátuma!";
                       lastName.classList.add('is-invalid');
                   } else {
                       label.innerText = "";
                       lastName.classList.remove('is-invalid');
                       lastName.classList.add('is-valid');
                   }
   
                   }  else if (e.target.id === 'validationCustom02') { // First Name
                       if (firstName.value.length < 1) {
                           label.innerText = "A mező kitöltése kötelező!";
                           firstName.classList.add('is-invalid');
                       } else if (!firstName.value.match(firstNameRegExp)) {
                           label.innerText = "Nem megfelelő a keresztnév formátuma!";
                           firstName.classList.add('is-invalid');
                       } else {
                           label.innerText = "";
                           firstName.classList.remove('is-invalid');
                           firstName.classList.add('is-valid');
                       }
   
                   } else if (e.target.id === 'validationCustom03') { // Username
                       if (username.value.length < 4) {
                           label.innerText = "A felhasználónév minimum 4 karakter kell legyen!";
                           username.classList.add('is-invalid');
                       } else if (!username.value.match(userRegExp)) {
                           label.innerText = "Nem megfelelő a felhasználónév formátuma!";
                           username.classList.add('is-invalid');
                       } else {
                           label.innerText = "";
                           username.classList.remove('is-invalid');
                           username.classList.add('is-valid');
                       }
                   } else if (e.target.id === 'validationCustom04') { // Email
                       if (!email.value.match(emailExp)) {
                           label.innerText = "Nem megfelelő az email formátuma!";
                           email.classList.add('is-invalid');
                       } else {
                           label.innerText = "";
                           email.classList.remove('is-invalid');
                           email.classList.add('is-valid');
                       }
                   } else if (e.target.id === 'validationCustom05') { // Password
                       if (password.value.length > 0 && !password.value.match(regExp)) {
                           label.innerText = "Nem megfelelő a jelszó formátuma!";
                           password.classList.add('is-invalid');
                       } else {
                           label.innerText = "";
                           password.classList.remove('is-invalid');
                           password.classList.add('is-valid');
                       }
                   } else if (e.target.id === 'validationCustom06') { // Confirm Password
                       if (password2.value.length > 0 && !password2.value.match(regExp)) {
                           label.innerText = "Nem egyezik a két jelszó!";
                           password2.classList.add('is-invalid');
                       } else {
                           label.innerText = "";
                           password2.classList.remove('is-invalid');
                           password2.classList.add('is-valid');
                       }
                   }
               });
           });
   
           logreg_form.addEventListener('submit', (e) => {
               e.preventDefault();
               let valid = true;
   
               // Last Name validation
               if (lastName.value.length <= 0) {
                   document.getElementById('warning-label').innerHTML = "A mező kitöltése kötelező!";
                   valid = false;
                   lastName.classList.add('is-invalid');
               } else {
                   document.getElementById('warning-label').innerHTML = "";
                   if (!lastName.value.match(lastNameRegExp)) {
                       document.getElementById('warning-label').innerHTML = "Nem megfelelő a vezetéknév formátuma!";
                       valid = false;
                       lastName.classList.add('is-invalid');
                   } else {
                       lastName.classList.remove('is-invalid');
                       lastName.classList.add('is-valid');
                   }
               }
   
               // First Name validation
               if (firstName.value.length <= 0) {
                   document.getElementById('warning-label-first-name').innerHTML = "A mező kitöltése kötelező!";
                   valid = false;
                   firstName.classList.add('is-invalid');
               } else {
                   document.getElementById('warning-label-first-name').innerHTML = "";
                   if (!firstName.value.match(firstNameRegExp)) {
                       document.getElementById('warning-label-first-name').innerHTML = "Nem megfelelő a keresztnév formátuma!";
                       valid = false;
                       firstName.classList.add('is-invalid');
                   } else {
                       firstName.classList.remove('is-invalid');
                       firstName.classList.add('is-valid');
                   }
               }
   
               // Username validation
               if (username.value.length <= 0) {
                   document.getElementById('warning-label-username').innerHTML = "A mező kitöltése kötelező!";
                   valid = false;
                   username.classList.add('is-invalid');
               } else {
                   document.getElementById('warning-label-username').innerHTML = "";
                   if (!username.value.match(userRegExp)) {
                       document.getElementById('warning-label-username').innerHTML = "Nem megfelelő a felhasználónév formátuma!";
                       valid = false;
                       username.classList.add('is-invalid');
                   }
               }
   
               // Password validation
               if (password.value.length <= 0) {
                   document.getElementById('warning-label-password').innerHTML = "A mező kitöltése kötelező!";
                   valid = false;
                   password.classList.add('is-invalid');
               } else {
                   document.getElementById('warning-label-password').innerHTML = "";
                   if (!password.value.match(regExp)) {
                       document.getElementById('warning-label-password').innerHTML = "Nem megfelelő a jelszó formátuma!";
                       valid = false;
                       password.classList.add('is-invalid');
                   }
               }
   
               // Confirm Password validation
               if (password2.value.length <= 0) {
                   document.getElementById('warning-label-password2').innerHTML = "A mező kitöltése kötelező!";
                   valid = false;
                   password2.classList.add('is-invalid');
               } else {
                   document.getElementById('warning-label-password2').innerHTML = "";
                   if (!password2.value.match(regExp)) {
                       document.getElementById('warning-label-password2').innerHTML = "Nem megfelelő a jelszó formátuma!";
                       valid = false;
                       password2.classList.add('is-invalid');
                   }
               }
   
               // Email validation
               if (email.value.length <= 0) {
                   document.getElementById('warning-label-email').innerHTML = "A mező kitöltése kötelező!";
                   valid = false;
                   email.classList.add('is-invalid');
               } else {
                   document.getElementById('warning-label-email').innerHTML = "";
                   if (!email.value.match(emailExp)) {
                       document.getElementById('warning-label-email').innerHTML = "Nem megfelelő az email formátuma!";
                       valid = false;
                       email.classList.add('is-invalid');
                   }
               }
   
               // Passwords match validation
               if (password2.value !== password.value) {
                   passwrd2.innerHTML = "A két jelszó nem egyezik egymással!";
                   valid = false;
                   password2.classList.add('is-invalid');
               }
   
               // Submit if valid
               if (valid) {
                   logreg_form.submit();
               }
           });
       });
   });
</script>
