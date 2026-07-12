

<?php $__env->startSection('title', 'SkillSwap - Home'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative min-h-screen bg-gradient-to-br from-blue-600 via-blue-500 to-purple-600 text-white flex items-center overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        Trade Your Skills, <span class="text-yellow-300">Grow Your Community</span>
                    </h1>
                    <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                        Connect with learners and teachers around you. Share your expertise, learn new skills, and build meaningful relationships in your community.
                    </p>
                    <div class="flex gap-4 flex-wrap">
                        <?php if(auth()->guard()->guest()): ?>
                            <a href="<?php echo e(url('/register')); ?>" class="btn btn-warning btn-lg font-bold hover:shadow-lg">Get Started Free</a>
                            <a href="<?php echo e(url('/skills')); ?>" class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-blue-600">Browse Skills</a>
                        <?php else: ?>
                            <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-warning btn-lg font-bold hover:shadow-lg">Go to Dashboard</a>
                            <a href="<?php echo e(url('/skills')); ?>" class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-blue-600">Explore Skills</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-yellow-300 to-pink-300 rounded-3xl transform -skew-y-3"></div>
                        <div class="relative bg-white rounded-3xl p-8 shadow-2xl">
                            <div class="space-y-4">
                                <div class="h-4 bg-gradient-to-r from-blue-400 to-purple-400 rounded w-3/4"></div>
                                <div class="h-4 bg-gradient-to-r from-blue-400 to-purple-400 rounded w-full"></div>
                                <div class="h-4 bg-gradient-to-r from-blue-400 to-purple-400 rounded w-5/6"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="grid grid-cols-3 md:grid-cols-3 gap-8 mt-20 md:mt-32">
                <div class="text-center">
                    <div class="text-4xl font-bold text-yellow-300">5000+</div>
                    <p class="text-blue-100 mt-2">Active Users</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-yellow-300">500+</div>
                    <p class="text-blue-100 mt-2">Skills Available</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-yellow-300">1000+</div>
                    <p class="text-blue-100 mt-2">Sessions Completed</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-base-100">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16">Why Choose SkillSwap?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="card bg-gradient-to-br from-blue-50 to-blue-100 shadow-lg hover:shadow-xl transition p-8">
                    <div class="text-5xl mb-4">🎓</div>
                    <h3 class="text-2xl font-bold mb-3">Learn Anything</h3>
                    <p class="text-gray-700">Explore hundreds of skills taught by experienced instructors in your community.</p>
                </div>
                <div class="card bg-gradient-to-br from-purple-50 to-purple-100 shadow-lg hover:shadow-xl transition p-8">
                    <div class="text-5xl mb-4">👥</div>
                    <h3 class="text-2xl font-bold mb-3">Share Your Expertise</h3>
                    <p class="text-gray-700">Teach others what you know and help your community grow together.</p>
                </div>
                <div class="card bg-gradient-to-br from-pink-50 to-pink-100 shadow-lg hover:shadow-xl transition p-8">
                    <div class="text-5xl mb-4">💰</div>
                    <h3 class="text-2xl font-bold mb-3">100% Free</h3>
                    <p class="text-gray-700">No hidden fees, no subscriptions. Pure skill exchange and community building.</p>
                </div>
                <div class="card bg-gradient-to-br from-green-50 to-green-100 shadow-lg hover:shadow-xl transition p-8">
                    <div class="text-5xl mb-4">⭐</div>
                    <h3 class="text-2xl font-bold mb-3">Verified Teachers</h3>
                    <p class="text-gray-700">All instructors are vetted by the community through ratings and reviews.</p>
                </div>
                <div class="card bg-gradient-to-br from-yellow-50 to-yellow-100 shadow-lg hover:shadow-xl transition p-8">
                    <div class="text-5xl mb-4">📍</div>
                    <h3 class="text-2xl font-bold mb-3">Local Community</h3>
                    <p class="text-gray-700">Connect with people near you and build meaningful relationships.</p>
                </div>
                <div class="card bg-gradient-to-br from-orange-50 to-orange-100 shadow-lg hover:shadow-xl transition p-8">
                    <div class="text-5xl mb-4">🚀</div>
                    <h3 class="text-2xl font-bold mb-3">Grow Together</h3>
                    <p class="text-gray-700">Share knowledge, gain experience, and advance your skills.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-gradient-to-r from-gray-50 to-gray-100">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16">How It Works</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="relative">
                    <div class="flex items-center justify-center w-16 h-16 bg-blue-600 text-white rounded-full font-bold text-2xl mx-auto mb-4">1</div>
                    <h3 class="text-xl font-bold text-center mb-2">Sign Up</h3>
                    <p class="text-center text-gray-700">Create your free SkillSwap account as a teacher or learner.</p>
                </div>
                <div class="relative">
                    <div class="absolute top-8 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 to-transparent hidden md:block"></div>
                    <div class="flex items-center justify-center w-16 h-16 bg-purple-600 text-white rounded-full font-bold text-2xl mx-auto mb-4">2</div>
                    <h3 class="text-xl font-bold text-center mb-2">Create Profile</h3>
                    <p class="text-center text-gray-700">Add your skills and expertise to your profile.</p>
                </div>
                <div class="relative">
                    <div class="absolute top-8 left-0 right-0 h-1 bg-gradient-to-r from-purple-600 to-transparent hidden md:block"></div>
                    <div class="flex items-center justify-center w-16 h-16 bg-pink-600 text-white rounded-full font-bold text-2xl mx-auto mb-4">3</div>
                    <h3 class="text-xl font-bold text-center mb-2">Find Sessions</h3>
                    <p class="text-center text-gray-700">Browse and book sessions with teachers in your area.</p>
                </div>
                <div class="relative">
                    <div class="absolute top-8 left-0 right-0 h-1 bg-gradient-to-r from-pink-600 to-transparent hidden md:block"></div>
                    <div class="flex items-center justify-center w-16 h-16 bg-green-600 text-white rounded-full font-bold text-2xl mx-auto mb-4">4</div>
                    <h3 class="text-xl font-bold text-center mb-2">Learn & Grow</h3>
                    <p class="text-center text-gray-700">Attend sessions and expand your skills with the community.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Skills Section -->
    <section class="py-20 bg-base-100">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-4">Popular Skills</h2>
            <p class="text-center text-gray-600 mb-12 text-lg">Explore what people are learning and teaching right now</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all border border-gray-200">
                    <figure class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-6xl">🎸</figure>
                    <div class="card-body">
                        <h2 class="card-title">Music Lessons</h2>
                        <p class="text-gray-600">Learn guitar, piano, or vocals from experienced musicians.</p>
                        <div class="card-actions justify-between items-center mt-4">
                            <div class="badge badge-info">Music</div>
                            <a href="<?php echo e(auth()->check() ? url('/skills') : url('/register')); ?>" class="btn btn-sm btn-primary">Explore</a>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all border border-gray-200">
                    <figure class="h-48 bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center text-white text-6xl">💻</figure>
                    <div class="card-body">
                        <h2 class="card-title">Web Development</h2>
                        <p class="text-gray-600">Master HTML, CSS, JavaScript, and modern frameworks.</p>
                        <div class="card-actions justify-between items-center mt-4">
                            <div class="badge badge-primary">Tech</div>
                            <a href="<?php echo e(auth()->check() ? url('/skills') : url('/register')); ?>" class="btn btn-sm btn-primary">Explore</a>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all border border-gray-200">
                    <figure class="h-48 bg-gradient-to-br from-pink-500 to-pink-600 flex items-center justify-center text-white text-6xl">🍳</figure>
                    <div class="card-body">
                        <h2 class="card-title">Cooking & Baking</h2>
                        <p class="text-gray-600">Learn recipes and techniques from passionate chefs.</p>
                        <div class="card-actions justify-between items-center mt-4">
                            <div class="badge badge-secondary">Cooking</div>
                            <a href="<?php echo e(auth()->check() ? url('/skills') : url('/register')); ?>" class="btn btn-sm btn-primary">Explore</a>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all border border-gray-200">
                    <figure class="h-48 bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white text-6xl">🧘</figure>
                    <div class="card-body">
                        <h2 class="card-title">Health & Wellness</h2>
                        <p class="text-gray-600">Yoga, fitness, meditation, and wellness coaching.</p>
                        <div class="card-actions justify-between items-center mt-4">
                            <div class="badge badge-success">Health</div>
                            <a href="<?php echo e(auth()->check() ? url('/skills') : url('/register')); ?>" class="btn btn-sm btn-primary">Explore</a>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all border border-gray-200">
                    <figure class="h-48 bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center text-white text-6xl">🎨</figure>
                    <div class="card-body">
                        <h2 class="card-title">Art & Design</h2>
                        <p class="text-gray-600">Drawing, painting, graphic design, and creative skills.</p>
                        <div class="card-actions justify-between items-center mt-4">
                            <div class="badge badge-warning">Art</div>
                            <a href="<?php echo e(auth()->check() ? url('/skills') : url('/register')); ?>" class="btn btn-sm btn-primary">Explore</a>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all border border-gray-200">
                    <figure class="h-48 bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center text-white text-6xl">📚</figure>
                    <div class="card-body">
                        <h2 class="card-title">Languages</h2>
                        <p class="text-gray-600">Learn new languages from native speakers.</p>
                        <div class="card-actions justify-between items-center mt-4">
                            <div class="badge badge-accent">Languages</div>
                            <a href="<?php echo e(auth()->check() ? url('/skills') : url('/register')); ?>" class="btn btn-sm btn-primary">Explore</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="<?php echo e(auth()->check() ? url('/skills') : url('/register')); ?>" class="btn btn-primary btn-lg">See All Skills</a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to Start Your Learning Journey?</h2>
            <p class="text-xl mb-8 text-blue-100">Join thousands of people already learning and sharing skills on SkillSwap.</p>
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(url('/register')); ?>" class="btn btn-warning btn-lg font-bold mr-4 hover:shadow-lg">Create Free Account</a>
                <a href="<?php echo e(url('/skills')); ?>" class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-blue-600">Browse Skills Now</a>
            <?php else: ?>
                <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-warning btn-lg font-bold mr-4 hover:shadow-lg">Go to Dashboard</a>
                <?php if(auth()->user()->role === 'teacher'): ?>
                    <a href="<?php echo e(url('/sessions/create')); ?>" class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-blue-600">Create a Session</a>
                <?php else: ?>
                    <a href="<?php echo e(url('/sessions')); ?>" class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-blue-600">Browse Sessions</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\assignments\skillswap\resources\views/home.blade.php ENDPATH**/ ?>