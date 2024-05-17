<script setup>

    import { ref } from 'vue';
    import Modal from '@/Components/Modal.vue';
    import { Link } from '@inertiajs/vue3'
    import { useForm } from '@inertiajs/vue3';
    import EditProduct from './EditProduct.vue';

    defineProps(['showOpenProductModal']);

    const showOpenProductModal = ref(false);

    let view = null;

    const openProductModal = (product) => {
      view = product;
      showOpenProductModal.value = true;
    }

    const closeProductModal = () => {
    showOpenProductModal.value = false;
    }

    </script>

<template>
    <table class="font-roboto table-auto text-left text-[#6E6E6F]">
      <tr class="border-b-2 border-gray-300">
        <td class="py-3 pl-8 w-72">АРТИКУЛ</td>
        <td class="w-64">НАЗВАНИЕ</td>
        <td class="w-64">СТАТУС</td>
        <td class="w-64">АТРИБУТЫ</td>
     </tr>
     <tr class="border-b-2 border-gray-300 bg-white text-lg hover:cursor-pointer" v-for="product in $page.props.products" :key="product.id" @click="openProductModal(product)">
        <td class="py-8 pl-8 w-72">{{ product.article }}</td>
        <td>{{ product.name }}</td>
        <td>{{ product.status }}</td>
        <td class="flex flex-col pt-3"><td v-for="prod in product.data">{{ prod['name'] }} : {{ prod['value'] }}</td></td>
     </tr>
    </table>
    <Modal :show="showOpenProductModal" @close="closeProductModal">
      <div class="px-3 py-5 h-96 bg-[#374050] text-white font-roboto">
            <div class="flex mb-4 justify-between">
                <div class="h2 font-semibold text-[22px] uppercase">{{ view.name }}</div>
                <div class="flex">
                    <EditProduct  @sendshowOPM="closeProductModal" :product="{ id: view.id, article: view.article, name: view.name, status: view.status, data: view.data }"/>
                    <Link :href="route('product.destroy', view.id)" method="DELETE" as="button" @click="closeProductModal">
                        <img class="self-center w-5 mr-3" src="/img/recycle2.png"></img>
                    </Link>

                    <p class="text-2xl hover:cursor-pointer" @click="closeProductModal">&#x2715;</p>
                </div>
            </div>
            <div class="flex">
                <p class="text-[11px] text-[#ffffff99] w-20">Артикул</p>
                <p class="text-[11px] text-[#ffffff]">{{ view.article }}</p>
            </div>
            <div class="flex mt-2">
                <p class="text-[11px] text-[#ffffff99] w-20">Название</p>
                <p class="text-[11px] text-[#ffffff]">{{ view.name }}</p>
            </div>
            <div class="flex mt-2">
                <p class="text-[11px] text-[#ffffff99] w-20">Статус</p>
                <p class="text-[11px] text-[#ffffff]">{{ view.status }}</p>
            </div>
            <div class="flex mt-2">
                <p class="text-[11px] text-[#ffffff99] w-20">Атрибуты</p>
                <div class="flex flex-col"><p class="text-[11px] text-[#ffffff]" v-for="view in view.data">{{ view['name'] }}: {{ view['value'] }}</p></div>
            </div>
      </div>
    </Modal>
</template>
