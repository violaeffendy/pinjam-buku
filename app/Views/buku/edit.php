<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-8 flex items-center gap-4">
    <a href="/buku" class="p-2 rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50">
        <span class="material-symbols-outlined">arrow_back</span>
    </a>
    <h2 class="text-2xl font-bold">Edit Buku</h2>
</div>

<div
    class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-8 max-w-2xl">
    <form action="<?= base_url('/buku/update/' . $buku['id']) ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="coverLama" value="<?= $buku['cover'] ?>">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Judul Buku</label>
                <input type="text" name="judul"
                    class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-2 focus:ring-primary outline-none transition-all"
                    value="<?= $buku['judul'] ?>" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Penulis</label>
                <input type="text" name="penulis"
                    class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-2 focus:ring-primary outline-none transition-all"
                    value="<?= $buku['penulis'] ?>" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Penerbit</label>
                <input type="text" name="penerbit"
                    class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-2 focus:ring-primary outline-none transition-all"
                    value="<?= $buku['penerbit'] ?>" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Tahun Terbit</label>
                <input type="number" name="tahun_terbit"
                    class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-2 focus:ring-primary outline-none transition-all"
                    value="<?= $buku['tahun_terbit'] ?>" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Kategori</label>
                <select name="kategori_id"
                    class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-2 focus:ring-primary outline-none transition-all"
                    required>
                    <?php foreach ($kategori as $k): ?>
                        <option value="<?= $k['id'] ?>" <?= ($k['id'] == $buku['kategori_id']) ? 'selected' : '' ?>>
                            <?= $k['nama_kategori'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Stok</label>
                <input type="number" name="stok"
                    class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-2 focus:ring-primary outline-none transition-all"
                    value="<?= $buku['stok'] ?>" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Cover Buku (Biarkan
                    kosong jika tidak diganti)</label>
                <input type="file" name="cover"
                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
            </div>
            <div class="flex items-center gap-4">
                <p class="text-xs text-slate-500">Cover Saat Ini:</p>
                <img src="<?= base_url('uploads/covers/' . $buku['cover']) ?>"
                    class="w-12 h-16 object-cover rounded shadow-sm">
            </div>
        </div>
        <div class="mt-8 flex justify-end">
            <button type="submit"
                class="px-6 py-2 bg-primary text-white rounded-lg font-bold hover:bg-blue-700 transition-colors">Update
                Buku</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>