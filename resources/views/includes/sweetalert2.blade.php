{{-- Mensagem depois das ações --}}
@if(Session::has('created'))
@section('scripts')
    <script>
        swal(
            'Sucesso!',
            '{{session("created")}}',
            'success'
        )
    </script>
@endsection
@endif
@if(Session::has('updated'))
@section('scripts')
    <script>
        swal(
            'Sucesso!',
            '{{session("updated")}}',
            'success'
        )
    </script>
@endsection
@endif
@if(Session::has('deleted'))
@section('scripts')
    <script>
        swal(
            'Sucesso!',
            '{{session("deleted")}}',
            'success'
        )
    </script>
@endsection
@endif
{{-- ------------------------- --}}