var passwordIcon = document.getElementById('password-icon'); 
var inputPassword = document.getElementById('password-input');

passwordIcon.addEventListener('mousedown', function() {
  inputPassword.type = 'text';
  passwordIcon.src = 'img/icons/eye-close.svg';
});

passwordIcon.addEventListener('mouseup', function() {
  inputPassword.type = 'password';
  passwordIcon.src = 'img/icons/fa_eye.svg';
});

passwordIcon.addEventListener('mouseleave', function() {
  inputPassword.type = 'password';
  passwordIcon.src = 'img/icons/fa_eye.svg';
});



// -------------- DONT REMOVE THIS ---------------------
// passwordIcon.addEventListener('click', function(e) {
//   if (passwordIcon.className.includes('password-hidden')) {
//     passwordIcon.src = 'img/icons/eye-close.svg'
//     passwordIcon.classList.add('password-show');
//     passwordIcon.classList.remove('password-hidden');
//     inputPassword.setAttribute('type', 'text')
//   } else if (passwordIcon.className.includes('password-show')) {
//     inputPassword.setAttribute('type', 'password')
//     passwordIcon.src = 'img/icons/fa_eye.svg'
//     passwordIcon.classList.add('password-hidden');
//     passwordIcon.classList.remove('password-show');
//   }
// })