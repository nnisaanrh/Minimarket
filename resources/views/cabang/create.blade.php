<div class="container">
    <h1>Tambah Cabang</h1>
    <form action="{{ route('cabang.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Nama Cabang</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat') }}" required>
            @error('alamat')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="kota">Kota</label>
            <input type="text" name="kota" id="kota" class="form-control" value="{{ old('kota') }}" required>
            @error('kota')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('cabang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

