<script type="text/javascript">
    $(function(){
        $(document).on('click','#openModal',function(){
            $.ajax({
                'url' : '<?=base_url('categories/showCategoriesForm');?>',
                'success' : function(response){
                    $(document).find('#modalContent').empty().append(response);
                }
            })
        });
        $(document).on('submit','#form_categories',function(e){
            e.preventDefault();
            $.ajax({
                'url' : '<?=base_url('categories/saveOrUpdate');?>',
                'data' : $(this).serialize(),
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

        $(document).on('click','.custom-action',function(){

            var _data = {
                "key":$(this).attr('data-key').substring(4),
                "action":$(this).attr('data-opt')
            };
            $.ajax({
                'url':'<?=base_url('categories/showCategoriesForm');?>',
                'method':'get',
                'data':_data,
                'success':function(response){
                    $('#modalView').modal('show');

                    setTimeout(function(){
                        $(document).find('#modalContent').empty().append(response);
                    },100);
                }
            });
        });

    });

    function load_data(){
        $.ajax({
                'url' : '<?=base_url('categories/showDataContainer');?>',
                'success' : function(response){
                    $(document).find('#data_container').empty().append(response);
                }
            })
    }
</script>