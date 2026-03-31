<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="max-w-md mx-auto">
    <div
        class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="p-6 bg-primary text-white text-center">
            <h3 class="text-xl font-bold">Menunggu Pembayaran</h3>
            <p class="text-blue-100 text-sm mt-1">Selesaikan pembayaran sebelum sesi berakhir</p>
        </div>

        <div class="p-8">
            <!-- Total -->
            <div class="text-center mb-8">
                <p class="text-slate-500 text-sm uppercase tracking-widest font-bold">Total Pembayaran</p>
                <h2 class="text-4xl font-black text-slate-900 dark:text-white mt-2">
                    Rp
                    <?= number_format($payment['amount'], 0, ',', '.') ?>
                </h2>
                <p class="text-primary font-mono text-sm mt-1">
                    <?= $payment['transaction_code'] ?>
                </p>
            </div>

            <!-- Payment Content -->
            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800">
                <?php if ($method == 'qris'): ?>
                    <div class="text-center">
                        <p class="font-bold mb-4">Scan QR Code</p>
                        <div class="bg-white p-4 rounded-xl inline-block shadow-sm border border-slate-200 mb-4">
                            <!-- Simulated QR Code -->
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=SIMULATED_PAYMENT_<?= $payment['transaction_code'] ?>"
                                alt="QR Code" class="w-48 h-48">
                        </div>
                        <div class="flex items-center justify-center gap-4">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" class="h-6">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg"
                                class="h-4">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg"
                                class="h-4">
                        </div>
                    </div>
                <?php else: ?>
                    <div>
                        <p class="font-bold text-center mb-4">Nomor Virtual Account</p>
                        <div
                            class="bg-white dark:bg-slate-900 p-4 rounded-xl flex items-center justify-between border border-slate-200 dark:border-slate-800 shadow-sm">
                            <span class="text-2xl font-black tracking-widest text-primary">
                                <?php 
                                    $bank_prefix = [
                                        'va_bca' => '8801',
                                        'va_mandiri' => '9012',
                                        'va_bni' => '1029'
                                    ];
                                    $key = (string)($method ?? 'default');
                                    echo ($bank_prefix[$key] ?? '8888') . rand(10000000, 99999999);
                                ?>
                            </span>
                            <button class="text-primary hover:bg-primary/10 p-2 rounded-lg transition-colors"
                                onclick="alert('Copied to clipboard!')">
                                <span class="material-symbols-outlined">content_copy</span>
                            </button>
                        </div>
                        <p class="text-xs text-slate-500 mt-4 text-center italic">
                            Silakan transfer ke nomor di atas melalui Mobile Banking atau ATM
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Simulation Button -->
            <div class="mt-8 space-y-3">
                <a href="<?= base_url('/payment/success/' . $payment['transaction_code']) ?>"
                    class="w-full bg-emerald-500 text-white py-4 rounded-2xl font-bold flex items-center justify-center gap-2 hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-500/20">
                    <span class="material-symbols-outlined">check_circle</span>
                    Simulasi Bayar (Konfirmasi)
                </a>

                <a href="<?= base_url('/pinjaman-saya') ?>"
                    class="w-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 py-3 rounded-2xl font-bold text-center hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    Bayar Nanti
                </a>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="p-6 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800">
            <div class="flex items-center gap-3 text-sm text-slate-500">
                <span class="material-symbols-outlined text-primary">info</span>
                <p>Status akan berubah otomatis setelah Anda menekan tombol simulasi di atas.</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>