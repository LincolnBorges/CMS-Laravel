@section('delete_warning')
    <script>
        $('.deletar').on('click',function(e){
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: "Tem certeza que deseja deletar?",
                text: "",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, pode deletar",
                cancelButtonText: "Não, quero cancelar",
                preConfirm: function() {
                    return new Promise(function(resolve, reject) {
                        form.submit();
                        setTimeout(function() {
                            resolve();
                        }, 2000);
                    });
                }
            })
        });
    </script>
@endsection