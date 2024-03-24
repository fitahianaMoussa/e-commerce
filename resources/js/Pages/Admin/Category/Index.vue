<template>
    <AdminLayout>
        <CategoryList :categories= "categories"></CategoryList>
    </AdminLayout>
</template>

<script>
import { defineComponent,defineProps } from 'vue'; // Import defineComponent function
import AdminLayout from '../Components/AdminLayout.vue';
import CategoryList from './CategoryList.vue';
                
export default defineComponent({
    components: {
    AdminLayout, // Register the AdminLayout component
    CategoryList,
    
},
    props: {
        categories: {
            type: Array,
            required: true
        }
    }
});
</script>
