<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DatePager from '@/Components/Dashboard/DatePager.vue';
import { useToast } from "primevue/usetoast";
import { ref } from "vue";

defineProps({
    today: {
        type: String,
    },
    todayFormatted: {
        type: String,
    },
    yesterday: {
        type: String,
    },
    yesterdayFormatted: {
        type: String,
    },
    tomorrow: {
        type: String,
    },
    tomorrowFormatted: {
        type: String,
    },
});

const visible = ref(false);
const date = ref();
const status = ref();
const description = ref();

const toast = useToast();

const statuses = ref([
    { name: 'Queued', code: 'queued' },
    { name: 'In Progess', code: 'inprogess' },
    { name: 'Done', code: 'done' }
]);

const actionItems = [
    {
        label: 'Update',
        command: () => {
            toast.add({ severity: 'success', summary: 'Update', detail: 'Data Updated', life: 3000 });
        }
    },
    {
        label: 'Delete',
        command: () => {
            this.$toast.add({ severity: 'warn', summary: 'Delete', detail: 'Data Deleted', life: 3000 });
        }
    },
    {
        separator: true
    },
    {
        label: 'Quit',
        command: () => {
            window.location.href = 'https://vuejs.org/';
        }
    }
];

const save = () => {
    toast.add({ severity: 'success', summary: 'Success', detail: 'Data Saved', life: 3000 });
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <Toast />
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">                        
                        <DatePager 
                            :today="today" 
                            :today-formatted="todayFormatted"
                            :yesterday="yesterday" 
                            :yesterday-formatted="yesterdayFormatted"
                            :tomorrow="tomorrow" 
                            :tomorrow-formatted="tomorrowFormatted"
                        />
                    </div>

                    <div class="text-center md:text-right md:pr-6 pb-6">
                        <Button 
                            type="button" 
                            label="New Entry" 
                            icon="pi pi-plus"
                            @click="visible = true"
                        />
                    </div>

                    <table class="w-full md:w-1/2 mx-auto work-log-table">
                        <tbody>
                            <tr>
                                <td>
                                    <Badge value="Queued" severity="info" />
                                </td>
                                <td>
                                    DDX-7936 - Case onhold missing required files
                                </td>
                                <td class="actions">
                                    <SplitButton 
                                        label="Save" 
                                        :model="actionItems" 
                                        @click="save"
                                        size="small"
                                    ></SplitButton>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <Badge value="In Progress" severity="warn" />
                                </td>
                                <td>
                                    DDX-7936 - Case onhold missing required files
                                </td>
                                <td class="actions">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <Badge value="Done" severity="success" />
                                </td>
                                <td>
                                    DDX-7936 - Case onhold missing required files
                                </td>
                                <td class="actions">
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <Dialog v-model:visible="visible" modal header="New Task" :style="{ width: '35rem' }">

            <span class="text-surface-500 dark:text-surface-400 block mb-8">Enter task information.</span>
            
            <div class="flex items-center gap-4 mb-4">
                <label for="username" class="font-semibold w-24">Date</label>
                <DatePicker v-model="date" class="flex-auto" placeholder="Select a date" />
            </div>

            <div class="flex items-center gap-4 mb-4">
                <label for="email" class="font-semibold w-24">Status</label>
            
                <Select 
                    v-model="status" 
                    :options="statuses"
                    optionLabel="name" 
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
                />
            </div>
            
            <div class="text-right mb-8">255 characters remaining</div>

            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                <Button type="button" label="Save" @click="visible = false"></Button>
            </div>
        </Dialog>
    </AuthenticatedLayout>
</template>

<style scoped>

.work-log-table {
    margin-bottom: 20px;
}

.work-log-table tbody tr {
    border-bottom: 1px solid #e5e7eb;
}

.work-log-table tbody td {
    padding: 5px;
}

.work-log-table .actions button {
    width: 30px;
    height: 30px;
}

.work-log-table .actions button span {
    font-size: 0.75rem;
}

</style>
