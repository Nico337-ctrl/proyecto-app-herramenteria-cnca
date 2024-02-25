@extends('layouts.template')
@section('title', 'IMPORTES')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/index-matc.css') }}">
@endsection

@section('content')

    @can('excel.import')
        <div class="container py-4">
            <h1>Importar Excels de Herramientas</h1>
            <br>
            <br>
            <form method="POST" action="{{ route('excel.import') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" name="documento">
                <input type="submit" value="Importar Excel">
            </form>
        </div>
    @endcan

    @can('excel.import')
        <div class="container py-4">
            <h1>Importar Excels de Materiales consumibles</h1>
            <br>
            <br>
            <form method="POST" action="{{ route('excel.import2') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" name="documento">
                <input type="submit" value="Importar Excel">
            </form>
        </div>
    @endcan

@endsection
