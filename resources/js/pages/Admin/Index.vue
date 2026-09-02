<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'

// 建立 Inertia 表單。
// message 會成為送給 Laravel 的 Request 資料。
const form = useForm({
    message: '',
})

// 送出 POST Request。
const submit = () => {
    form.post('/admin/message', {
        // 成功後清空輸入框。
        onSuccess: () => {
            form.reset()
        },
    })
}
</script>

<template>
    <main>
        <h1>管理員頁面</h1>

        <form @submit.prevent="submit">
            <label for="message">
                管理員訊息
            </label>

            <input id="message" v-model="form.message" type="text">

            <button type="submit" :disabled="form.processing">
                送出
            </button>
        </form>
    </main>
</template>