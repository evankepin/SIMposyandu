@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">Kelola Vendor</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form class="mb-3" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau kontak..." value="{{ request('search') }}">
            <button class="btn btn-outline-primary">Cari</button>
        </div>
    </form>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">+ Tambah Vendor</button>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kontak</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendors as $v)
            <tr>
                <td>{{ $v->nama_vendor }}</td>
                <td>{{ $v->alamat }}</td>
                <td>{{ $v->kontak }}</td>
                <td>{{ ucfirst($v->jenis_vendor) }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $v->id_vendor }}">Edit</button>
                    <form action="{{ route('admin.vendor.destroy', $v->id_vendor) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $v->id_vendor }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('admin.vendor.update', $v->id_vendor) }}">
                        @csrf @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Vendor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label>Nama</label>
                                    <input type="text" name="nama_vendor" class="form-control" value="{{ $v->nama_vendor }}" required>
                                </div>
                                <div class="mb-2">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" required>{{ $v->alamat }}</textarea>
                                </div>
                                <div class="mb-2">
                                    <label>Kontak</label>
                                    <input type="text" name="kontak" class="form-control" value="{{ $v->kontak }}" required>
                                </div>
                                <div class="mb-2">
                                    <label>Jenis Vendor</label>
                                    <select name="jenis_vendor" class="form-select" required>
                                        <option value="vitamin" {{ (isset($v) && $v->jenis_vendor == 'vitamin') ? 'selected' : '' }}>Vitamin</option>
                                        <option value="imunisasi" {{ (isset($v) && $v->jenis_vendor == 'imunisasi') ? 'selected' : '' }}>Imunisasi</option>
                                        <option value="gabungan" {{ (isset($v) && $v->jenis_vendor == 'gabungan') ? 'selected' : '' }}>Gabungan</option>
                                        <option value="vaksin" {{ (isset($v) && $v->jenis_vendor == 'vaksin') ? 'selected' : '' }}>Vaksin</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>

    {{ $vendors->links() }}
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.vendor.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Vendor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nama</label>
                        <input type="text" name="nama_vendor" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label>Kontak</label>
                        <input type="text" name="kontak" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Jenis</label>
                        <select name="jenis_vendor" class="form-select" required>
                            <option value="vitamin">Vitamin</option>
                            <option value="imunisasi">Imunisasi</option>
                            <option value="gabungan">Gabungan</option>
                            <option value="vaksin">vaksin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
