@extends('layout.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h2><strong>Edit Data Kategori</strong></h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kategori.update', $idkat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
    
                            <div class="form-group">
                                <label class="font-weight-bold">Deskripsi</label>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi',$idkat->deskripsi) }}" placeholder="Masukkan deskripsi kategori">
                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label class="font-weight-bold">Kategori</label>
                                <select class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                                    <option value="">Pilih Kategori</option>
                                    <option value="M">M - Modal</option>
                                    <option value="A">A - Alat</option>
                                    <option value="BHP">BHP - Bahan Habis Pakai</option>
                                    <option value="BTHP">BTHP - Bahan Tidak Habis Pakai</option>
                                </select>
                                <!-- <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="kategori" value="M" {{ $idkat->kategori == 'M' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kategori">
                                        M - Modal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="kategori" value="A" {{ $idkat->kategori == 'A' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kategori">
                                        A - Alat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="kategori" value="BHP" {{ $idkat->kategori == 'BHP' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kategori">
                                        BHP - Bahan Habis Pakai
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="kategori" value="BTHP" {{ $idkat->kategori == 'BTHP' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kategori">
                                        BTHP - Bahan Tidak Habis Pakai
                                    </label>
                                </div> -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                            <button type="submit" class="btn btn-md btn-success">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{ route('kategori.index') }}" class="btn btn-md btn-primary">KEMBALI</a>
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