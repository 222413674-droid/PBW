@extends('layouts.app')
@section('title', 'Edit Publikasi')

@section('content')
<main>
    <div class="page-header">
        <span class="eyebrow">DATABASE WEBSITE</span>
        <h1>Edit Publikasi</h1>
        <p>Perbarui informasi publikasi yang sudah tersimpan.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('publikasi.update',$publikasi) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nomor Publikasi</label>
                    <input type="text" class="form-control" value="{{ $publikasi->no ?? $publikasi->id }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul Publikasi</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul',$publikasi->judul) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Rilis</label>
                    <input type="date" name="tanggal_rilis" class="form-control" value="{{ old('tanggal_rilis', optional($publikasi->tanggal_rilis)->format('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Link Publikasi</label>
                    <input type="url" name="link" class="form-control" value="{{ old('link',$publikasi->link) }}" placeholder="https://...">
                </div>

                <div class="mb-4">
                    <label class="form-label">Sampul Baru</label>
                    <input type="file" name="sampul" class="form-control" accept="image/jpeg,image/png,image/webp">
                    <div class="form-text">JPG/JPEG/PNG/WebP, maksimal 4 MB.</div>
                    @if($publikasi->sampul)
                        <div style="margin-top:12px">
                            <img src="{{ asset('storage/'.$publikasi->sampul) }}" alt="Sampul saat ini" style="width:105px;height:140px;object-fit:cover;border-radius:10px;box-shadow:0 7px 18px rgba(30,60,90,.12)">
                        </div>
                    @endif
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('publikasi.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
