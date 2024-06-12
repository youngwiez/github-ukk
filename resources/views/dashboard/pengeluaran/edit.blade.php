@extends('layout.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h2><strong>Edit Data Pengeluaran Barang</strong></h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pengeluaran.update', $idkeluar->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
    
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Keluar</label>
                                <input type="text" disabled class="form-control @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" value="{{ old('tgl_keluar',$idkeluar->tgl_keluar) }}" placeholder="keluarkan Tanggal Pengeluaran Barang">
                                @error('tgl_keluar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label class="font-weight-bold">Jumlah Pengeluaran Barang</label>
                                <input type="text" class="form-control @error('qty_keluar') is-invalid @enderror" name="qty_keluar" value="{{ old('qty_keluar',$idkeluar->qty_keluar) }}" placeholder="Jumlah Pengeluaran Barang">
                                @error('qty_keluar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Barang</label>
                                <select class="form-control @error('barang_id') is-invalid @enderror" name="barang_id">
                                    <option value="">Pilih Barang</option>
                                    @foreach($barang_id as $rowbarang)
                                        <option value="{{ $rowbarang->id }}" {{ old('barang_id', $idkeluar->barang_id) == $rowbarang->id ? 'selected' : '' }}>{{ $rowbarang->merk . ' ' . $rowbarang->seri }}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk barang_id -->
                                @error('barang_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
    
                            <button type="submit" class="btn btn-md btn-success">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{ route('pengeluaran.index') }}" class="btn btn-md btn-primary">KEMBALI</a>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@endsection