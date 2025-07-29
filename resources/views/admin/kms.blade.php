@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">Data KMS</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama balita..." value="{{ request('search') }}">
            <button class="btn btn-outline-primary">Cari</button>
        </div>
    </form>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">+ Tambah</button>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama Balita</th>
                    <th>Tanggal</th>
                    <th>Usia (bln)</th>
                    <th>BB (kg)</th>
                    <th>TB (cm)</th>
                    <th>LK (cm)</th>
                    <th>Imunisasi</th>
                    <th>Aksi Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kms as $data)
                <tr>
                    <td>{{ $data->balita->nama_balita ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal_pemeriksaan)->format('d-m-Y') }}</td>
                    <td>{{ $data->usia_bulan }}</td>
                    <td>{{ $data->berat_badan }}</td>
                    <td>{{ $data->tinggi_badan }}</td>
                    <td>{{ $data->lingkar_kepala ?? '-' }}</td>
                    <td>{{ $data->imunisasi->nama_imunisasi ?? '-' }}</td>
                    <td>{{ $data->pembuat->name ?? '-' }} ({{ $data->pembuat->role ?? '-' }})</td>

                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $data->id_kms }}">Edit</button>
                        <form method="POST" action="{{ route('admin.kms.destroy', $data->id_kms) }}" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit{{ $data->id_kms }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('admin.kms.update', $data->id_kms) }}">
                            @csrf @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header"><h5 class="modal-title">Edit KMS</h5></div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label>Balita</label>
                                        <select name="id_balita" class="form-select" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach($balitas as $b)
                                                <option value="{{ $b->id_balita }}" {{ $data->id_balita == $b->id_balita ? 'selected' : '' }}>{{ $b->nama_balita }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label>Tanggal Pemeriksaan</label>
                                        <input type="date" name="tanggal_pemeriksaan" class="form-control" value="{{ $data->tanggal_pemeriksaan }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Usia (bulan)</label>
                                        <input type="number" name="usia_bulan" class="form-control" value="{{ $data->usia_bulan }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Berat Badan (kg)</label>
                                        <input type="number" step="0.1" name="berat_badan" class="form-control" value="{{ $data->berat_badan }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Tinggi Badan (cm)</label>
                                        <input type="number" step="0.1" name="tinggi_badan" class="form-control" value="{{ $data->tinggi_badan }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Lingkar Kepala (cm)</label>
                                        <input type="number" step="0.1" name="lingkar_kepala" class="form-control" value="{{ $data->lingkar_kepala }}">
                                    </div>
                                    <div class="mb-2">
                                        <label>Imunisasi</label>
                                        <select name="id_imunisasi" class="form-select" required>
                                            <option value="">-- Pilih Imunisasi --</option>
                                            @foreach($imunisasis as $i)
                                                <option value="{{ $i->id_imunisasi }}" {{ $data->id_imunisasi == $i->id_imunisasi ? 'selected' : '' }}>
                                                    {{ $i->nama_imunisasi }} ({{ $i->usia_minimal }}-{{ $i->usia_maksimal }} bln)
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
    </div>

    {{ $kms->links() }}
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.kms.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Tambah KMS</h5></div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Balita</label>
                        <select name="id_balita" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            @foreach($balitas as $b)
                                <option value="{{ $b->id_balita }}">{{ $b->nama_balita }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Tanggal Pemeriksaan</label>
                        <input type="date" name="tanggal_pemeriksaan" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Usia (bulan)</label>
                        <input type="number" name="usia_bulan" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Berat Badan (kg)</label>
                        <input type="number" step="0.1" name="berat_badan" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Tinggi Badan (cm)</label>
                        <input type="number" step="0.1" name="tinggi_badan" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Lingkar Kepala (cm)</label>
                        <input type="number" step="0.1" name="lingkar_kepala" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Imunisasi</label>
                        <select name="id_imunisasi" class="form-select" required>
                            <option value="">-- Pilih Imunisasi --</option>
                            @foreach($imunisasis as $i)
                                <option value="{{ $i->id_imunisasi }}">
                                    {{ $i->nama_imunisasi }} ({{ $i->usia_minimal }}-{{ $i->usia_maksimal }} bln)
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
@endsection
