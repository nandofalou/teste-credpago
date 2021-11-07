<?php $this->extend('layout/app'); ?>

<?php $this->section('header'); ?>
<?php $this->endsection(); ?>

<?php $this->section('main'); ?>
<div class="container">
    <div class="btn-group" role="group">
        <button type="button" id="siterefresh" class="btn btn-warning"><i id="ico-reload" class="bi bi-arrow-clockwise"></i> Atualizar</button>
        <a href="<?php echo base_url('site'); ?>" class="btn btn-primary">Adicionar URL</a>
    </div>
    <h6 class="my-3">Lista de url cadastrado</h6>
    <table id="myTable" class="table table-bordered table-striped table-hover">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>URL</th>
                <th>STATUS</th>
                <th>UPDATED</th>
                <th>USER</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <?php echo view('components/alerts'); ?>
</div>
<?php $this->section('script'); ?>
<script>
    cl.loadData()
    siterefresh.addEventListener('click', function (event) {
        event.preventDefault()
        cl.loadData()
    }, true)
</script>
<?php $this->endsection(); ?>

<?php $this->endsection(); ?>