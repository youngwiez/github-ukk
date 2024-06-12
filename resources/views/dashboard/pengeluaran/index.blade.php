@extends('layout.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h2><strong>Data Pengeluaran</strong></h2>
                        <a href="{{ route('pengeluaran.create') }}" class="btn btn-md btn-success">Tambah Pengeluaran</a>
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Tanggal Keluar</td>
                            <td>Jumlah</td>
                            <td>Barang</td>
                            <td>Seri</td>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        @forelse ($pengeluaran as $rowkeluar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rowkeluar->tgl_keluar }}</td>
                                <td>{{ $rowkeluar->qty_keluar }}</td>
                                <td>{{ $rowkeluar->barang->merk }}</td>
                                <td>{{ $rowkeluar->seri }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('pengeluaran.destroy', $rowkeluar->id) }}" method="POST">
                                        <a href="{{ route('pengeluaran.edit', $rowkeluar->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Pengeluaran Barang Belum Tersedia
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL!",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endsection