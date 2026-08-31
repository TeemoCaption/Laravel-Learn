<?php

test('redirects the home route to the users page', function () {
    $response = $this->get(route('home'));

    // 首頁已移除預設 Welcome 頁，改為導向自訂使用者列表頁面
    $response->assertRedirect('/users');
});
