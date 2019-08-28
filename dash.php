<?php require "styles.php"?>

<div class="container-fluid mt-5">
    <ul class="nav nav-tabs mb-0 pb-0" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#products" role="tab"
               aria-controls="profile"
               aria-selected="false">
                Gestão de produtos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#api_config" role="tab" aria-controls="home"
               aria-selected="true">
                Configurações de conexão
            </a>
        </li>
    </ul>

    <div class="tab-content bg-white" id="myTabContent">
        <div class="tab-pane p-3 fade show active" id="products" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                <div class="col text-right">
                    <button class="btn btn-success" data-toggle="modal" data-target="#create_product">Novo Produto +</button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($products as $item): ?>
                        <tr>
                            <td><?php echo $item->hotmart_id?></td>
                            <td><?php echo $item->name?></td>
                            <td><?php echo $item->category?></td>
                            <td>
                                <a href="<?php echo get_site_url(null, '/wp-json/jmart/product/change-status/'. $item->id, 'http')?>"
                                   class="btn btn-warning">
                                    <?php echo ($item->status == 0) ?  'Ativar visualização' : 'Desativar Visualização';?>
                                </a>
                                <a href="<?php echo get_site_url(null, '/wp-json/jmart/product/view/'. $item->id, 'http')?>"
                                   class="btn btn-info">
                                    Visualizar
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane p-3 fade" id="api_config" role="tabpanel" aria-labelledby="home-tab">
            <h6 class="text-muted">Chaves de conexão com API Hotmart</h6>
            <hr>
            <form action="" method="post">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="cliente_id">CLIENT_ID</label>
                            <input type="text" class="form-control" id="cliente_id" name="cliente_id"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="secret_id">SECRET_ID</label>
                            <input type="text" class="form-control" id="secret_id" name="secret_id"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="basic_id">BASIC_ID</label>
                            <input type="text" class="form-control" id="basic_id" name="basic_id"
                                   placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-right">
                        <button class="btn btn-primary">Salvar dados</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="create_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dados do novo produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo get_site_url(null, '/wp-json/jmart/product/store', 'http')?>" id="product_store">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="id" class="form-control" placeholder="ID Hotmart">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require "scripts.php"?>
