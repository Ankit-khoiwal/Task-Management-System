<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run()
    {

        $userId = User::where('name', 'Admin')->first()->id;

        $tasks = [
            [
                'title' => 'Implement User Authentication',
                'description' => 'Set up user registration and login functionality using Laravel Breeze or Jetstream.',
                'priority' => 'high',
                'status' => 'completed',
                'deadline' => Carbon::now()->addDays(7),
                'user_id' => $userId,
            ],
            [
                'title' => 'Create User Profiles',
                'description' => 'Design and implement user profiles with the ability to edit and update user information.',
                'priority' => 'medium',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(14),
                'user_id' => $userId,
            ],
            [
                'title' => 'Develop RESTful APIs',
                'description' => 'Create RESTful APIs for the application, including CRUD operations for user data.',
                'priority' => 'high',
                'status' => 'completed',
                'deadline' => Carbon::now()->addDays(10),
                'user_id' => $userId,
            ],
            [
                'title' => 'Implement Frontend Framework',
                'description' => 'Choose a frontend framework (Vue.js, React, or Angular) and implement the application interface.',
                'priority' => 'medium',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(12),
                'user_id' => $userId,
            ],
            [
                'title' => 'Setup Database Migrations',
                'description' => 'Create necessary database migrations for users, tasks, and roles.',
                'priority' => 'low',
                'status' => 'completed',
                'deadline' => Carbon::now()->addDays(5),
                'user_id' => $userId,
            ],
            [
                'title' => 'Write Unit Tests',
                'description' => 'Implement unit tests for authentication and task management features.',
                'priority' => 'high',
                'status' => 'completed',
                'deadline' => Carbon::now()->addDays(8),
                'user_id' => $userId,
            ],
            [
                'title' => 'Integrate Payment Gateway',
                'description' => 'Set up payment gateway for the application, ensuring secure transactions.',
                'priority' => 'high',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(20),
                'user_id' => $userId,
            ],
            [
                'title' => 'Optimize Application Performance',
                'description' => 'Identify and fix performance bottlenecks in the application.',
                'priority' => 'medium',
                'status' => 'completed',
                'deadline' => Carbon::now()->addDays(15),
                'user_id' => $userId,
            ],
            [
                'title' => 'Deploy Application',
                'description' => 'Deploy the application to a production server and ensure everything is working correctly.',
                'priority' => 'high',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(30),
                'user_id' => $userId,
            ],
            [
                'title' => 'Gather User Feedback',
                'description' => 'Collect feedback from users and make necessary adjustments to the application.',
                'priority' => 'medium',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(25),
                'user_id' => $userId,
            ],
            [
                'title' => 'Create Documentation',
                'description' => 'Write clear and concise documentation for the application and its usage.',
                'priority' => 'low',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(18),
                'user_id' => $userId,
            ],
            [
                'title' => 'Conduct Security Audit',
                'description' => 'Perform a security audit to identify and fix vulnerabilities in the application.',
                'priority' => 'high',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(22),
                'user_id' => $userId,
            ],
            [
                'title' => 'Create a Feedback System',
                'description' => 'Implement a feedback system for users to report issues and suggest improvements.',
                'priority' => 'medium',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(27),
                'user_id' => $userId,
            ],
            [
                'title' => 'Perform Code Review',
                'description' => 'Conduct a code review session with the development team.',
                'priority' => 'low',
                'status' => 'completed',
                'deadline' => Carbon::now()->addDays(3),
                'user_id' => $userId,
            ],
            [
                'title' => 'Update Software Dependencies',
                'description' => 'Ensure that all software dependencies are up to date to avoid security issues.',
                'priority' => 'low',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(11),
                'user_id' => $userId,
            ],
            [
                'title' => 'Setup Continuous Integration',
                'description' => 'Configure a CI/CD pipeline for automated testing and deployment.',
                'priority' => 'high',
                'status' => 'completed',
                'deadline' => Carbon::now()->addDays(19),
                'user_id' => $userId,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
