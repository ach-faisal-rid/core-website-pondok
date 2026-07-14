@extends('layouts.web')

@section('seo_title', $album->title.' — Galeri Dokumentasi')
@section('seo_description', \Illuminate\Support\Str::limit(strip_tags($album->description ?? $album->title), 160))

@section('content')
    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-4 py-8 sm:py-10 md:py-14">
            <p class="text-sm text-[var(--pondok-muted)]">
                <a href="{{ route('galeri.index') }}" class="hover:text-pondok-800">Galeri Dokumentasi</a>
                <span class="mx-1">/</span>
                <span class="break-words-safe">{{ $album->title }}</span>
            </p>

            <h1 class="mt-3 break-words-safe font-display text-2xl font-semibold tracking-wide text-pondok-900 sm:text-4xl md:text-5xl">
                {{ $album->title }}
            </h1>

            @if ($album->category)
                <p class="mt-3 text-sm font-semibold text-pondok-800">{{ $album->category }}</p>
            @endif

            @if ($album->description)
                <p class="mt-4 max-w-3xl text-sm leading-relaxed text-[var(--pondok-muted)] sm:text-base">{{ $album->description }}</p>
            @endif

            <div class="mt-8 grid gap-3 sm:mt-10 sm:grid-cols-2 sm:gap-4 lg:grid-cols-3">
                @forelse ($album->media as $media)
                    <figure class="overflow-hidden rounded-xl bg-stone-100">
                        @if ($media->type === \App\Enums\MediaType::Video)
                            <video controls class="aspect-video w-full bg-stone-900 object-contain" src="{{ $media->url() }}"></video>
                        @else
                            <img src="{{ $media->url() }}" alt="{{ $media->caption ?: $album->title }}" class="aspect-[4/3] w-full object-cover">
                        @endif
                        @if ($media->caption)
                            <figcaption class="px-3 py-2 text-sm text-stone-600">{{ $media->caption }}</figcaption>
                        @endif
                    </figure>
                @empty
                    <p class="text-[var(--pondok-muted)] sm:col-span-2 lg:col-span-3">Album ini belum memiliki media.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
