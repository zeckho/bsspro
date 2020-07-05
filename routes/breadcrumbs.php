<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('User', route('users.index'));
});

// Home > Users > Create User
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('users.index'));
    $trail->push('Create User', route('users.create'));
});

// Home > Users > Edit User
Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('home');
    $trail->push('Users', route('users.index'));
    $trail->push('Edit User', route('users.edit', $user->id));
});

// Home > Courses
Breadcrumbs::for('courses', function ($trail) {
    $trail->parent('home');
    $trail->push('Courses', route('courses.index'));
});

// Home > Courses > Create Course
Breadcrumbs::for('courses.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Courses', route('courses.index'));
    $trail->push('Create Course', route('courses.create'));
});

// Home > Courses > Edit Course
Breadcrumbs::for('courses.edit', function ($trail, $course) {
    $trail->parent('home');
    $trail->push('Courses', route('courses.index'));
    $trail->push('Edit Course', route('courses.edit', $course->id));
});

// Home > Courses > View Course
Breadcrumbs::for('courses.show', function ($trail, $course) {
    $trail->parent('home');
    $trail->push('Courses', route('courses.index'));
    $trail->push('View Course', route('courses.show', $course->id));
});

// Home > Roles
Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles.index'));
});

// Home > Roles > Create Role
Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles.index'));
    $trail->push('Create Role', route('roles.create'));
});

// Home > Roles > Edit Role
Breadcrumbs::for('roles.edit', function ($trail, $role) {
    $trail->parent('home');
    $trail->push('Roles', route('roles.index'));
    $trail->push('Edit Role', route('roles.edit', $role->id));
});

// Home > Lessons
Breadcrumbs::for('lessons', function ($trail) {
    $trail->parent('home');
    $trail->push('Lessons', route('lessons.index'));
});

// Home > Lessons > Create Lesson
Breadcrumbs::for('lessons.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Lessons', route('lessons.index'));
    $trail->push('Create Lesson', route('lessons.create'));
});

// Home > Lessons > Edit Lesson
Breadcrumbs::for('lessons.edit', function ($trail, $lesson) {
    $trail->parent('home');
    $trail->push('Lessons', route('lessons.index'));
    $trail->push('Edit Lesson', route('lessons.edit', $lesson->id));
});

// Home > Lessons
Breadcrumbs::for('libraries', function ($trail) {
    $trail->parent('home');
    $trail->push('Libraries', route('libraries.index'));
});

// Home > Lessons > Create Lesson
Breadcrumbs::for('libraries.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Libraries', route('libraries.index'));
    $trail->push('Create Library', route('libraries.create'));
});

// Home > Lessons > Edit Lesson
Breadcrumbs::for('libraries.edit', function ($trail, $lesson) {
    $trail->parent('home');
    $trail->push('Libraries', route('libraries.index'));
    $trail->push('Edit Library', route('libraries.edit', $lesson->id));
});

// Home > Blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('post', $post->id));
});