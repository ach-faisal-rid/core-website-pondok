@extends('layouts.web')

@section('seo_title', 'Halaman Tidak Ditemukan')
@section('seo_description', 'Halaman yang Anda cari tidak ditemukan.')

@section('content')
    <div class="mx-auto max-w-3xl px-4 py-24 text-center">
        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-800">404</p>
        <h1 class="mt-3 text-3xl font-bold text-stone-900">Halaman tidak ditemukan</h1>
        <p class="mt-3 text-stone-600">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
        <a href="{{ route('home') }}" class="mt-8 inline-flex rounded-lg bg-emerald-800 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-900">
            Kembali ke Beranda
        </a>
    </div>
@endsection
