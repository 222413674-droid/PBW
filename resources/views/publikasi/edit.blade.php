@extends('layouts.app')
@section('title', 'Edit Publikasi')
@section('content')
<div class="container mt-5 mb-5"><h1 class="mb-4">Edit Publikasi</h1><div class="card"><div class="card-body">
<form action="{{ route('publikasi.update',$publikasi) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
<div class="mb-3"><label class="form-label">Nomor Publikasi</label><input type="text" class="form-control" value="{{ $publikasi->no ?? $publikasi->id }}" disabled></div>
<div class="mb-3"><label class="form-label">Judul Publikasi</label><input type="text" name="judul" class="form-control" value="{{ old('judul',$publikasi->judul) }}" required></div>
<div class="mb-3"><label class="form-label">Tanggal Rilis</label><input type="date" name="tanggal_rilis" class="form-control" value="{{ optional($publikasi->tanggal_rilis)->format('Y-m-d') }}" required></div>
<div class="mb-3"><label class="form-label">Link Publikasi</label><input type="url" name="link" class="form-control" value="{{ old('link',$publikasi->link) }}"></div>
<div class="mb-3"><label class="form-label">Sampul Baru</label><input type="file" name="sampul" class="form-control" accept="image/jpeg,image/png,image/webp">@if($publikasi->sampul)<div class="mt-2"><img src="{{ asset('storage/'.$publikasi->sampul) }}" alt="Sampul" style="width:100px;height:130px;object-fit:cover"></div>@endif</div>
<button type="submit" class="btn btn-success">Simpan Perubahan</button> <a href="{{ route('publikasi.index') }}" class="btn btn-secondary">Kembali</a>
</form></div></div></div>
@endsection
