@php
    $initialToasts = [];
    if (session('success')) {
        $initialToasts[] = ['type' => 'success', 'message' => session('success')];
    }
    if (session('error')) {
        $initialToasts[] = ['type' => 'error', 'message' => session('error')];
    }
@endphp

<div
    x-data="{
        toasts: [],
        nextId: 1,
        init() {
            (@js($initialToasts) || []).forEach((item) => this.push(item));
        },
        push(detail) {
            if (!detail || !detail.message) return;
            const id = this.nextId++;
            this.toasts.push({
                id,
                type: detail.type || 'success',
                message: detail.message,
                visible: true,
            });
            setTimeout(() => this.dismiss(id), detail.timeout || 4000);
        },
        dismiss(id) {
            const toast = this.toasts.find((item) => item.id === id);
            if (!toast) return;
            toast.visible = false;
            setTimeout(() => {
                this.toasts = this.toasts.filter((item) => item.id !== id);
            }, 220);
        },
    }"
    @toast.window="push($event.detail)"
    @notify.window="push($event.detail)"
    class="pointer-events-none fixed inset-x-0 top-0 z-[100] flex flex-col items-end gap-2 p-4 sm:p-6"
    aria-live="polite"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="toast.visible"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg border shadow-lg"
            :class="{
                'border-emerald-200 bg-emerald-50 text-emerald-900': toast.type === 'success',
                'border-rose-200 bg-rose-50 text-rose-900': toast.type === 'error',
                'border-amber-200 bg-amber-50 text-amber-900': toast.type === 'warning',
                'border-sky-200 bg-sky-50 text-sky-900': toast.type === 'info'
            }"
            role="status"
        >
            <div class="flex items-start gap-3 p-4">
                <div class="flex-1 text-sm font-medium" x-text="toast.message"></div>
                <button
                    type="button"
                    class="rounded p-1 opacity-60 hover:opacity-100"
                    @click="dismiss(toast.id)"
                    aria-label="Tutup"
                >
                    <span class="block text-lg leading-none">&times;</span>
                </button>
            </div>
        </div>
    </template>
</div>
