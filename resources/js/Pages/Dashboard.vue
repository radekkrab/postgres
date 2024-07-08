<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import AddProduct from '@/Components/AddProduct.vue';
import ViewProducts from '@/Components/ViewProducts.vue';

defineProps(['products', 'role']);

</script>

<template>
    <Head title="Главная" />

    <div class="flex">
        <div class="left-panel w-1/6 bg-[#374050] hidden lg:block">
            <div class="flex">
                <div class="logo px-6 py-8  bg-white rounded-br-[40px]"><img class="w-24" src="/img/logo.png" alt="logo"></div>
                <p class="text-white font-roboto text-lg px-5 py-3 leading-5">Enterprise<br>Resourse<br>Planning</p>
            </div>
            <p class="text-[#FFFFFF99] font-roboto text-lg mt-6 ml-16 leading-5"> <a href="#">Продукты</a></p>
        </div>
        <div class="right-panel lg:w-5/6">
            <AuthenticatedLayout>
            <div class="flex flex-col lg:flex-row lg:justify-between bg-[#F2F6FA] h-screen">
                <div class="table w-3/4"><ViewProducts /></div>
                <div class="button pr-4 self-end lg:self-auto"><AddProduct /></div>
            </div>
            </AuthenticatedLayout>
        </div>
    </div>

</template>
