<script setup lang="ts">
// 定義 Laravel 傳過來的 User 資料型別
interface User {
    id: number
    name: string
    email: string
}

// 接收 Laravel 透過 Inertia 傳過來的完整 User Model
defineProps<{
    user: User
}>()
</script>

<template>
    <main>
        <!-- Laravel 已透過 Route Model Binding 查出使用者 -->
        <h1>使用者詳細資料</h1>

        <p>ID：{{ user.id }}</p>
        <p>姓名：{{ user.name }}</p>
        <p>Email：{{ user.email }}</p>
    </main>
</template>