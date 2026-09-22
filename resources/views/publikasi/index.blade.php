@extends('layouts.app')
@section('title', 'Daftar Publikasi - BPS Sulawesi Selatan')

@section('content')
<main>
    <div class="page-header d-flex justify-content-between align-items-end gap-3 flex-wrap">
        <div>
            <span class="eyebrow">DATABASE WEBSITE</span>
            <h1>Daftar Publikasi</h1>
            <p>Publikasi BPS Provinsi Sulawesi Selatan yang tersimpan pada database website.</p>
        </div>
        <a href="{{ route('publikasi.create') }}" class="btn btn-primary">+ Tambah Publikasi</a>
    </div>

    <form method="GET" action="{{ route('publikasi.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" value="{{ $keyword }}" class="form-control" placeholder="Cari judul publikasi..." aria-label="Cari judul publikasi">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal Rilis</th>
                    <th>Sampul</th>
                    <th>Link</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($publikasi as $item)
                <tr>
                    <td>{{ $item->no ?? $item->id }}</td>
                    <td>
                        <strong style="color:#263b5d">{{ $item->judul }}</strong>
                    </td>
                    <td>{{ optional($item->tanggal_rilis)->format('d/m/Y') }}</td>
                    <td style="width:110px">
                        @if($item->sampul)
                            <img src="{{ asset('storage/'.$item->sampul) }}" alt="{{ $item->judul }}" style="width:70px;height:92px;object-fit:cover">
                        @else
                            <span style="color:#8a9aab">Tidak ada</span>
                        @endif
                    </td>
                    <td>
                        @if($item->link)
                            <a href="{{ $item->link }}" target="_blank" rel="noopener" class="section-link">Buka ↗</a>
                        @else
                            <span style="color:#9aa8b7">—</span>
                        @endif
                    </td>
                    <td class="text-nowrap">
                        <a href="{{ route('publikasi.edit',$item) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('publikasi.destroy',$item) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus publikasi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-5">Belum ada publikasi.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $publikasi->links() }}
</main>
@endsection
