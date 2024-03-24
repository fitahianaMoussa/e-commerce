<template>
    <AdminLayout>
        <ProductList :products= "products"></ProductList>
    </AdminLayout>
</template>

<script>
import { defineComponent,defineProps } from 'vue'; // Import defineComponent function
import AdminLayout from '../Components/AdminLayout.vue';
import ProductList from './ProductList.vue';

export default defineComponent({
    components: {
        AdminLayout, // Register the AdminLayout component
        ProductList
    },
    props: {
        products: {
            type: Array,
            required: true
        }
    }
});
</script>
