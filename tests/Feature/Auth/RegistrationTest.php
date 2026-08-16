<?php
use Spatie\Permission\Models\Role;

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function () {
    Role::create([
        'name' => 'applicant', 
        'guard_name' => 'web'
    ]);

    $response = $this->post('/register', [
        'first_name' => 'Test',
        'last_name' => 'User',
        'date_of_birth' => '1990-01-01',
        'address' => '123 Test Street',
        'id_type' => 'passport', 
        'id_number' => 'AB1234567',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});