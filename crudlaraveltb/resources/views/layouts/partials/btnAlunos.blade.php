<!-- Modal das Info dos alunos  -->
<div class="modal fade" id="alunoModalInfo" tabindex="-1" aria-labelledby="alunoModalInfoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alunoModalInfoLabel">Informações do Aluno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nome:</strong> <span id="modalNome"></span></p>
                <p><strong>Curso:</strong> <span id="modalCurso"></span></p>
                <p><strong>Turma:</strong> <span id="modalTurma"></span></p>
                <p><strong>CPF:</strong> <span id="modalCpf"></span></p>
                <p><strong>Nome dos Pais:</strong> <span id="modalNomePais"></span></p>
                <p><strong>Telefone:</strong> <span id="modalTelefone"></span></p>
                <p><strong>Telefone dos Pais:</strong> <span id="modalTelefonePais"></span></p>
                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                <p><strong>Email dos Pais:</strong> <span id="modalEmailPais"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="modalEditButton">Editar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de cadastro -->
<div class="modal fade" id="alunoModal" tabindex="-1" aria-labelledby="alunoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alunoModalLabel">Formulário de Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="infoForm" data-store-url="{{ route('alunos.store') }}" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome">
                        <label for="nome">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="curso" class="form-select " name="curso">
                            <!-- As opções são preenchidas via JavaScript -->
                        </select>
                        <label for="curso">Curso</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="turma" class="form-select" name="turma">
                            <!-- As opções são preenchidas via JavaScript -->
                        </select>
                        <label for="turma">Turma</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="cpf" placeholder="CPF" name="cpf">
                        <label for="cpf">CPF</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome_pais" placeholder="Nome dos Pais"
                            name="nome_pais">
                        <label for="nome_pais">Nome dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefone" placeholder="Telefone"
                            name="telefone">
                        <label for="telefone">Telefone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefone_pais" placeholder="Telefone dos Pais"
                            name="telefone_pais">
                        <label for="telefone_pais">Telefone dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email_pais" placeholder="Email dos Pais"
                            name="email_pais">
                        <label for="email_pais">Email dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">

                        <input type="file" id="foto" name="foto" accept="image/*">

                        <div id="imagePreviewContainer">
                            <img id="imagePreview" class="img-preview" alt="">
                        </div>
                    </div>
                    <!-- Botão de Enviar -->
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>





<!-- Container para adicionar o novo conteúdo -->
<div id="alunoContainer" class="mt-4"></div>
