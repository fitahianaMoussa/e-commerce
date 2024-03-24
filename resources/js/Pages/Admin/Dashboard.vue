<template>
    <AdminLayout>
        <main class="p-4 md:ml-64 h-auto pt-20">

        </main>
    </AdminLayout>
    
</template>
<script setup>
import AdminLayout from './Components/AdminLayout.vue'
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';

onMounted(() => {
    initFlowbite();
})
</script>