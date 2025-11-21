// Ativa máscara enquanto digita
document.getElementById("cep").addEventListener("input", mascaraCep);

// Busca CEP quando sair do campo
document.getElementById("cep").addEventListener("blur", buscaCep);


function limpaFormularioCep() {
    document.getElementById('logradouro').value = "";
    document.getElementById('bairro').value = "";
    document.getElementById('localidade').value = "";
    document.getElementById('uf').value = "";
}


function preencheFormularioCep(conteudo) {

    if (!("erro" in conteudo)) {
        document.getElementById('logradouro').value = conteudo.logradouro;
        document.getElementById('bairro').value = conteudo.bairro;
        document.getElementById('localidade').value = conteudo.localidade;
        document.getElementById('uf').value = conteudo.uf;

        document.getElementById('numero').focus();
        
    } else {
        limpaFormularioCep();
        alert("CEP não encontrado.");
    }
}


function mascaraCep() {
    let value = document.getElementById("cep").value;

    if (!value) return;

    value = value.replace(/\D/g, '');
    value = value.replace(/(\d{5})(\d)/, '$1-$2');

    document.getElementById("cep").value = value;
}


function buscaCep() {
    
    let cep = document.getElementById("cep").value.replace(/\D/g, '');

    if (cep !== "") {

        let validacep = /^[0-9]{8}$/;

        if (validacep.test(cep)) {

            document.getElementById('logradouro').value = "...";
            document.getElementById('bairro').value = "...";
            document.getElementById('localidade').value = "...";
            document.getElementById('uf').value = "...";

            const url = `https://viacep.com.br/ws/${cep}/json/`;

            fetch(url)
                .then(response => response.json())
                .then(data => preencheFormularioCep(data))
                .catch(() => {
                    limpaFormularioCep();
                    alert("Erro ao consultar o CEP.");
                });

        } else {
            limpaFormularioCep();
            alert("Formato de CEP inválido.");
        }

    } else {
        limpaFormularioCep();
    }
}
