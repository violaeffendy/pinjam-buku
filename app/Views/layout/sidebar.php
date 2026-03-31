<aside class="w-72 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 flex flex-col shrink-0">
    <div class="p-6 flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center text-white">
            <span class="material-symbols-outlined">auto_stories</span>
        </div>
        <div>
            <h1 class="text-lg font-bold leading-tight">PerpusOnline</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wider">
                <?php
                $role_id = session()->get('role_id');
                if ($role_id == 1)
                    echo 'Admin Portal';
                elseif ($role_id == 2)
                    echo 'Staff Portal';
                else
                    echo 'Member Portal';
                ?>
            </p>
        </div>
    </div>
    <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= (url_is('dashboard*')) ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium' ?> transition-colors"
            href="<?= base_url('/dashboard') ?>">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="text-sm">Dashboard</span>
        </a>

        <?php if ($role_id == 1): ?>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= (url_is('users*')) ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium' ?> transition-colors"
                href="<?= base_url('/users') ?>">
                <span class="material-symbols-outlined">group</span>
                <span class="text-sm">User Management</span>
            </a>
        <?php endif; ?>

        <?php if ($role_id == 1 || $role_id == 2): ?>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= (url_is('kategori*')) ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium' ?> transition-colors"
                href="<?= base_url('/kategori') ?>">
                <span class="material-symbols-outlined">category</span>
                <span class="text-sm">Kategori Buku</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= (url_is('buku*')) ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium' ?> transition-colors"
                href="<?= base_url('/buku') ?>">
                <span class="material-symbols-outlined">book</span>
                <span class="text-sm">Kelola Buku</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= (url_is('transaksi*')) ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium' ?> transition-colors"
                href="<?= base_url('/transaksi') ?>">
                <span class="material-symbols-outlined">swap_horiz</span>
                <span class="text-sm">Transaksi</span>
            </a>
        <?php endif; ?>

        <?php if ($role_id == 3): ?>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= (url_is('katalog*')) ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium' ?> transition-colors"
                href="<?= base_url('/katalog') ?>">
                <span class="material-symbols-outlined">search</span>
                <span class="text-sm">Katalog Buku</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= (url_is('pinjaman-saya*')) ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium' ?> transition-colors"
                href="<?= base_url('/pinjaman-saya') ?>">
                <span class="material-symbols-outlined">history</span>
                <span class="text-sm">Riwayat Pinjaman</span>
            </a>
        <?php endif; ?>

        <div class="pt-4 mt-4 border-t border-slate-200 dark:border-slate-800">
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium transition-colors"
                href="<?= base_url('/logout') ?>">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-sm">Logout</span>
            </a>
        </div>
    </nav>
    <div class="p-4 border-t border-slate-200 dark:border-slate-800">
        <div class="flex items-center gap-3 p-2 rounded-xl bg-slate-50 dark:bg-slate-800/50">
            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white shrink-0">
                <span class="material-symbols-outlined">person</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold truncate">
                    <?= session()->get('nama') ?>
                </p>
                <p class="text-xs text-slate-500 truncate">
                    <?= session()->get('username') ?>
                </p>
            </div>
        </div>
    </div>
</aside>