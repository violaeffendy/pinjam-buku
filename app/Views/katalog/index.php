<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-2">Katalog Buku</h2>
    <p class="text-slate-500">Cari dan temukan buku favoritmu</p>
</div>

<!-- Search Bar -->
<div class="mb-8 max-w-xl">
    <form action="<?= base_url('/katalog') ?>" method="GET" class="relative group">
        <span
            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary">search</span>
        <input type="text" name="keyword" value="<?= $keyword ?? '' ?>" placeholder="Cari judul atau penulis..."
            class="w-full pl-12 pr-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-2 focus:ring-primary outline-none shadow-sm transition-all">
    </form>
</div>

<!-- Book Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
    <?php if (empty($buku)): ?>
        <div class="col-span-full py-12 text-center text-slate-500">
            <span class="material-symbols-outlined text-6xl mb-4 opacity-20">search_off</span>
            <p>Buku tidak ditemukan</p>
        </div>
    <?php else: ?>
        <?php foreach ($buku as $b): ?>
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden group hover:shadow-lg transition-all">
                <div class="aspect-[3/4] overflow-hidden relative">
                    <img src="<?= base_url('uploads/covers/' . $b['cover']) ?>" alt="<?= $b['judul'] ?>"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 right-3">
                        <span
                            class="px-2 py-1 bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm text-[10px] font-bold rounded-lg shadow-sm">
                            <?= $b['nama_kategori'] ?>
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-sm line-clamp-2 min-h-[40px] mb-1 group-hover:text-primary transition-colors">
                        <?= $b['judul'] ?>
                    </h3>
                    <p class="text-xs text-slate-500 mb-3">
                        <?= $b['penulis'] ?>
                    </p>
                    <div class="flex items-center justify-between mt-auto mb-4">
                        <span class="text-xs <?= ($b['stok'] > 0) ? 'text-emerald-500' : 'text-rose-500' ?> font-bold">
                            <?= ($b['stok'] > 0) ? 'Tersedia' : 'Habis' ?>
                        </span>
                        <span class="text-[10px] text-slate-400">Stok:
                            <?= $b['stok'] ?>
                        </span>
                    </div>
                    <?php if ($b['stok'] > 0): ?>
                        <a href="<?= base_url('/transaksi/pinjam') ?>"
                            class="block w-full text-center py-2 bg-primary/10 text-primary text-xs font-bold rounded-lg hover:bg-primary hover:text-white transition-all">
                            Pinjam Buku
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>