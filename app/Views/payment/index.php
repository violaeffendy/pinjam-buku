<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto">
    <div class="mb-8 border-b border-slate-200 dark:border-slate-800 pb-4">
        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Checkout Pembayaran</h2>
        <p class="text-slate-500 mt-2">Selesaikan pembayaran denda buku Anda</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Summary -->
        <div class="lg:col-span-1 order-2 lg:order-1">
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm sticky top-8">
                <h3 class="text-lg font-bold mb-4">Ringkasan Denda</h3>
                <div class="space-y-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Buku</span>
                        <span class="font-medium text-right">
                            <?= $pinjam['judul'] ?>
                        </span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Kode Transaksi</span>
                        <span class="font-mono text-primary">
                            <?= $transaction_code ?>
                        </span>
                    </div>
                    <hr class="border-dashed border-slate-200 dark:border-slate-800">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-900 dark:text-white font-bold">Total Bayar</span>
                        <span class="text-xl font-black text-primary">Rp
                            <?= number_format($amount, 0, ',', '.') ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="lg:col-span-2 order-1 lg:order-2">
            <form action="<?= base_url('/payment/process/' . $transaction_code) ?>" method="POST">
                <div class="space-y-6">
                    <!-- QRIS Area -->
                    <div
                        class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
                        <div
                            class="p-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                            <h4 class="font-bold flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">qr_code_2</span>
                                QRIS (Gopay, OVO, Dana, LinkAja)
                            </h4>
                        </div>
                        <div class="p-4">
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="payment_method" value="qris" class="hidden peer" checked>
                                <div
                                    class="w-full p-4 rounded-xl border-2 border-transparent peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 bg-white rounded-lg flex items-center justify-center p-2 shadow-sm border border-slate-100">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg"
                                                    alt="QRIS" class="max-w-full">
                                            </div>
                                            <div>
                                                <p class="font-bold">QRIS</p>
                                                <p class="text-xs text-slate-500">Scan QR Code untuk membayar</p>
                                            </div>
                                        </div>
                                        <span
                                            class="material-symbols-outlined text-primary opacity-0 peer-checked:opacity-100">check_circle</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Bank Transfer Area -->
                    <div
                        class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
                        <div
                            class="p-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                            <h4 class="font-bold flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">account_balance</span>
                                Bank Transfer (Virtual Account)
                            </h4>
                        </div>
                        <div class="p-4 space-y-3">
                            <?php
                            $banks = [
                                ['id' => 'bca', 'name' => 'BCA Virtual Account', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg'],
                                ['id' => 'mandiri', 'name' => 'Mandiri Virtual Account', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg'],
                                ['id' => 'bni', 'name' => 'BNI Virtual Account', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/5/55/BNI_logo.svg']
                            ];
                            foreach ($banks as $bank):
                                ?>
                                <label class="flex items-center cursor-pointer group">
                                    <input type="radio" name="payment_method" value="va_<?= $bank['id'] ?>"
                                        class="hidden peer">
                                    <div
                                        class="w-full p-4 rounded-xl border-2 border-transparent peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="w-12 h-12 bg-white rounded-lg flex items-center justify-center p-2 shadow-sm border border-slate-100">
                                                    <img src="<?= $bank['logo'] ?>" alt="<?= $bank['name'] ?>"
                                                        class="max-h-full">
                                                </div>
                                                <div>
                                                    <p class="font-bold">
                                                        <?= $bank['name'] ?>
                                                    </p>
                                                    <p class="text-xs text-slate-500">Bayar via Virtual Account</p>
                                                </div>
                                            </div>
                                            <span
                                                class="material-symbols-outlined text-primary opacity-0 peer-checked:opacity-100">check_circle</span>
                                        </div>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-primary text-white py-4 rounded-2xl font-bold text-lg hover:shadow-lg hover:shadow-primary/30 transition-all flex items-center justify-center gap-2">
                        Lanjut ke Pembayaran
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>

                    <p class="text-center text-xs text-slate-400">
                        <span class="material-symbols-outlined align-middle !text-sm">lock</span>
                        Pembayaran aman & terenkripsi
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>