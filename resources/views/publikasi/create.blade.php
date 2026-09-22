@extends('layouts.app')
@section('title', 'Tambah Publikasi')

@section('content')
<main>
    <div class="page-header">
        <span class="eyebrow">DATABASE WEBSITE</span>
        <h1>Tambah Publikasi</h1>
        <p>Tambahkan publikasi baru ke database website BPS Sulawesi Selatan.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('publikasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul Publikasi</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Rilis</label>
                    <input type="date" name="tanggal_rilis" class="form-control" value="{{ old('tanggal_rilis') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Link Publikasi</label>
                    <input type="url" name="link" class="form-control" value="{{ old('link') }}" placeholder="https://...">
                </div>

                <div class="mb-4">
                    <label class="form-label">Sampul Publikasi</label>
                    <input type="file" name="sampul" class="form-control" accept="image/jpeg,image/png,image/webp">
                    <div class="form-text">JPG/JPEG/PNG/WebP, maksimal 4 MB.</div>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-primary">Simpan Publikasi</button>
                    <a href="{{ route('publikasi.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
