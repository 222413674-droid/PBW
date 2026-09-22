@extends('layouts.app')
@section('title', 'Galeri - BPS Provinsi Sulawesi Selatan')
@section('content')
<div class="container mt-5 mb-5"><span class="eyebrow">DOKUMENTASI</span><h1 class="mb-4">Galeri BPS Provinsi Sulawesi Selatan</h1>
<div class="row g-4">
@foreach(['gambar5.jpg','gambar6.jpg','gambar7.jpg','gambar8.jpg','gambar9.jpg','gambar10.jpg'] as $image)
<div class="col-12 col-sm-6 col-lg-4"><div class="card h-100 shadow-sm"><img src="{{ asset('assets/img/'.$image) }}" class="card-img-top" alt="Galeri BPS" style="height:260px;object-fit:cover"><div class="card-body"><h5 class="card-title">Dokumentasi BPS</h5><p class="card-text text-muted">Galeri dari website BPS Sulawesi Selatan.</p></div></div></div>
@endforeach
</div></div>
@endsection
