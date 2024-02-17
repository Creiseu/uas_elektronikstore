@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('kasir.index') }}" class="btn btn-md btn-success mb-3">Data Barang</a>
                    <a href="{{ route('kategori.index') }}" class="btn btn-md btn-success mb-3">Kategori</a>
                    <a href="{{ route('kategori.index') }}" class="btn btn-md btn-success mb-3">Kategori</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection