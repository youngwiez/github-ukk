@extends('layout.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h2><strong>Detail Data Kategori</strong></h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Deskripsi</td>
                                <td>{{ $rowkategori->deskripsi }}</td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>{{ $rowkategori->kat }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="{{ route('kategori.index') }}" class="btn btn-md btn-primary mb-3">KEMBALI</a>
            </div>
        </div>
    </div>
@endsection