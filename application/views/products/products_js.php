<script type="text/javascript">
    $(function(){
        $(document).on('click','#openModal',function(){

            var _data = {
                "category_id" : <?=$category_selected ? $category_selected : "\"\"";?>
            };

            $.ajax({
                'url' : '<?=base_url('products/showProductForm');?>',
                'data' : _data,
                'success' : function(response){
                    $(document).find('#modalContent').empty().append(response);
                }
            });
        });

        $(document).on('submit','#form_products',function(e){
            e.preventDefault();
            $.ajax({
                'url' : '<?=base_url('products/saveOrUpdate');?>',
                'data' : new FormData(this),
                'contentType':false,
                'processData':false,
                'method' : "post",
                'success' : function(response){
                    var convert_response = JSON.parse(response);
                    if (convert_response.status =="success") {
                        alert("guardado");
                        $(document).find('#modalView').modal('hide');
                        load_data();
                    }
                    else if(convert_response.status=="error"){
                        //indefinido
                    }
                    else{
                    $(document).find('#modalContent').empty().append(convert_response.data);
                    }
                }
            });

        });


          });

</script>