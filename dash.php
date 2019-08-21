<?php //wp_register_style('main.css', plugins_url().'/jmart/assets/css/main.css')?>
<link rel="stylesheet" href="<?php echo plugins_url() . '/jmart/assets/css/main.css'; ?>">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
                    <button class="btn btn-success">Novo Produto +</button>
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
                            <td><?php echo $item->name?></td>
                            <td></td>
                            <td></td>
                            <td></td>
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>