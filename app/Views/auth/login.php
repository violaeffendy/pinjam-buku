<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login - PerpusOnline</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-25..0"
        rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            line-height: 1;
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1313ec",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101022",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" },
                },
            },
        }
    </script>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div
            class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
            <div class="p-8">
                <div class="text-center mb-8">
                    <div
                        class="w-16 h-16 rounded-2xl bg-primary flex items-center justify-center text-white mx-auto mb-4 shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined text-3xl">auto_stories</span>
                    </div>
                    <h1 class="text-2xl font-bold tracking-tight">Selamat Datang</h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-2">Silahkan login ke akun Perpustakaan Anda</p>
                </div>

                <?php if (session()->getFlashdata('error')): ?>
                    <div
                        class="mb-6 bg-rose-500/10 text-rose-500 p-4 rounded-xl border border-rose-500/20 text-sm font-medium flex items-center gap-3">
                        <span class="material-symbols-outlined">error</span>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/login') ?>" method="POST" class="space-y-6">
                    <div>
                        <label
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Username</label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">person</span>
                            <input type="text" name="username" placeholder="Masukkan username" required
                                class="w-full pl-12 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border-none rounded-xl focus:ring-2 focus:ring-primary transition-all outline-none"
                                autocomplete="off" />
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Password</label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">lock</span>
                            <input type="password" name="password" placeholder="Masukkan password" required
                                class="w-full pl-12 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border-none rounded-xl focus:ring-2 focus:ring-primary transition-all outline-none" />
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-primary text-white rounded-xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-primary/25 active:scale-[0.98]">
                        Masuk Sekarang
                    </button>
                </form>
            </div>
            <div
                class="bg-slate-50 dark:bg-slate-800/50 p-6 text-center border-t border-slate-100 dark:border-slate-800">
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    Lupa password? Hubungi petugas perpustakaan.
                </p>
            </div>
        </div>
        <p class="text-center mt-8 text-xs text-slate-400 font-medium">
            &copy; <?= date('Y') ?> PerpusOnline. All rights reserved.
        </p>
    </div>
</body>

</html>