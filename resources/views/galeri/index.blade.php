@extends('layouts.app')
@section('title', 'Galeri - BPS Provinsi Sulawesi Selatan')

@section('content')
<main class="gallery-page">
    <div class="gallery-header">
        <span class="eyebrow">DOKUMENTASI</span>
        <h1>Galeri BPS Provinsi Sulawesi Selatan</h1>
        <p>Dokumentasi kegiatan dan aktivitas BPS Provinsi Sulawesi Selatan.</p>
    </div>

    <div class="gallery-grid">
        @foreach(['gambar5.jpg','gambar6.jpg','gambar7.jpg','gambar8.jpg','gambar9.jpg','gambar10.jpg'] as $index => $image)
            <article class="gallery-card">
                <img src="{{ asset('assets/img/'.$image) }}" alt="Dokumentasi BPS {{ $index + 1 }}" loading="lazy">
                <div class="gallery-card-body">
                    <h3>Dokumentasi BPS</h3>
                    <p>BPS Provinsi Sulawesi Selatan</p>
                </div>
            </article>
        @endforeach
    </div>
</main>
@endsection
