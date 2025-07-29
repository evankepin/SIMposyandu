@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">Kelola User</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search Form -->
    <form class="mb-3" method="GET">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama, email, no. WA...">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Button Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">+ Tambah User</button>

    <!-- Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>No. WA</th>
                <th>Alamat</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="badge bg-secondary">{{ $user->role }}</span></td>
                <td>{{ $user->nomor_wa ?? '-' }}</td>
                <td>{{ $user->alamat ?? '-' }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">Edit</button>
                    <form method="POST" action="{{ route('admin.kelola_user.destroy', $user->id) }}" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('admin.kelola_user.update', $user->id) }}">
                        @csrf @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                </div>
                                <div class="mb-2">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                </div>
                                <div class="mb-2">
                                    <label>Role</label>
                                    <select name="role" class="form-select" required>
                                        <option value="kader" {{ $user->role == 'kader' ? 'selected' : '' }}>Kader</option>
                                        <option value="orangtua" {{ $user->role == 'orangtua' ? 'selected' : '' }}>Orang Tua</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label>No. WA</label>
                                    <input type="text" name="nomor_wa" class="form-control" value="{{ $user->nomor_wa }}">
                                </div>
                                <div class="mb-2">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control">{{ $user->alamat }}</textarea>
                                </div>
                                <div class="mb-2">
                                    <label>Password (isi jika ingin ganti)</label>
                                    <input type="password" name="password" class="form-control">
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

    {{ $users->links() }}
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.kelola_user.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Role</label>
                        <select name="role" class="form-select" required>
                            <option value="kader">Kader</option>
                            <option value="orangtua">Orang Tua</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>No. WA</label>
                        <input type="text" name="nomor_wa" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control"></textarea>
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
