<div class="modal-header">
    <h5 class="modal-title">
        <?php if ($action =='new') {
        echo 'Registro';
    }else if ($action=='update') {
        echo 'Moificaci&oacute;n';
    }else{
        echo 'Borrado';
    }
        ?>
        de Productos</h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="form_products">
    <input type="hidden" name="form_action" value="<?=$action;?>">
    <?php if ($action!='new') {
        ?>
    <input type="hidden" name="id_producto" value="<?=@$current_data['id_producto'];?>">
    <?php
    }
    ?>
    <div class="modal-body">
    <?php if(@$category_exists){ ?>
        <input type="hidden" name="category" value="<?=$category_exists->id_category;?>">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="category_name">Categor&iacute;a</label>
                    <input type="text" class="form-control" value="<?=$category_exists->name_category;?>" readonly>
                </div>
            </div>
        </div>
     <?php }else{ ?>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="category_name">Categor&iacute;a</label>
                    <select name="category" id="category" class="form-control" id="">
                        <option value="" disabled>Selecciona una opci&oacute;n</option>
                        <?php foreach($category_list as $iCategory){
                            ?>
                            <option value="<?=$iCategory->id_category;?>"><?=$iCategory->name_category;?></option>
                            <?php
                        } 
                        ?>
                    </select>
                    <?php if (@$errors['category']) {
                        ?>
                    <small class="form-text text-danger float-right"><?=$errors['category'];?></small>
                    <?php
                    } ?>

                </div>
            </div>
        </div>
     <?php } ?>

    <div class="row">
        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        
                        <div class="row">
                                <div class="col-12">
                                <label for="prod_picture">Foto:</label>
                                <?php if (empty(@$current_data['id_producto'])) {
                                    ?>
                                    <input type="file" name='prod_picture' class="dropify" data-default-file="<?=base_url('resources/img/placeholder.jpg');?>" data-allowed-file-extensions="png jpg" data-max-file-size='2M'/>
                                    <?php
                                    if (@$errors['prod_picture']) {
                                        ?>
                                            <small class="form-text text-danger float-right">
                                                <?=$errors['prod_picture'];?>
                                            </small>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <img src="<?=base_url('uploads/'.$current_data['icon_category']);?>" class="card-img-top" alt="...">
                                        <?php } ?>
                                </div>
                            </div>
                    </div>
            </div>
        </div>
        <div  class="col-xl-8 col-md-6 col-sm-12">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="name_product">Nombre: </label>
                        <input <?=$action=='delete' ? 'disabled': '';?> type="text" class="form-control" name="name_product" id="name_product" value="<?=@$current_data['name_product'];?>">
                        <?php if (@$errors['name_product']) {
                        ?>
                    <small class="form-text text-danger float-right"><?=$errors['name_product'];?></small>
                    <?php
                    } ?>
                    </div>             
                </div>
                <div class="col-xl-6 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="sell_product">Precio Venta: </label>
                        <input <?=$action=='delete' ? 'disabled': '';?> type="number" step="any" class="form-control" name="sell_product" id="sell_product" value="<?=@$current_data['price_sell_product'];?>">
                        <?php if (@$errors['sell_product']) {
                        ?>
                    <small class="form-text text-danger float-right"><?=$errors['sell_product'];?></small>
                    <?php
                    } ?>
                    </div>             
                </div>
                <div class="col-xl-6 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="buy_product">Precio Compra: </label>
                        <input <?=$action=='delete' ? 'disabled': '';?> type="number" step="any" class="form-control" name="buy_product" id="buy_product" value="<?=@$current_data['price_buy_product'];?>">
                        <?php if (@$errors['buy_product']) {
                        ?>
                    <small class="form-text text-danger float-right"><?=$errors['buy_product'];?></small>
                    <?php
                    } ?>
                    </div>             
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="desc_product">Descripci&oacute;n</label>
                        <textarea <?=$action=='delete' ? 'disabled': '';?> name="desc_product" id="desc_product" class="form-control"><?=@$current_data['desc_product'];?></textarea>
                        <?php if (@$errors['desc_product']) {
                        ?>
                    <small class="form-text text-danger float-right"><?=$errors['desc_product'];?></small>
                    <?php
                    } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>

<script type="text/javascript">
    $(function(){
        $('.dropify').dropify();
    });
</script>