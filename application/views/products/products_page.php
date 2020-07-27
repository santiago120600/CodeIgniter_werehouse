<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Productos <?=@$category_selected ? ': <strong>Categor&iacute;a '.$category_selected->name_category.'</strong>' : '';?></h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalView" id="openModal"
                                data-opt="new"><i class="fas fa-plus"></i>Nuevo Producto</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12" id='data_container'>
                            <?=$container_data;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>