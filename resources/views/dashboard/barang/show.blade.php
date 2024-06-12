@extends('layout.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               <div class="card border-0 shadow rounded mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h2><strong>Detail Data Barang</strong></h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Merk</td>
                                <td>{{ $rowbarang->merk }}</td>
                            </tr>
                            <tr>
                                <td>Seri</td>
                                <td>{{ $rowbarang->seri }}</td>
                            </tr>
                            <tr>
                                <td>Spesifikasi</td>
                                <td>{{ $rowbarang->spesifikasi }}</td>
                            </tr>
                            <tr>
                                <td>Stok</td>
                                <td>{{ $rowbarang->stok }}</td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>{{ $rowbarang->kategori->deskripsi }}</td>
                            </tr>
                        </table>
                    </div>
               </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="{{ route('barang.index') }}" class="btn btn-md btn-primary mb-3">KEMBALI</a>
            </div>
        </div>
    </div>
@endsection