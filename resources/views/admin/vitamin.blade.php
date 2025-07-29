@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">Data Vitamin</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search -->
    <form class="mb-3" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama vitamin..." value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">+ Tambah Vitamin</button>

    <!-- Table -->
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Kandungan</th>
                <th>Usia Saran</th>
                <th>Vendor</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vitamins as $v)
            <tr>
                <td>{{ $v->nama_vitamin }}</td>
                <td>{{ $v->jenis_vitamin }}</td>
                <td>{{ $v->kandungan }}</td>
                <td>{{ $v->usia_saran }} bln</td>
                <td>{{ $v->vendor->nama_vendor ?? '-' }}</td>
                <td><span class="badge {{ $v->status_aktif ? 'bg-success' : 'bg-secondary' }}">{{ $v->status_aktif ? 'Aktif' : 'Nonaktif' }}</span></td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $v->id_vitamin }}">Edit</button>
                    <form method="POST" action="{{ route('admin.vitamin.destroy', $v->id_vitamin) }}" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="modalEdit{{ $v->id_vitamin }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('admin.vitamin.update', $v->id_vitamin) }}">
                        @csrf @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Vitamin</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label>Nama Vitamin</label>
                                    <input type="text" name="nama_vitamin" value="{{ $v->nama_vitamin }}" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Jenis Vitamin</label>
                                    <input type="text" name="jenis_vitamin" value="{{ $v->jenis_vitamin }}" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Kandungan</label>
                                    <input type="text" name="kandungan" value="{{ $v->kandungan }}" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Usia Saran (bulan)</label>
                                    <input type="number" name="usia_saran" value="{{ $v->usia_saran }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control">{{ $v->deskripsi }}</textarea>
                                </div>
                                <div class="mb-2">
                                    <label>Status</label>
                                    <select name="status_aktif" class="form-select">
                                        <option value="1" {{ $v->status_aktif ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ !$v->status_aktif ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label>Vendor</label>
                                    <select name="id_vendor" class="form-select">
                                        <option value="">- Pilih -</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{ $vendor->id_vendor }}" {{ $v->id_vendor == $vendor->id_vendor ? 'selected' : '' }}>
                                                {{ $vendor->nama_vendor }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Simpan</button>
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>

    {{ $vitamins->links() }}
</div>

<!-- Modal Tambah Vitamin -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.vitamin.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Vitamin</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nama Vitamin</label>
                        <input type="text" name="nama_vitamin" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Jenis Vitamin</label>
                        <input type="text" name="jenis_vitamin" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Kandungan</label>
                        <input type="text" name="kandungan" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Usia Saran (bulan)</label>
                        <input type="number" name="usia_saran" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                    </div>
                    <div class="mb-2">
                        <label>Status</label>
                        <select name="status_aktif" class="form-select">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Vendor</label>
                        <select name="id_vendor" class="form-select">
                            <option value="">- Pilih -</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id_vendor }}">{{ $vendor->nama_vendor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
