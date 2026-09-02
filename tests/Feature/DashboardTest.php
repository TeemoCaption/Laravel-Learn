<?php

use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertOk();
});

test('guests can visit the users page without being redirected to login', function () {
    // 使用者列表不再使用預設 auth middleware，因此訪客可以直接存取。
    $response = $this->get(route('users.index'));

    $response->assertOk();
});

test('guests can visit the admin page while admin authorization is disabled', function () {
    // 目前暫時註解 admin middleware，因此訪客可以直接存取管理員頁面。
    $response = $this->get(route('admin.index'));

    $response->assertOk();
});
