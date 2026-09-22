@extends('layouts.app')
@section('title', 'Daftar Publikasi - BPS Sulawesi Selatan')
@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap mb-3">
        <div><span class="eyebrow">DATABASE WEBSITE</span><h1 class="mb-0">Daftar Publikasi BPS Provinsi Sulawesi Selatan</h1></div>
        <a href="{{ route('publikasi.create') }}" class="btn btn-primary">+ Tambah Publikasi</a>
    </div>
    <form method="GET" action="{{ route('publikasi.index') }}" class="mb-4">
        <div class="input-group"><input type="text" name="q" value="{{ $keyword }}" class="form-control" placeholder="Cari judul publikasi..."><button class="btn btn-outline-primary">Cari</button></div>
    </form>
    <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark"><tr><th>No</th><th>Judul</th><th>Tanggal Rilis</th><th>Sampul</th><th>Link</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($publikasi as $item)
        <tr>
            <td>{{ $item->no ?? $item->id }}</td><td>{{ $item->judul }}</td><td>{{ optional($item->tanggal_rilis)->format('d/m/Y') }}</td>
            <td style="width:110px">@if($item->sampul)<img src="{{ asset('storage/'.$item->sampul) }}" alt="{{ $item->judul }}" style="width:80px;height:105px;object-fit:cover">@else<span class="text-muted">Tidak ada</span>@endif</td>
            <td>@if($item->link)<a href="{{ $item->link }}" target="_blank" rel="noopener">Buka</a>@else - @endif</td>
            <td class="text-nowrap"><a href="{{ route('publikasi.edit',$item) }}" class="btn btn-warning btn-sm">Edit</a><form action="{{ route('publikasi.destroy',$item) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus publikasi ini?')">Hapus</button></form></td>
        </tr>
        @empty<tr><td colspan="6" class="text-center py-4">Belum ada publikasi.</td></tr>@endforelse
        </tbody>
    </table></div>
    {{ $publikasi->links() }}
</div>
@endsection
