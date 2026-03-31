<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold">Data Peminjaman</h2>
        <p class="text-slate-500">Kelola transaksi peminjaman dan pengembalian</p>
    </div>
    <?php if (session()->get('role_id') != 3): ?>
        <a href="<?= base_url('/transaksi/pinjam') ?>"
            class="btn bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
            Tambah Peminjaman
        </a>
    <?php endif; ?>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="mb-4 bg-emerald-500/10 text-emerald-500 p-4 rounded-lg border border-emerald-500/20">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div
    class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead
                class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-xs font-bold uppercase">
                <tr>
                    <th class="px-6 py-4">Buku</th>
                    <?php if (session()->get('role_id') != 3): ?>
                        <th class="px-6 py-4">Peminjam</th>
                    <?php endif; ?>
                    <th class="px-6 py-4">Tanggal Pinjam</th>
                    <th class="px-6 py-4">Batas Kembali</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Denda</th>
                    <th class="px-6 py-4">Status Bayar</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                <?php foreach ($transaksi as $t): ?>
                    <tr class="text-sm">
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">
                            <?= $t['judul'] ?>
                        </td>
                        <?php if (session()->get('role_id') != 3): ?>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                <?= $t['nama_lengkap'] ?>
                            </td>
                        <?php endif; ?>
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
                        <td class="px-6 py-4">
                            <?php if ($t['denda'] > 0): ?>
                                <?php if ($t['pembayaran_status'] == 'Lunas'): ?>
                                    <span
                                        class="px-2 py-1 bg-emerald-500/10 text-emerald-500 rounded-full text-xs font-bold">Lunas</span>
                                <?php elseif ($t['pembayaran_status'] == 'Pending'): ?>
                                    <span
                                        class="px-2 py-1 bg-amber-500/10 text-amber-500 rounded-full text-xs font-bold">Pending</span>
                                <?php else: ?>
                                    <span
                                        class="px-2 py-1 bg-rose-500/10 text-rose-500 rounded-full text-xs font-bold"><?= $t['pembayaran_status'] ?></span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-slate-400">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <?php if ($t['status'] == 'Dipinjam'): ?>
                                <?php if (session()->get('role_id') != 3): ?>
                                    <a href="<?= base_url('/transaksi/kembali/' . $t['id']) ?>"
                                        class="text-primary hover:underline font-medium"
                                        onclick="return confirm('Konfirmasi pengembalian buku?')">Kembalikan</a>
                                <?php else: ?>
                                    <span class="text-amber-500 font-medium">Sedang Dipinjam</span>
                                <?php endif; ?>
                            <?php elseif ($t['denda'] > 0 && $t['pembayaran_status'] != 'Lunas'): ?>
                                <a href="<?= base_url('/payment/pay/' . $t['id']) ?>"
                                    class="bg-rose-500 text-white px-3 py-1 rounded text-xs font-bold hover:bg-rose-600 transition-colors inline-block">
                                    Bayar Denda
                                </a>
                            <?php else: ?>
                                <span class="text-slate-400 italic">Selesai</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Payment script removed as we are using simulation pages -->
<?= $this->endSection() ?>