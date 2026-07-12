<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Skill;
use App\Models\UserSkill;
use App\Models\Session;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@skillswap.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Teacher Users
        $teacher1 = User::create([
            'name' => 'John Smith',
            'email' => 'john@skillswap.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        $teacher2 = User::create([
            'name' => 'Sarah Johnson',
            'email' => 'sarah@skillswap.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // Create Student Users
        $student1 = User::create([
            'name' => 'Mike Davis',
            'email' => 'mike@skillswap.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        $student2 = User::create([
            'name' => 'Emma Wilson',
            'email' => 'emma@skillswap.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Create Categories
        $programming = Category::create([
            'name' => 'Programming',
            'description' => 'Learn various programming languages and frameworks',
        ]);

        $design = Category::create([
            'name' => 'Design',
            'description' => 'Graphic design, UI/UX, and creative skills',
        ]);

        $languages = Category::create([
            'name' => 'Languages',
            'description' => 'Learn foreign languages and communication skills',
        ]);

        $music = Category::create([
            'name' => 'Music',
            'description' => 'Musical instruments and music theory',
        ]);

        // Create Skills
        $php = Skill::create([
            'name' => 'PHP Development',
            'description' => 'Learn PHP programming for web development',
            'category_id' => $programming->id,
            'difficulty' => 'intermediate',
        ]);

        $javascript = Skill::create([
            'name' => 'JavaScript',
            'description' => 'Master JavaScript for frontend and backend development',
            'category_id' => $programming->id,
            'difficulty' => 'intermediate',
        ]);

        $python = Skill::create([
            'name' => 'Python Programming',
            'description' => 'Learn Python for data science and automation',
            'category_id' => $programming->id,
            'difficulty' => 'beginner',
        ]);

        $uiDesign = Skill::create([
            'name' => 'UI/UX Design',
            'description' => 'Create beautiful and user-friendly interfaces',
            'category_id' => $design->id,
            'difficulty' => 'intermediate',
        ]);

        $spanish = Skill::create([
            'name' => 'Spanish',
            'description' => 'Learn conversational and written Spanish',
            'category_id' => $languages->id,
            'difficulty' => 'beginner',
        ]);

        $guitar = Skill::create([
            'name' => 'Guitar',
            'description' => 'Learn to play acoustic and electric guitar',
            'category_id' => $music->id,
            'difficulty' => 'beginner',
        ]);

        // Assign Skills to Users
        // John Smith (Teacher) - Teaching PHP and JavaScript
        UserSkill::create([
            'user_id' => $teacher1->id,
            'skill_id' => $php->id,
            'experience_level' => 'advanced',
            'is_teaching' => true,
        ]);

        UserSkill::create([
            'user_id' => $teacher1->id,
            'skill_id' => $javascript->id,
            'experience_level' => 'intermediate',
            'is_teaching' => true,
        ]);

        // Sarah Johnson (Teacher) - Teaching UI/UX and Python
        UserSkill::create([
            'user_id' => $teacher2->id,
            'skill_id' => $uiDesign->id,
            'experience_level' => 'advanced',
            'is_teaching' => true,
        ]);

        UserSkill::create([
            'user_id' => $teacher2->id,
            'skill_id' => $python->id,
            'experience_level' => 'intermediate',
            'is_teaching' => true,
        ]);

        // Mike Davis (Student) - Learning JavaScript and UI/UX
        UserSkill::create([
            'user_id' => $student1->id,
            'skill_id' => $javascript->id,
            'experience_level' => 'beginner',
            'is_teaching' => false,
        ]);

        UserSkill::create([
            'user_id' => $student1->id,
            'skill_id' => $uiDesign->id,
            'experience_level' => 'beginner',
            'is_teaching' => false,
        ]);

        // Emma Wilson (Student) - Learning Spanish and Guitar
        UserSkill::create([
            'user_id' => $student2->id,
            'skill_id' => $spanish->id,
            'experience_level' => 'intermediate',
            'is_teaching' => false,
        ]);

        UserSkill::create([
            'user_id' => $student2->id,
            'skill_id' => $guitar->id,
            'experience_level' => 'beginner',
            'is_teaching' => false,
        ]);

        // Create Sessions
        $session1 = Session::create([
            'title' => 'PHP Web Development Basics',
            'description' => 'Learn the fundamentals of PHP programming for web development',
            'teacher_id' => $teacher1->id,
            'student_id' => $student1->id,
            'skill_id' => $php->id,
            'session_date' => now()->addDays(7)->toDateString(),
            'session_time' => '14:00',
            'duration' => 60,
            'status' => 'confirmed',
        ]);

        $session2 = Session::create([
            'title' => 'JavaScript Fundamentals',
            'description' => 'Master the basics of JavaScript programming',
            'teacher_id' => $teacher1->id,
            'student_id' => $student1->id,
            'skill_id' => $javascript->id,
            'session_date' => now()->addDays(14)->toDateString(),
            'session_time' => '16:00',
            'duration' => 90,
            'status' => 'pending',
        ]);

        $session3 = Session::create([
            'title' => 'UI/UX Design Principles',
            'description' => 'Learn the fundamentals of user interface and user experience design',
            'teacher_id' => $teacher2->id,
            'student_id' => $student2->id,
            'skill_id' => $uiDesign->id,
            'session_date' => now()->subDays(7)->toDateString(),
            'session_time' => '10:00',
            'duration' => 120,
            'status' => 'completed',
        ]);

        // Create Reviews
        Review::create([
            'session_id' => $session3->id,
            'rating' => 5,
            'comment' => 'Excellent session! Sarah is very knowledgeable and patient. I learned a lot about UI/UX principles.',
        ]);

        Review::create([
            'session_id' => $session3->id,
            'rating' => 4,
            'comment' => 'Great student, very engaged and eager to learn. Would love to teach again!',
        ]);

        $this->command->info('Database seeded successfully!');
        $this->command->info('Test accounts created:');
        $this->command->info('Admin: admin@skillswap.com / password');
        $this->command->info('Teacher: john@skillswap.com / password');
        $this->command->info('Teacher: sarah@skillswap.com / password');
        $this->command->info('Student: mike@skillswap.com / password');
        $this->command->info('Student: emma@skillswap.com / password');
    }
}
