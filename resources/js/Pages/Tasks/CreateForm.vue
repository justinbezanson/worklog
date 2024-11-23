<template>
    <Dialog v-model:visible="dialogVisible" modal header="New Task" :style="{ width: '35rem' }">
        <form @submit.prevent="save">
            <span class="text-surface-500 dark:text-surface-400 block mb-8">Enter task information.</span>
            
            <div class="flex items-center gap-4 mb-4">
                <label for="username" class="font-semibold w-24">Date</label>
                <DatePicker 
                    v-model="form.task_date" 
                    class="flex-auto" 
                    placeholder="Select a date"
                    dateFormat="yy-mm-dd"
                />
            </div>

            <div class="flex items-center gap-4 mb-4">
                <label for="email" class="font-semibold w-24">Status</label>
            
                <Select 
                    v-model="form.status" 
                    :options="statuses"
                    optionLabel="name"
                    optionValue="code"
                    placeholder="Select a Status" 
                    class="flex-auto" 
                />
            </div>

            <div class="flex flex-wrap items-center gap-4 mb-1">
                <label for="email" class="font-semibold w-24">Description</label>
                <InputText  
                    class="flex-auto" 
                    autocomplete="off"
                    placeholder="Task description"
                    maxlength="255"
                    v-model="form.description"
                />
            </div>
            
            <div class="text-right mb-8">255 characters remaining</div>

            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="$emit('create-form:close')"></Button>
                <Button type="submit" label="Save" @click="$emit('create-form:save', form)"></Button>
            </div>
        </form>
    </Dialog>
</template>

<script setup>
import { ref, reactive, onMounted, watch } from "vue";

const props = defineProps({
    visible: {
        type: Boolean,
    },
    date: {
        type: Date,
    }
});

const dialogVisible = ref(false);

onMounted(() => {
    dialogVisible.value = props.visible;
});

watch(() => props.visible, (newValue) => {
    dialogVisible.value = newValue;
});

const form = reactive({
    task_date: props.date,
    status: null,
    description: null,
});

const statuses = ref([
    { name: 'Queued', code: 'queued' },
    { name: 'In Progess', code: 'inprogress' },
    { name: 'Done', code: 'done' }
]);

</script>