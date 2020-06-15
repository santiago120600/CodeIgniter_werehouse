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
            console.info($(this).serialize());

            $.ajax({
                'url' : '<?=base_url('categories/saveOrUpdate');?>',
                'data' : $(this).serialize(),
                'method' : "post",
                'success' : function(response){
                    $(document).find('#modalContent').empty().append(response);
                }
            })

        });
    });
</script>