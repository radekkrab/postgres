<script setup>

    import { ref } from 'vue';
    import Modal from '@/Components/Modal.vue';
    import { Link } from '@inertiajs/vue3'
    import { useForm } from '@inertiajs/vue3';
 
    const showOpenProductModal = ref(false);

    let view = null;

    const openProductModal = (product) => {
      view = product;
      showOpenProductModal.value = true;
    }

    const closeModal = () => {
    showOpenProductModal.value = false;
    }
        
    </script>

<template>
    <table>
      <tr>
        <th>АРТИКУЛ</th>
        <th>НАЗВАНИЕ</th>
        <th>СТАТУС</th>
        <th>АТРИБУТЫ</th>
     </tr>
     <tr v-for="product in $page.props.products" :key="product.id" @click="openProductModal(product)">
        <td>{{ product.article }}</td>
        <td>{{ product.name }}</td>
        <td>{{ product.status }}</td>
        <td v-for="prod in product.data">{{ prod['name']  }} : {{ prod['value']  }}</td>
     </tr>
    </table>
    <Modal :show="showOpenProductModal" @close="closeModal">
            <div class="siz-20 bg-black text-white">{{ view.name }}</div>
            <Link :href="route('product.destroy', view)"><h1>Удалить</h1></Link>
    </Modal>
</template>
