@extends('layouts.web')

@section('seo_title', $article->seo_title ?: $article->title)
@section('seo_description', $article->seo_description ?: $article->excerpt(160))

@section('content')
    <article class="bg-white">
        <div class="mx-auto max-w-3xl px-4 py-10 sm:py-12 md:py-16">
            <p class="text-sm text-[var(--pondok-muted)]">
                <a href="{{ route('artikel.index') }}" class="hover:text-pondok-800">Kabar &amp; Artikel</a>
                <span class="mx-1">/</span>
                {{ $article->categoryLabel() }}
            </p>

            <div class="mt-4 flex flex-wrap items-center gap-3">
                <span class="rounded px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider {{ $article->categoryBadgeClass() }}">
                    {{ $article->categoryLabel() }}
                </span>
                @if ($article->published_at)
                    <span class="text-[11px] font-semibold uppercase tracking-wide text-stone-500">
                        {{ $article->published_at->translatedFormat('d F Y') }}
                    </span>
                @endif
            </div>

            <h1 class="mt-4 break-words-safe font-display text-2xl font-semibold tracking-wide text-pondok-900 sm:text-4xl md:text-5xl">
                {{ $article->title }}
            </h1>

            @if ($article->author)
                <p class="mt-4 text-sm text-[var(--pondok-muted)]">Oleh {{ $article->author->name }}</p>
            @endif

            @if ($article->thumbnailUrl())
                <img src="{{ $article->thumbnailUrl() }}" alt="{{ $article->title }}" class="mt-6 w-full rounded-xl object-cover sm:mt-8">
            @endif

            <div class="prose prose-stone prose-sm mt-6 max-w-none sm:prose-base sm:mt-8 prose-headings:font-display prose-headings:text-pondok-900 prose-a:text-pondok-800 prose-img:rounded-lg">
                {!! $article->body !!}
            </div>

            @if ($article->tags->isNotEmpty())
                <div class="mt-10 flex flex-wrap gap-2 border-t border-[var(--pondok-line)] pt-6">
                    @foreach ($article->tags as $tag)
                        <span class="rounded-full bg-stone-100 px-3 py-1 text-sm text-stone-600">#{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </article>
@endsection
