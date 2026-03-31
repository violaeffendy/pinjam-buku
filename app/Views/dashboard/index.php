<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">auto_stories</span>
            </div>
        </div>
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Books</p>
        <h3 class="text-2xl font-bold mt-1">
            <?= $stats['total_buku'] ?>
        </h3>
    </div>
    <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-500">
                <span class="material-symbols-outlined"><?= (session()->get('role_id') == 3) ? 'history' : 'group' ?></span>
            </div>
        </div>
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium"><?= (session()->get('role_id') == 3) ? 'My Total Loans' : 'Total Users' ?></p>
        <h3 class="text-2xl font-bold mt-1">
            <?= (session()->get('role_id') == 3) ? ($stats['my_loans'] ?? 0) : $stats['total_user'] ?>
        </h3>
    </div>
    <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                <span class="material-symbols-outlined">assignment_returned</span>
            </div>
        </div>
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Active Loans</p>
        <h3 class="text-2xl font-bold mt-1">
            <?= $stats['total_pinjam'] ?>
        </h3>
    </div>
    <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-500">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
        </div>
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Returned</p>
        <h3 class="text-2xl font-bold mt-1">
            <?= $stats['total_kembali'] ?>
        </h3>
    </div>
</div>

<!-- Recent Transactions -->
<div
    class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
        <h3 class="text-lg font-bold">Recent Transactions</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead
                class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-xs font-bold uppercase">
                <tr>
                    <th class="px-6 py-4">Book Title</th>
                    <?php if (session()->get('role_id') != 3): ?>
                        <th class="px-6 py-4">Borrower</th>
                    <?php endif; ?>
                    <th class="px-6 py-4">Borrow Date</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                <?php if (empty($recent_loans)): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-slate-500">No recent transactions</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($recent_loans as $loan): ?>
                        <tr class="text-sm">
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">
                                <?= $loan['judul'] ?>
                            </td>
                            <?php if (session()->get('role_id') != 3): ?>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    <?= $loan['nama_lengkap'] ?>
                                </td>
                            <?php endif; ?>
                            <td class="px-6 py-4 text-slate-500">
                                <?= $loan['tgl_pinjam'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($loan['status'] == 'Dipinjam'): ?>
                                    <span
                                        class="px-2 py-1 bg-amber-500/10 text-amber-500 rounded-full text-xs font-bold">Dipinjam</span>
                                <?php else: ?>
                                    <span
                                        class="px-2 py-1 bg-emerald-500/10 text-emerald-500 rounded-full text-xs font-bold">Kembali</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <?php if ($loan['denda'] > 0 && $loan['pembayaran_status'] != 'Lunas'): ?>
                                    <a href="<?= base_url('/payment/pay/' . $loan['id']) ?>"
                                        class="bg-rose-500 text-white px-3 py-1 rounded text-xs font-bold hover:bg-rose-600 transition-colors inline-block">
                                        Bayar
                                    </a>
                                <?php else: ?>
                                    <span class="text-slate-400 italic">No Action</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>