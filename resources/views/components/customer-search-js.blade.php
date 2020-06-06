<script>
    $(document).ready(function() {
        $('#customer-popup').modal('show');

        $('#customer-table-common').on('click', '.view-customers', function(e) {
            var key = $(this).data('id');
            $.get('{{ route("customerSearch.searchCustomer") }}', {id:key}, function(data){
                $('#data-popup').html(data.profile);
                $('#display-customer').modal('show');
            }, 'json');
            e.preventDefault();
        });

        $('#customer-search-form').on('keyup', '#cus-name', function() {
            var name = $(this).val();
            $.get('{{ route('customerSearch.namesList') }}', {name:name}, function(data){
                $('#names-list').removeClass('d-none');
                $('#names-list').html(data.list);
            }, 'json');
        });
    });
</script>
