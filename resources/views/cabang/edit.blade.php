
<div class="container">
    <h1>Edit Cabang</h1>
    <form action="{{ route('cabang.update', $cabang->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="name">Nama Cabang</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $cabang->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat', $cabang->alamat) }}" required>
            @error('alamat')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="kota">Kota</label>
            <input type="text" name="kota" id="kota" class="form-control" value="{{ old('kota', $cabang->kota) }}" required>
            @error('kota')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('cabang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
