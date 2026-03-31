<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold">Kelola Buku</h2>
        <p class="text-slate-500">Daftar koleksi buku perpustakaan</p>
    </div>
    <a href="<?= base_url('/buku/create') ?>"
        class="btn bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
        Tambah Buku
    </a>
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
                    <th class="px-6 py-4">Cover</th>
                    <th class="px-6 py-4">Judul & Penulis</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Stok</th>
                    <th class="px-6 py-4">QR Code</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                <?php foreach ($buku as $b): ?>
                    <tr class="text-sm">
                        <td class="px-6 py-4">
                            <img src="<?= base_url('uploads/covers/' . $b['cover']) ?>" alt="<?= $b['judul'] ?>"
                                class="w-12 h-16 object-cover rounded-md shadow-sm">
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900 dark:text-slate-100">
                                <?= $b['judul'] ?>
                            </div>
                            <div class="text-xs text-slate-500">
                                <?= $b['penulis'] ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                            <?= $b['nama_kategori'] ?>
                        </td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                            <?= $b['stok'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <img src="<?= base_url('uploads/qrcodes/' . $b['qr_code']) ?>" alt="QR Code" class="w-12 h-12">
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="<?= base_url('/buku/edit/' . $b['id']) ?>"
                                class="text-primary hover:underline font-medium">Edit</a>
                            <a href="<?= base_url('/buku/delete/' . $b['id']) ?>"
                                onclick="return confirm('Yakin ingin menghapus buku ini?')"
                                class="text-rose-500 hover:underline font-medium">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>