function mascaraTelefone(e, campoTelefone) {

    var tecla = (window.event) ? event.keyCode : e.which;

//se precionar numeros faço a funcao
    if ((tecla !== 8) & (tecla != 46)) {
        var telefone = campoTelefone.value;

//        validadando posicao 
        if (telefone.substring(0, 1) !== "(") {
            telefone = '(' + telefone;
            campoTelefone.value = telefone;
            return true;
        }

        if (telefone.charAt(3) !== ")" && telefone.length > 2) {
            telefone = telefone + ')';
            campoTelefone.value = telefone;
            return true;
        }
   }
}
