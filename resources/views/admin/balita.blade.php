@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">Kelola Data Balita</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search Form -->
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIK..." value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Button Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">+ Tambah Balita</button>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Tanggal Lahir</th>
                    <th>JK</th>
                    <th>Orang Tua</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($balitas as $b)
                    <tr>
                        <td>{{ $b->nama_balita }}</td>
                        <td>{{ $b->nik_balita }}</td>
                        <td>{{ \Carbon\Carbon::parse($b->tanggal_lahir)->format('d-m-Y') }}</td>
                        <td>{{ $b->jenis_kelamin }}</td>
                        <td>{{ $b->orangtua->name ?? '-' }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $b->id_balita }}">Edit</button>
                            <form method="POST" action="{{ route('admin.balita.destroy', $b->id_balita) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $b->id_balita }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('admin.balita.update', $b->id_balita) }}">
                                @csrf @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Data Balita</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <label>Nama Balita</label>
                                            <input type="text" name="nama_balita" class="form-control" value="{{ $b->nama_balita }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>NIK</label>
                                            <input type="text" name="nik_balita" class="form-control" value="{{ $b->nik_balita }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $b->tanggal_lahir }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-select" required>
                                                <option value="Laki-laki" {{ $b->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ $b->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label>Golongan Darah</label>
                                            <input type="text" name="golongan_darah" class="form-control" value="{{ $b->golongan_darah }}">
                                        </div>
                                        <div class="mb-2">
                                            <label>Berat Lahir (kg)</label>
                                            <input type="number" step="0.1" name="berat_lahir" class="form-control" value="{{ $b->berat_lahir }}">
                                        </div>
                                        <div class="mb-2">
                                            <label>Panjang Lahir (cm)</label>
                                            <input type="number" step="0.1" name="panjang_lahir" class="form-control" value="{{ $b->panjang_lahir }}">
                                        </div>
                                        <div class="mb-2">
                                            <label>Orang Tua</label>
                                            <select name="id" class="form-select">
                                                <option value="">-- Pilih --</option>
                                                @foreach($orangtuas as $u)
                                                    <option value="{{ $u->id }}" {{ $b->id == $u->id ? 'selected' : '' }}>
                                                        {{ $u->name }} ({{ $u->email }})
                                                    </option>
                                                @endforeach
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
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Data kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $balitas->links() }}
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.balita.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Balita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nama Balita</label>
                        <input type="text" name="nama_balita" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>NIK</label>
                        <input type="text" name="nik_balita" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Golongan Darah</label>
                        <input type="text" name="golongan_darah" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Berat Lahir (kg)</label>
                        <input type="number" step="0.1" name="berat_lahir" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Panjang Lahir (cm)</label>
                        <input type="number" step="0.1" name="panjang_lahir" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Orang Tua</label>
                        <select name="id" class="form-select">
                            <option value="">-- Pilih --</option>
                            @foreach($orangtuas as $u)
                                <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                            @endforeach
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
