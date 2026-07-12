<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'SkillSwap'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg sticky top-0 z-50">
        <div class="navbar container mx-auto px-4">
            <div class="flex-1">
                <a href="<?php echo e(url('/')); ?>" class="text-2xl font-bold hover:opacity-90 transition flex items-center gap-2">
                    <span class="text-3xl">🚀</span>
                    <span>SkillSwap</span>
                </a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1 gap-1 text-sm md:text-base">
                    <li><a href="<?php echo e(url('/')); ?>" class="hover:bg-blue-500 rounded-lg transition">Home</a></li>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->role === 'admin'): ?>
                            <li><a href="/users" class="hover:bg-blue-500 rounded-lg transition">Users</a></li>
                            <li><a href="/categories" class="hover:bg-blue-500 rounded-lg transition">Categories</a></li>
                        <?php endif; ?>

                        <?php if(auth()->user()->role === 'teacher'): ?>
                            <li><a href="/sessions" class="hover:bg-blue-500 rounded-lg transition">My Sessions</a></li>
                        <?php endif; ?>

                        <?php if(auth()->user()->role === 'student'): ?>
                            <li><a href="/sessions" class="hover:bg-blue-500 rounded-lg transition">Browse Sessions</a></li>
                        <?php endif; ?>

                        <li><a href="/skills" class="hover:bg-blue-500 rounded-lg transition">Skills</a></li>
                        <li><a href="/dashboard" class="hover:bg-blue-500 rounded-lg transition">Dashboard</a></li>

                        <li>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-sm bg-red-500 hover:bg-red-600 border-0 text-white">Logout</button>
                            </form>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->guard()->guest()): ?>
                        <li><a href="<?php echo e(route('login')); ?>" class="btn btn-sm btn-outline border-white text-white hover:bg-white hover:text-blue-600">Login</a></li>
                        <li><a href="<?php echo e(route('register')); ?>" class="btn btn-sm btn-warning font-bold">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </header>

    <main class="flex-1 p-4">
        <?php if(session('success')): ?>
    <div class="alert alert-success mb-4">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-gradient-to-r from-gray-900 to-gray-800 text-white mt-auto">
        <div class="container mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Brand Column -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-3xl">🚀</span>
                        <span class="text-2xl font-bold">SkillSwap</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">Connecting people through skill sharing and community building.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="<?php echo e(url('/')); ?>" class="hover:text-white transition">Home</a></li>
                        <li><a href="<?php echo e(url('/skills')); ?>" class="hover:text-white transition">Browse Skills</a></li>
                        <li><a href="<?php echo e(auth()->check() ? url('/dashboard') : url('/register')); ?>" class="hover:text-white transition"><?php echo e(auth()->check() ? 'Dashboard' : 'Get Started'); ?></a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Resources</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Stay Updated</h3>
                    <p class="text-gray-400 text-sm mb-3">Subscribe to get the latest updates and new skills.</p>
                    <div class="flex gap-2">
                        <input type="email" placeholder="Your email" class="input input-bordered input-sm flex-1 bg-gray-700 border-gray-600 text-white placeholder-gray-500" />
                        <button class="btn btn-sm btn-primary">Subscribe</button>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-700 pt-8">
                <!-- Bottom Stats -->
                <div class="grid grid-cols-3 gap-4 mb-8 text-center">
                    <div>
                        <div class="text-2xl font-bold text-blue-400">5000+</div>
                        <p class="text-gray-400 text-sm">Active Users</p>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-purple-400">500+</div>
                        <p class="text-gray-400 text-sm">Skills</p>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-pink-400">1000+</div>
                        <p class="text-gray-400 text-sm">Sessions</p>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">Copyright © 2024 SkillSwap. All rights reserved.</p>
                    <div class="flex gap-4 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white text-2xl transition">f</a>
                        <a href="#" class="text-gray-400 hover:text-white text-2xl transition">𝕏</a>
                        <a href="#" class="text-gray-400 hover:text-white text-2xl transition">in</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html><?php /**PATH D:\ELTE-CS\4th_Sem\web\assignments\skillswap\resources\views/layouts/app.blade.php ENDPATH**/ ?>