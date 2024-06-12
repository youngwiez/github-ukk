@extends('layout.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               <div class="card border-0 shadow rounded mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h2><strong>Detail Data Pengeluaran</strong></h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Tanggal Keluar</td>
                                <td>{{ $rowkeluar->tgl_keluar }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Pemasukan</td>
                                <td>{{ $rowkeluar->qty_keluar }}</td>
                            </tr>
                            <tr>
                                <td>Merk Barang</td>
                                <td>{{ $rowkeluar->barang->merk }}</td>
                            </tr>
                            <tr>
                                <td>Seri Barang</td>
                                <td>{{ $rowkeluar->seri }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="{{ route('pengeluaran.index') }}" class="btn btn-md btn-primary mb-3">KEMBALI</a>
            </div>
        </div>
    </div>
@endsection