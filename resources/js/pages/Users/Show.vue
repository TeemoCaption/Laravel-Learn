<script setup lang="ts">
// 接收 Laravel 透過 Inertia 傳過來的使用者 ID
defineProps<{
    userId: string
}>()
</script>

<template>
    <main>
        <!-- 顯示目前 Route 中指定的使用者 -->
        <h1>使用者詳細資料</h1>

        <p>目前使用者 ID：{{ userId }}</p>
    </main>
</template>