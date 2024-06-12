@extends('layout.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h2><strong>Data Barang</strong></h2>
                        <div class="col-md-6 text-right">
                            <form action="/barang" method="GET"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Merk</th>
                            <th>Seri</th>
                            <th>Spesifikasi</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                            <th style="width: 15%">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barang as $rowbarang)
                            <tr>
                                <td>{{ $loop->iteration + ($barang->currentPage() - 1) * $barang->perPage() }}</td>
                                <td>{{ $rowbarang->merk }}</td>
                                <td>{{ $rowbarang->seri }}</td>
                                <td>{{ $rowbarang->spesifikasi }}</td>
                                <td>{{ $rowbarang->stok }}</td>
                                <td>{{ $rowbarang->kategori->deskripsi }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm(
                                    'Apakah Anda yakin ingin menghapus barang ini?');" 
                                    action="{{ route('barang.destroy', $rowbarang->id) }}" method="POST">
                                        <a href="{{ route('barang.show', $rowbarang->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></i></a>
                                        <a href="{{ route('barang.edit', $rowbarang->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data barang belum tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {!! $barang->links() !!}
                <a href="{{ route('barang.create') }}" class="btn btn-md btn-success">Tambah Barang</a>
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