<div class="row">
    <?php foreach($products_data as $product){ ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <img src="<?=base_url('uploads/products/'.$product->icon_product);?>" class="card-img-top" alt="...">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php if (!@$category_selected) {
                            ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?=$product->category_id;?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?='Venta: '.$product->price_sell_product;?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?='Compra: '.$product->price_buy_product;?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?=$product->desc_product;?></div>
                            <?php
                        }
                        ?>
                        <div class="text-xs font-weight-bold text-primary mb-1">
                            <?=$product->name_product?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-sm btn-danger  custom-action"
                    data-key="key_<?=$product->id_producto;?>" data-opt="delete"><i class="fas fa-trash"></i></button>
                <button type="button" class="btn  btn-sm btn-success custom-action"
                    data-key="key_<?=$product->id_producto;?>" data-opt="update"><i class="fas fa-edit"></i></button>
            </div>
        </div>
    </div>
    <?php } ?>
</div>