<!-- Modal de Edição -->
<div class="modal fade" id="editarAlunoModal" tabindex="-1" aria-labelledby="editarAlunoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarAlunoModalLabel">Formulário de Edição</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- O método PUT é usado para edição -->
                    <input type="hidden" id="alunoId" name="id">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nomeEditar" placeholder="Nome" name="nome"
                            value="">
                        <label for="nomeEditar">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="cursoEditar" class="form-select " name="curso">
                            <!-- As opções são preenchidas via JavaScript -->
                        </select>
                        <label for="cursoEditar">Curso</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="turmaEditar" class="form-select" name="turma">
                            <!-- As opções são preenchidas via JavaScript -->
                        </select>
                        <label for="turmaEditar">Turma</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="cpfEditar" placeholder="CPF" name="cpf"
                            value="">
                        <label for="cpfEditar">CPF</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome_paisEditar" placeholder="Nome dos Pais"
                            name="nome_pais" value="">
                        <label for="nome_paisEditar">Nome dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefoneEditar" placeholder="Telefone"
                            name="telefone" value="">
                        <label for="telefoneEditar">Telefone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefone_paisEditar"
                            placeholder="Telefone dos Pais" name="telefone_pais" value="">
                        <label for="telefone_paisEditar">Telefone dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="emailEditar" placeholder="Email" name="email"
                            value="">
                        <label for="emailEditar">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email_paisEditar" placeholder="Email dos Pais"
                            name="email_pais" value="">
                        <label for="email_paisEditar">Email dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="file" id="fotoEditar" name="foto" accept="image/*">
                        <div id="imagePreviewContainerEditar">
                            <img id="imagePreviewEditar" class="img-preview" alt="">
                        </div>
                    </div>
                    <!-- Botão de Enviar -->
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>