@extends('layout.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h2><strong>Data Pemasukan</strong></h2>
                        <div class="col-md-6 text-right">
                            <form action="/pemasukan" method="GET"
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
                            <td>No</td>
                            <td>Tanggal Masuk</td>
                            <td>Jumlah</td>
                            <td>Barang</td>
                            <td>Seri</td>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        @forelse ($pemasukan as $rowmasuk)
                            <tr>
                                <td>{{ $loop->iteration + ($pemasukan->currentPage() - 1) * $pemasukan->perPage() }}</td>
                                <td>{{ $rowmasuk->tgl_masuk }}</td>
                                <td>{{ $rowmasuk->qty_masuk }}</td>
                                <td>{{ $rowmasuk->barang->merk }}</td>
                                <td>{{ $rowmasuk->seri }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('pemasukan.destroy', $rowmasuk->id) }}" method="POST">
                                        <a href="{{ route('pemasukan.show', $rowmasuk->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></i></a>
                                        <a href="{{ route('pemasukan.edit', $rowmasuk->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Pemasukan Barang Belum Tersedia
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {!! $pemasukan->links() !!}
                <a href="{{ route('pemasukan.create') }}" class="btn btn-md btn-success mb-3">Tambah Pemasukan</a>
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