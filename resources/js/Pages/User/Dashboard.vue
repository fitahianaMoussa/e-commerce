<template>
    <UserLayouts>
        <div class="relative max-w-screen-xl py-24 mx-auto overflow-x-auto">
            <table v-show="order.order_items.length > 0" v-for="order in orders" :key="order.id" class=" w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 mb-4 uppercase dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Order ID {{ order.id }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in order.order_items" :key="item.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ item.product.title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ item.product.brand.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ item.product.category.name }}
                        </td>
                        <td class="px-6 py-4">
                            $ {{ item.product.price }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </UserLayouts>
</template>

<script setup>
import UserLayouts from './Layout/UserLayouts.vue';

defineProps({
    orders : Array
})
</script>
