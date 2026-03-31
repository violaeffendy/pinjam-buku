<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-2">Riwayat Pinjaman Saya</h2>
    <p class="text-slate-500">Daftar buku yang pernah dan sedang kamu pinjam</p>
</div>

<div
    class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead
                class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-xs font-bold uppercase">
                <tr>
                    <th class="px-6 py-4">Buku</th>
                    <th class="px-6 py-4">Tanggal Pinjam</th>
                    <th class="px-6 py-4">Batas Kembali</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Denda</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                <?php if (empty($transaksi)): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-slate-500">Belum ada riwayat peminjaman</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($transaksi as $t): ?>
                        <tr class="text-sm">
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">
                                <?= $t['judul'] ?>
                            </td>
                            <td class="px-6 py-4 text-slate-500">
                                <?= $t['tgl_pinjam'] ?>
                            </td>
                            <td class="px-6 py-4 text-slate-500">
                                <?= $t['tgl_kembali'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($t['status'] == 'Dipinjam'): ?>
                                    <span
                                        class="px-2 py-1 bg-amber-500/10 text-amber-500 rounded-full text-xs font-bold">Dipinjam</span>
                                <?php else: ?>
                                    <span
                                        class="px-2 py-1 bg-emerald-500/10 text-emerald-500 rounded-full text-xs font-bold">Kembali</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-rose-500 font-bold">
                                <?= ($t['denda'] > 0) ? 'Rp ' . number_format($t['denda'], 0, ',', '.') : '-' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>