<script setup>

    import { ref } from 'vue';
    import Modal from '@/Components/Modal.vue';
    import { useForm } from '@inertiajs/vue3';
 
</script>

<template>
    <table>
      <tr>
        <th>АРТИКУЛ</th>
        <th>НАЗВАНИЕ</th>
        <th>СТАТУС</th>
        <th>АТРИБУТЫ</th>
     </tr>
     <tr v-for="product in $page.props.products" :key="product.id">
        <td>{{ product.article }}</td>
        <td>{{ product.name }}</td>
        <td>{{ product.status }}</td>
        <td v-for="prod in product.data">{{ prod['name']  }} : {{ prod['value']  }}</td>
     </tr>
    </table>
    


</template>
