function validarFormulario(event) {
  event.preventDefault();

  var email = document.getElementById('email').value;
  var senha = document.getElementById('senha').value;

  if (!email) {
    alert('Por favor, informe o e-mail.');
    return;
  }

  var regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
  if (!regexEmail.test(email)) {
    alert('Por favor, informe um e-mail válido.');
    return;
  }

  if (!senha) {
    alert('Por favor, informe a senha.');
    return;
  }

  document.getElementById('form').submit();
}
