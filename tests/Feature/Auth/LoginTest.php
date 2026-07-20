<?php

use App\Models\Employee;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('employees can authenticate using the login screen', function () {
    $employee = Employee::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $this->post('/login', [
        'email' => $employee->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
});

test('employees cannot authenticate with an invalid password', function () {
    $employee = Employee::factory()->create();

    $this->post('/login', [
        'email' => $employee->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('employees can logout', function () {
    $employee = Employee::factory()->create();

    $response = $this->actingAs($employee)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/login');
});
