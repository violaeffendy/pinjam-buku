<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold">Kelola Kategori</h2>
        <p class="text-slate-500">Daftar kategori buku yang tersedia</p>
    </div>
    <button onclick="document.getElementById('addModal').classList.remove('hidden')"
        class="btn bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
        Tambah Kategori
    </button>
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
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Nama Kategori</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                <?php foreach ($kategori as $k): ?>
                    <tr class="text-sm">
                        <td class="px-6 py-4">
                            <?= $k['id'] ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">
                            <?= $k['nama_kategori'] ?>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button onclick="editKategori(<?= $k['id'] ?>, '<?= $k['nama_kategori'] ?>')"
                                class="text-primary hover:underline font-medium">Edit</button>
                            <a href="<?= base_url('/kategori/delete/' . $k['id']) ?>"
                                onclick="return confirm('Yakin ingin menghapus?')"
                                class="text-rose-500 hover:underline font-medium">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
    <div
        class="bg-white dark:bg-slate-900 p-8 rounded-2xl w-full max-w-md shadow-2xl border border-slate-200 dark:border-slate-800">
        <h3 class="text-xl font-bold mb-6">Tambah Kategori Baru</h3>
        <form action="<?= base_url('/kategori/store') ?>" method="POST">
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nama Kategori</label>
                <input type="text" name="nama_kategori"
                    class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-2 focus:ring-primary outline-none transition-all"
                    required>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')"
                    class="px-4 py-2 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
    <div
        class="bg-white dark:bg-slate-900 p-8 rounded-2xl w-full max-w-md shadow-2xl border border-slate-200 dark:border-slate-800">
        <h3 class="text-xl font-bold mb-6">Edit Kategori</h3>
        <form id="editForm" action="" method="POST">
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nama Kategori</label>
                <input type="text" id="edit_nama" name="nama_kategori"
                    class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-2 focus:ring-primary outline-none transition-all"
                    required>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')"
                    class="px-4 py-2 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition-colors">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editKategori(id, nama) {
        document.getElementById('editForm').action = '<?= base_url('/kategori/update') ?>/' + id;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('editModal').classList.remove('hidden');
    }
</script>
<?= $this->endSection() ?>