<header
    class="h-16 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-8 shrink-0">
    <div class="flex items-center gap-4 text-sm text-slate-500 dark:text-slate-400">
        <a href="<?= base_url('/dashboard') ?>" class="hover:text-primary cursor-pointer">Home</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-slate-900 dark:text-slate-100 font-medium">
            <?= $title ?? 'Dashboard' ?>
        </span>
    </div>
    <div class="flex items-center gap-6">
        <div class="relative w-64 group">
            <span
                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
            <input
                class="w-full pl-10 pr-4 py-2 bg-slate-100 dark:bg-slate-800 border-none rounded-lg text-sm focus:ring-2 focus:ring-primary transition-all"
                placeholder="Search..." type="text" />
        </div>
        <div class="flex items-center gap-2">
            <button
                class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <button
                class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400">
                <span class="material-symbols-outlined">help_outline</span>
            </button>
        </div>
    </div>
</header>