## Saya lebih merekomendasikan pendekatan berikut

### Laravel + Blade + Livewire + Alpine.js + Tailwind CSS

Alasannya:

* **Satu stack** dari frontend hingga backend.
* Mudah dikustomisasi sesuai karakter pondok.
* Tidak perlu REST API untuk komunikasi internal.
* SEO tetap sangat baik karena server-side rendering.
* Performa ringan untuk hosting standar.
* Cocok untuk tim kecil atau satu pengembang.

Arsitekturnya bisa seperti ini:

<pre class="overflow-visible! px-0!" data-start="1214" data-end="1569"><div class="relative w-full mt-4 mb-1"><div class=""><div class="contents"><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border border-token-border-light border-radius-3xl corner-superellipse/1.1 rounded-3xl"><div class="h-full w-full border-radius-3xl bg-(--code-block-surface) corner-superellipse/1.1 overflow-clip rounded-3xl [--code-block-surface:var(--bg-elevated-secondary)] dark:[--code-block-surface:var(--composer-surface-primary)] lxnfua_clipPathFallback"><div class="pointer-events-none absolute end-1.5 top-1 z-2 md:end-2 md:top-1"></div><div class="relative"><div class="pe-11 pt-3"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼd ͼr"><div class="cm-scroller"><pre class="cm-content q9tKkq_readonly m-0"><code><span>Laravel
├── Frontend Website
│   ├── Home
│   ├── Profil
│   ├── Artikel
│   ├── Galeri
│   ├── Download
│   └── Kontak
│
├── Admin CMS
│   ├── Dashboard
│   ├── Content
│   ├── Article
│   ├── Gallery
│   ├── Download
│   ├── Contact
│   ├── Setting
│   └── User
│
└── Shared
    ├── Components
    ├── Layout
    ├── Helpers
    └── Services</span></code></pre></div></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></div></pre>

Admin dan website publik tetap berbagi model, service, dan business logic yang sama.
