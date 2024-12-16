<!-- Modal de Edição para Terceirizado -->
<div class="modal fade" id="editTerceirizadoModal" tabindex="-1" aria-labelledby="editTerceirizadoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTerceirizadoModalLabel">Editar Terceirizado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTerceirizadoForm" enctype="multipart/form-data" method="POST" action="#">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="terceirizadoId">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                        <label for="nome">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required>
                        <label for="cpf">CPF</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
                        <label for="telefone">Telefone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="numeroDeContrato" name="numeroDeContrato" placeholder="Número de Contrato" required>
                        <label for="numeroDeContrato">Número de Contrato</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                        <label for="data_nascimento">Data de Nascimento</label>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    </div>
                    <div id="imagePreviewContainer" class="mb-3">
                        <img id="imagePreview" class="img-thumbnail" alt="Pré-visualização da foto" style="max-height: 200px; display: none;">
                    </div>
                    <button type="button" class="btn btn-danger" id="deleteTerceirizadoButton">Excluir</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
