document.addEventListener('DOMContentLoaded', function() {
    const nomeAdd = document.querySelector("#text");
    const dataAdd = document.querySelector("#date");
    const emailAdd = document.querySelector("#email");
    const telAdd = document.querySelector("#tele");
    const cpfAdd = document.querySelector("#cpf");
    const idAdd = document.querySelector("#textId");
    const botao = document.getElementById("button-cad");
    const botaoEditar = document.getElementById("button-entrar");
    const botaoRemover = document.getElementById("button-remove");

    let nome, data, email, id , telefone, cpf= '';
    let cont = 0;

    window.onload= adicionarNaTabela();

    botao.addEventListener('click', ()=>{
        data = dataAdd.value;
        nome = nomeAdd.value;
        email = emailAdd.value;
        telefone = telAdd.value;
        cpf = cpfAdd.value;

        cont++;

        setPessoas(cont, nome, data, email, telefone, cpf);
        adicionarNaTabela();

        if (validarCPF(cpf) && validarTelefoneFormatoBR(telefone)) {
            alert('Usuário cadastrado com sucesso!');
        } else {
            if (!validarCPF(cpf) && !validarTelefoneFormatoBR(telefone)) {
                alert('CPF e telefone inválidos!');
            }else if (!validarCPF(cpf)) {
                alert('CPF inválido!');
            } else if(!validarTelefoneFormatoBR(telefone)){
                alert('Telefone inválido!');
            }
        }

    });

    botaoEditar.addEventListener('click', () => {
        id = idAdd.value;

        if (id !== null && id !== "" && id >= 0) {
            const novoNome = prompt("Novo nome:");
            const novoEmail = prompt("Novo email:");
            const novaData = prompt("Nova data:");
            const novoTelefone = prompt("Nova telefone:");
            const novoCPF = prompt("Novo CPF:");

            setPessoas(id, novoNome, novoEmail, novaData, novoTelefone, novoCPF);
            adicionarNaTabela(cont);
            atualizarTabela(id, novoNome, novoEmail, novaData, novoTelefone, novoCPF);
        } else {
            alert("ID inválido!");
        }
    });

    botaoRemover.addEventListener('click', () => {
        id = idAdd.value;

        if (id !== null && id !== "" && id >= 0) {
            excluirLinha(id);
        } else {
            alert("ID inválido!");
        }
    });
});

function setPessoas(cont, nome, data, email, telefone, cpf) {
    const usuario = {
        cont: cont,
        nome: nome,
        email: email,
        data: data,
        telefone: telefone,
        cpf: cpf
    };
    localStorage.setItem('usuario', JSON.stringify(usuario));
}

function adicionarNaTabela(cont) {
    const usuario = JSON.parse(localStorage.getItem('usuario'));

    if (usuario) {
        const tbody = document.querySelector('.tbody');
        var novaLinha = document.createElement('tr');
        novaLinha.setAttribute('id', 'linha-' + cont);
        novaLinha.innerHTML = `
            <td>${usuario.cont}</td>
            <td>${usuario.nome}</td>
            <td>${usuario.email}</td>
            <td>${usuario.data}</td>
            <td>${usuario.telefone}</td>
            <td>${usuario.cpf}</td>
        `;
        tbody.appendChild(novaLinha);
    }
}

function  atualizarTabela(id, novoNome, novoEmail, novaData, novoTelefone, novoCPF) {
    var linha = document.getElementById('linha-' + id);
    
    if (linha) {
        var celulas = linha.getElementsByTagName('td');
        
        celulas[1].innerText = novoNome; 
        celulas[2].innerText = novoEmail; 
        celulas[3].innerText = novaData; 
        celulas[4].innerText = novoTelefone; 
        celulas[5].innerText = novoCPF; 
    } else {
        alert("Linha não encontrada!");
    }
}

function excluirLinha(id) {
    var linha = document.getElementById('linha-' + id);
    
    if (linha) {
        linha.parentNode.removeChild(linha);
    } else {
        alert("Linha não encontrada!");
    }
}

function validarTelefoneFormatoBR(telefone) {
    if (telefone.toString().length !== 11) {
        return false;
    }
    
    const regexTelefoneFormatoBR = /^[1-9]{2}\d{9}$/;

    return regexTelefoneFormatoBR.test(telefone);
}

function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]/g, ''); 

    if (cpf.length !== 11) {
        return false;
    }

    if (/^(\d)\1{10}$/.test(cpf)) {
        return false;
    }

    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = 11 - (soma % 11);
    let dv1 = resto === 10 || resto === 11 ? 0 : resto;

    if (dv1 !== parseInt(cpf.charAt(9))) {
        return false;
    }

    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = 11 - (soma % 11);
    let dv2 = resto === 10 || resto === 11 ? 0 : resto;

    if (dv2 !== parseInt(cpf.charAt(10))) {
        return false;
    }

    return true;
}