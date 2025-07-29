@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">Data Imunisasi</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Pencarian -->
    <form class="mb-3" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama imunisasi..." value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">+ Tambah Imunisasi</button>

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Usia Min</th>
                    <th>Usia Max</th>
                    <th>Vitamin</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($imunisasis as $i)
                    <tr>
                        <td>{{ $i->nama_imunisasi }}</td>
                        <td>{{ $i->jenis_imunisasi }}</td>
                        <td>{{ $i->usia_minimal }} bln</td>
                        <td>{{ $i->usia_maksimal }} bln</td>
                        <td>{{ $i->vitamin->nama_vitamin ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $i->status_aktif ? 'bg-success' : 'bg-secondary' }}">
                                {{ $i->status_aktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $i->id_imunisasi }}">Edit</button>
                            <form method="POST" action="{{ route('admin.imunisasi.destroy', $i->id_imunisasi) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus data ini?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $i->id_imunisasi }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('admin.imunisasi.update', $i->id_imunisasi) }}">
                                @csrf @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Imunisasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Edit -->
                                        <div class="mb-2">
                                            <label>Nama Imunisasi</label>
                                            <input type="text" name="nama_imunisasi" class="form-control" value="{{ $i->nama_imunisasi }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Jenis Imunisasi</label>
                                            <input type="text" name="jenis_imunisasi" class="form-control" value="{{ $i->jenis_imunisasi }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Usia Minimal (bulan)</label>
                                            <input type="number" name="usia_minimal" class="form-control" value="{{ $i->usia_minimal }}">
                                        </div>
                                        <div class="mb-2">
                                            <label>Usia Maksimal (bulan)</label>
                                            <input type="number" name="usia_maksimal" class="form-control" value="{{ $i->usia_maksimal }}">
                                        </div>
                                        <div class="mb-2">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control">{{ $i->deskripsi }}</textarea>
                                        </div>
                                        <div class="mb-2">
                                            <label>Vitamin Terkait</label>
                                            <select name="id_vitamin" class="form-select">
                                                <option value="">- Pilih Vitamin -</option>
                                                @foreach($vitamins as $v)
                                                    <option value="{{ $v->id_vitamin }}" {{ $i->id_vitamin == $v->id_vitamin ? 'selected' : '' }}>{{ $v->nama_vitamin }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label>Status</label>
                                            <select name="status_aktif" class="form-select">
                                                <option value="1" {{ $i->status_aktif == 1 ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ $i->status_aktif == 0 ? 'selected' : '' }}>Nonaktif</option>
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
    </div>

    {{ $imunisasis->links() }}
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.imunisasi.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Imunisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah -->
                    <div class="mb-2">
                        <label>Nama Imunisasi</label>
                        <input type="text" name="nama_imunisasi" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Jenis Imunisasi</label>
                        <input type="text" name="jenis_imunisasi" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Usia Minimal (bulan)</label>
                        <input type="number" name="usia_minimal" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Usia Maksimal (bulan)</label>
                        <input type="number" name="usia_maksimal" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                    </div>
                    <div class="mb-2">
                        <label>Vitamin Terkait</label>
                        <select name="id_vitamin" class="form-select">
                            <option value="">- Pilih Vitamin -</option>
                            @foreach($vitamins as $v)
                                <option value="{{ $v->id_vitamin }}">{{ $v->nama_vitamin }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Status</label>
                        <select name="status_aktif" class="form-select">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
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
