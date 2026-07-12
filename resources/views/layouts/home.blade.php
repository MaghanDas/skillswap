<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillSwap - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen">

    <header class="bg-base-100 shadow-md p-4">
        <div class="navbar container mx-auto">
            <div class="flex-1">
                <a class="btn btn-ghost normal-case text-2xl font-bold text-primary">SkillSwap</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="skills-list.html">Skills</a></li>
                    <li><a href="dashboard.html">Dashboard</a></li>
                    <li><a href="login.html" class="btn btn-primary btn-outline mr-2">Login</a></li>
                    <li><a href="register.html" class="btn btn-primary">Register</a></li>
                </ul>
            </div>
        </div>
    </header>

    <section class="hero bg-base-200 py-20">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="text-5xl font-bold">Trade Your Skills, Grow Your Community</h1>
                <p class="py-6">Join SkillSwap, where you can share your expertise and learn new things from your neighbors. It's a skill exchange platform for all!</p>
                <a href="register.html" class="btn btn-primary">Join Now</a>
            </div>
        </div>
    </section>

    <section class="container mx-auto py-16">
        <h2 class="text-3xl font-bold text-center mb-10">Featured Skills</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="card bg-base-100 shadow-xl">
                <figure><img src="https://via.placeholder.com/400x225?text=Guitar+Lessons" alt="Guitar Lessons" /></figure>
                <div class="card-body">
                    <h2 class="card-title">Acoustic Guitar Basics</h2>
                    <p>Learn chords, strumming patterns, and basic music theory.</p>
                    <div class="badge badge-secondary">Music</div>
                    <p class="text-sm">Difficulty: Beginner</p>
                    <p class="text-sm">Teacher: John Doe</p>
                    <div class="card-actions justify-end">
                        <a href="skill-detail.html" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl">
                <figure><img src="https://via.placeholder.com/400x225?text=Web+Development" alt="Web Development" /></figure>
                <div class="card-body">
                    <h2 class="card-title">Intro to HTML & CSS</h2>
                    <p>Build your first website from scratch with modern tech.</p>
                    <div class="badge badge-accent">Web Dev</div>
                    <p class="text-sm">Difficulty: Intermediate</p>
                    <p class="text-sm">Teacher: Jane Smith</p>
                    <div class="card-actions justify-end">
                        <a href="skill-detail.html" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl">
                <figure><img src="https://via.placeholder.com/400x225?text=Cooking+Class" alt="Cooking Class" /></figure>
                <div class="card-body">
                    <h2 class="card-title">Italian Pasta Perfection</h2>
                    <p>Master the art of making fresh pasta and classic sauces.</p>
                    <div class="badge badge-primary">Cooking</div>
                    <p class="text-sm">Difficulty: All Levels</p>
                    <p class="text-sm">Teacher: Mike Johnson</p>
                    <div class="card-actions justify-end">
                        <a href="skill-detail.html" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer footer-center p-10 bg-base-300 text-base-content mt-auto">
        <div>
            <p>Copyright © 2024 - SkillSwap</p>
            <p>Built with Tailwind CSS & DaisyUI</p>
        </div>
    </footer>

</body>
</html>