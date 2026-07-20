<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new employees can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test Employee',
        'email' => 'test@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'position' => 'Warehouse Staff',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard.staff'));
});

test('registration requires matching password confirmation', function () {
    $response = $this->post('/register', [
        'name' => 'Test Employee',
        'email' => 'test2@example.com',
        'password' => 'password123',
        'password_confirmation' => 'different',
    ]);

    $response->assertSessionHasErrors('password');
    $this->assertGuest();
});
