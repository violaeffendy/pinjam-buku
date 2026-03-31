<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-8 flex items-center gap-4">
    <a href="/transaksi" class="p-2 rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50">
        <span class="material-symbols-outlined">arrow_back</span>
    </a>
    <h2 class="text-2xl font-bold">Catat Peminjaman</h2>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-8">
        <form action="<?= base_url('/transaksi/store') ?>" method="POST">
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Pilih Anggota</label>
                <select name="user_id"
                    class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-2 focus:ring-primary outline-none transition-all"
                    required>
                    <option value="">-- Pilih Anggota --</option>
                    <?php foreach ($users as $u): ?>
                        <option value="<?= $u['id'] ?>">
                            <?= $u['nama_lengkap'] ?> (
                            <?= $u['username'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Pilih Buku</label>
                <select name="buku_id"
                    class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-2 focus:ring-primary outline-none transition-all"
                    required id="buku_select">
                    <option value="">-- Pilih Buku --</option>
                    <?php foreach ($buku as $b): ?>
                        <option value="<?= $b['id'] ?>">
                            <?= $b['judul'] ?> (Stok:
                            <?= $b['stok'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-6">
                <p class="text-sm text-slate-500 italic">* Batas waktu peminjaman adalah 7 hari dari sekarang.</p>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-primary text-white rounded-lg font-bold hover:bg-blue-700 transition-colors">Simpan
                    Transaksi</button>
            </div>
        </form>
    </div>

    <!-- QR Scanner Simulation for UI -->
    <div class="bg-slate-900 rounded-2xl p-8 flex flex-col items-center justify-center text-white text-center">
        <div
            class="w-48 h-48 border-2 border-primary border-dashed rounded-2xl flex items-center justify-center mb-6 relative">
            <span class="material-symbols-outlined text-6xl text-primary/50">qr_code_scanner</span>
            <div class="absolute inset-0 border-2 border-primary rounded-2xl animate-pulse"></div>
        </div>
        <h4 class="text-xl font-bold mb-2">QR Scan Simulator</h4>
        <p class="text-slate-400 text-sm">Scan QR code pada buku untuk memilih otomatis</p>
        <button class="mt-6 px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg text-sm transition-colors">Aktifkan
            Kamera</button>
    </div>
</div>
<?= $this->endSection() ?>