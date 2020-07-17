<div class="row">
    <?php foreach($container_data as $category){ ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <img src="<?=base_url('uploads/'.$category->icon_category);?>" class="card-img-top" alt="...">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?=$category->desc_category?></div>
                        <div class="text-xs font-weight-bold text-primary mb-1">
                            <?=$category->name_category?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?=base_url('products/initial/'.$category->id_category);?>" class="btn  btn-sm btn-info  mr-1 custom-action"><i class="fas fa-shopping-basket"></i></a>
                <button type="button" class="btn btn-sm btn-danger mr-1  custom-action"
                    data-key="key_<?=$category->id_category;?>" data-opt="delete"><i class="fas fa-trash"></i></button>
                <button type="button" class="btn  btn-sm btn-success mr-1 custom-action"
                    data-key="key_<?=$category->id_category;?>" data-opt="update"><i class="fas fa-edit"></i></button>
            </div>
        </div>
    </div>
    <?php } ?>
</div>