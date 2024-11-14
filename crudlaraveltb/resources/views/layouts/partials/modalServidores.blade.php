<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

</head>
<body>
    

<!-- Modal -->
<div class="modal fade" id="ServidorModal" tabindex="-1" role="dialog" aria-labelledby="ServidorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ServidorModalLabel">Gerar Chave Única</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Input de Nome Completo -->
                <div class="form-group">
                    <label for="contractNumberInput">Nome Completo</label>
                    <input type="text" class="form-control" id="contractNumberInput" placeholder="Digite o nome completo">
                </div>

                <!-- Dropdown de Função -->
                <div class="form-group">
                    <label for="roleSelect">Função</label>
                    <select class="form-control" id="roleSelect">
                        <option value="terceirizado">Terceirizado</option>
                        <option value="professor">Professor</option>
                        <option value="enfermaria">Enfermaria</option>
                        <option value="administrador">Administrador</option>
                    </select>
                </div>

                <!-- Chave Gerada -->
                <div class="form-group">
                    <label for="generatedKey">Chave Gerada</label>
                    <input type="text" class="form-control" id="generatedKey" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="generateUniqueKey()">Gerar Chave Única</button>
                <button type="button" class="btn btn-success" onclick="submitForm()">Salvar</button>
            </div>
        </div>
    </div>
</div>

<script>
// Obtém o token CSRF do meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Função para gerar uma chave única
function generateUniqueKey() {
    const name = document.getElementById("contractNumberInput").value;
    const role = document.getElementById("roleSelect").value;
    const generatedKey = document.getElementById("generatedKey");

    if (!name) {
        alert("Por favor, insira um nome.");
        return;
    }

    const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const numbers = "0123456789";
    let key = "";

    // Adicionar 4 letras aleatórias
    for (let i = 0; i < 4; i++) {
        key += letters.charAt(Math.floor(Math.random() * letters.length));
    }

    // Adicionar 2 números aleatórios
    for (let i = 0; i < 2; i++) {
        key += numbers.charAt(Math.floor(Math.random() * numbers.length));
    }

    // Definir o último dígito de acordo com a função
    let finalDigit;
    switch (role) {
        case "terceirizado":
            finalDigit = Math.random() < 0.5 ? "2" : "3";
            break;
        case "professor":
            finalDigit = Math.random() < 0.5 ? "4" : "5";
            break;
        case "enfermaria":
            finalDigit = Math.random() < 0.5 ? "6" : "7";
            break;
        case "administrador":
            finalDigit = Math.random() < 0.5 ? "0" : "1";
            break;
    }
    key += finalDigit;

    // Exibir a chave gerada no campo de saída
    generatedKey.value = key;

    fetch('/chaves-temporarias/store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            nome: name,
            chave: key
        })
    });
}

// Função para enviar o formulário
function submitForm() {
    const name = document.getElementById("contractNumberInput").value;
    const role = document.getElementById("roleSelect").value;
    const generatedKey = document.getElementById("generatedKey").value;

    if (!name || !generatedKey) {
        alert("Por favor, insira o nome e gere uma chave antes de salvar.");
        return;
    }

    fetch('/chaves-temporarias/store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            nome: name,
            funcao: role,
            chave: generatedKey
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Chave salva com sucesso!");
            $('#ServidorModal').modal('hide');
        } else {
            alert("Erro ao salvar a chave. Tente novamente.");
        }
    })
    .catch(error => {
        console.error("Erro:", error);
        alert("Ocorreu um erro ao salvar a chave.");
    });
}

</script>
</body>
</html>