<?php $this->extend('layout/app'); ?>


<?php $this->section('main'); ?>
<div class="container">
    <form action="<?php echo base_url('site') . (!empty($site->id) ? "/{$site->id}" : ""); ?>" method="post" class="g-3">
        <div class="mb-3 row">
            <label for="url" class="col-sm-2 col-form-label"><?php echo empty($site->id) ? 'Adicione uma url' : 'Editar url'; ?></label>
            <div class="col-auto">
                <input type="url" 
                       required="" 
                       class="form-control" 
                       id="url" 
                       name="url" 
                       placeholder="https://site.com.br" 
                       value="<?php echo $site->url; ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Salvar</button>
                <a href="<?php echo base_url(); ?>" class="btn btn-secondary mb-3">Voltar</a>
                <?php if (!empty($site->id)): ?>
                    <a href="<?php echo base_url('site') . "/{$site->id}/delete"; ?>" class="btn btn-danger mb-3">Excluir</a>
                <?php endif; ?>
            </div>
        </div>
    </form>
    <?php if (!empty($site->id)): ?>
        <div class="card">
            <div class="card-header">
                STATUS CODE <span class="badge bg-info text-dark"><?php echo $site->status_code; ?></span>
            </div>
            <div class="card-body">
                <code class="text-start">
                    <?php echo htmlentities($site->response); ?>
                </code>
            </div>
        </div>
    <?php endif; ?>
    <?php echo view('components/alerts'); ?>
</div>
<?php $this->endsection(); ?>