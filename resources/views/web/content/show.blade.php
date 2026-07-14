@extends('layouts.web')

@section('seo_title', $content->seo_title ?: $content->title)
@section('seo_description', $content->seo_description ?: \Illuminate\Support\Str::limit(strip_tags($content->body ?? ''), 160))

@section('content')
    <article class="mx-auto max-w-3xl px-4 py-10 sm:py-12">
        <p class="text-sm text-stone-500">
            <a href="{{ route('home') }}" class="hover:text-emerald-800">Beranda</a>
            <span class="mx-1">/</span>
            Profil
        </p>
        <h1 class="mt-3 break-words-safe font-display text-2xl font-semibold tracking-wide text-pondok-900 sm:text-3xl md:text-5xl">{{ $content->title }}</h1>

        @if ($content->thumbnail)
            <img src="{{ asset('storage/'.$content->thumbnail) }}" alt="{{ $content->title }}" class="mt-6 w-full rounded-xl object-cover sm:mt-8">
        @endif

            <div class="prose prose-stone prose-sm mt-6 max-w-none sm:prose-base sm:mt-8 prose-headings:font-display prose-headings:text-pondok-900 prose-a:text-pondok-800 prose-img:rounded-lg">
                {!! $content->body !!}
            </div>
    </article>
@endsection
