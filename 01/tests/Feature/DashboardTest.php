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

test('guests are forbidden from the admin page instead of being redirected to login', function () {
    // 管理員頁面改由自訂 admin middleware 判斷權限，因此訪客收到 403。
    $response = $this->get(route('admin.index'));

    $response->assertForbidden();
});
