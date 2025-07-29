@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">Jadwal Posyandu</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search -->
    <form class="mb-3" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari lokasi atau jenis kegiatan..." value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Button Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">+ Tambah Jadwal</button>

    <!-- Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Lokasi</th>
                <th>Jenis Kegiatan</th>
                <th>Deskripsi</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwals as $jadwal)
            <tr>
                <td>{{ $jadwal->tanggal_kegiatan }}</td>
                <td>{{ $jadwal->waktu_kegiatan }}</td>
                <td>{{ $jadwal->lokasi }}</td>
                <td>{{ $jadwal->jenis_kegiatan }}</td>
                <td>{{ $jadwal->deskripsi }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $jadwal->id_jadwal }}">Edit</button>

                    <form action="{{ route('admin.jadwal.destroy', $jadwal->id_jadwal) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $jadwal->id_jadwal }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.jadwal.update', $jadwal->id_jadwal) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Jadwal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label>Tanggal Kegiatan</label>
                                    <input type="date" name="tanggal_kegiatan" class="form-control" value="{{ $jadwal->tanggal_kegiatan }}" required>
                                </div>
                                <div class="mb-2">
                                    <label>Waktu Kegiatan</label>
                                    <input type="time" name="waktu_kegiatan" class="form-control" value="{{ $jadwal->waktu_kegiatan }}" required>
                                </div>
                                <div class="mb-2">
                                    <label>Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control" value="{{ $jadwal->lokasi }}" required>
                                </div>
                                <div class="mb-2">
                                    <label>Jenis Kegiatan</label>
                                    <input type="text" name="jenis_kegiatan" class="form-control" value="{{ $jadwal->jenis_kegiatan }}" required>
                                </div>
                                <div class="mb-2">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control">{{ $jadwal->deskripsi }}</textarea>
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
                <td colspan="6" class="text-center">Belum ada jadwal posyandu.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $jadwals->links() }}
</div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.jadwal.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal Posyandu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Waktu Kegiatan</label>
                        <input type="time" name="waktu_kegiatan" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Jenis Kegiatan</label>
                        <input type="text" name="jenis_kegiatan" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
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
