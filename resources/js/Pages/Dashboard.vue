<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

defineProps(["products"]);

const showAddProductModal = ref(false);

const addProductModal = () => {
    showAddProductModal.value = true;
}

const closeModal = () => {
    showAddProductModal.value = false;
}

const form = useForm({
  article: null,
  name: null,
  status: null,
  colorSize: [{ name: '', value: '' }],

})

const addField = () => {
      this.form.colorSize.push({ name: '', value: '' });
    }


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
                <PrimaryButton @click="addProductModal" class="">Добавить продукт</PrimaryButton>
                <Modal :show="showAddProductModal" @close="closeModal">
                    <div class="p-6">
                        <PrimaryButton @click="closeModal">X</PrimaryButton>
                        <form @submit.prevent="form.post('/product')">
                            <!-- article -->
                            <input type="text" v-model="form.article">
                            <div v-if="form.errors.article">{{ form.errors.article }}</div>
                            <!-- name -->
                            <input type="text" v-model="form.name">
                            <div v-if="form.errors.name">{{ form.errors.name }}</div>
                            <!-- status -->
                            <input type="text" v-model="form.status">
                            <div v-if="form.errors.status">{{ form.errors.status }}</div>
                             <!-- atributes -->
                              <div v-for="(field, index) in form.colorSize" :key="index">
                                <input type="text" v-model="field.name">
                                <input type="text" v-model="field.value">
                                </div>
                               <button @click="addField">Добавить атрибуты</button> 
                            <!-- submit -->
                            <button type="submit" :disabled="form.processing">Добавить</button>
                        </form>
                    </div>   
                </Modal>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
