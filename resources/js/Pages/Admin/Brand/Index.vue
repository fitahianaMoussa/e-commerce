<template>
    <AdminLayout>
        <BrandList :brands= "brands"></BrandList>
    </AdminLayout>
</template>

<script>
import { defineComponent,defineProps } from 'vue'; // Import defineComponent function
import AdminLayout from '../Components/AdminLayout.vue';
import BrandList from './BrandList.vue';
                
export default defineComponent({
    components: {
    AdminLayout, // Register the AdminLayout component
    BrandList,
    
},
    props: {
        brands: {
            type: Array,
            required: true
        }
    }
});
</script>
