<script setup>
    import { ref } from 'vue';
    import Modal from '@/Components/Modal.vue';
    import { useForm } from '@inertiajs/vue3';


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
  status: 'Доступен',
  colorSize: [],

})

const addField = () => {
      form.colorSize.push({ name: '', value: '' });
    }

const delField = (index) => {
    form.colorSize.splice(index);
}


</script>

<template>
    <button type="button" class="text-[11px] text-white mt-5 bg-[#0FC5FF] py-2 px-12 rounded-md" @click="addProductModal">Добавить</button>
    <Modal :show="showAddProductModal" @close="closeModal" >
        <div class="p-6 bg-[#374050] text-white font-roboto">
            <div class="flex justify-between">
                <div class="h2 font-bold text-[20px]">Добавить продукт</div>
                <p class="text-2xl hover:cursor-pointer" @click="closeModal">&#x2715;</p>
            </div>
            
            <form class="flex flex-col items-start" @submit.prevent="form.post('/product', { onSuccess: () => form.reset() & closeModal() })">
                <!-- article -->
                <label class="text-[9px] mt-5 mb-1" for="article">Артикул</label>
                <input class="w-4/5 h-8 rounded-md text-black text-[11px]" id="article" type="text" v-model="form.article">
                <div v-if="form.errors.article">{{ form.errors.article }}</div>
                <!-- name -->
                <label class="text-[9px] mt-4 mb-1" for="name">Название</label>
                <input class="w-4/5 h-8 rounded-md text-black text-[11px]" id="name" type="text" v-model="form.name">
                <div v-if="form.errors.name">{{ form.errors.name }}</div>
                <!-- status -->
                <label class="text-[9px] mt-4 mb-1" for="status">Статус</label>
                <select class="w-4/5 h-9 rounded-md text-black text-[11px]" name="status" id="status" v-model="form.status" >
                    <option style="width: 80%; height: 2.25rem; border-radius: 0.375rem;"  value="Доступен" selected>Доступен</option>
                    <option style="width: 80%; height: 2.25rem; border-radius: 0.375rem;" value="Не доступен">Не доступен</option>
                </select>
                <div v-if="form.errors.status">{{ form.errors.status }}</div>
                 <!-- atributes -->
                <h3 class="font-bold text-[14px] mt-3 mb-3">Атрибуты</h3>
                  <div class="flex gap-3" v-for="(field, index) in form.colorSize" :key="index">
                    <div class="mb-2">
                        <label class="text-[9px] mt-6 mb-1" for="{{ field }}">Название</label>
                        <input class="block w-56 h-8 rounded-md text-black text-[11px]" id="{{ field }}" type="text" v-model="field.name">
                    </div>
                    <div>
                        <label class="text-[9px] mt-6 mb-1" for="{{ index }}">Значение</label>
                        <input class="block w-56 h-8 rounded-md text-black text-[11px]" id="{{ index }}" type="text" v-model="field.value">
                    </div>
                    <img class="self-center mt-3" src="/img/recycle.png" @click="delField(index)"></img>
                    </div>
                   <button class="mt-3 text-[9px] text-[#0FC5FF] border-b border-dashed border-[#0FC5FF]" type="button" @click="addField">+ Добавить атрибут</button> 
                <!-- submit -->
                <button class="text-[11px] mt-5 bg-[#0FC5FF] py-2 px-12 rounded-md" type="submit" :disabled="form.processing">Добавить</button>
            </form>
        </div>   
    </Modal>
</template>
