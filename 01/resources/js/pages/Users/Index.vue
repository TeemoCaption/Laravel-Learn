<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { show } from '@/routes/users';
</script>

<template>
    <main>
        <!-- 使用者列表頁面 -->
        <h1>使用者列表</h1>

        <p>這是 Laravel + Inertia + Vue 的頁面。</p>

        <!-- 使用產生的 users.show 路由前往指定使用者詳細資料頁 -->
        <Link :href="show(1)">查看使用者 ID：1</Link>
    </main>
</template>
