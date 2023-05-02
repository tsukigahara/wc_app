<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
const props = defineProps({
    'provinces': Array,
    'regions': Array,
    'client': Object,
})

const form = useForm({
    sign: null,
    address: null,
    city: null,
    province_id: null,
    region_id: null,
    note: null,
    reference_name: null,
    telephone: null,
    email: null,
});

const submit = () => {
    form.post(route('dashboard.clients.delivery_data.store', props.client));
    console.log(form)
};
</script>

<template>
    <Head title="Add delivery data" />

    <AuthenticatedLayout>
        <template #header>
            <div class="d-flex justify-content-between align-items-center">
                <h1>Add delivery data</h1>
                <button onclick="history.back()" class="btn btn-dark ml-auto">
                    Close
                </button>
            </div>
        </template>
        <form class="d-flex px-md-2" @submit.prevent="submit">
            <div class="col">
                <div class="mb-3">
                    <label for="" class="form-label">Insegna</label>
                    <input type="text" name="sign" id="" class="form-control" placeholder="" aria-describedby="helpId"
                        v-model="form.sign">
                    <div v-if="form.errors.sign" class="text-sm text-danger">{{ form.errors.sign }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nome referente</label>
                    <input type="text" name="reference_name" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="form.reference_name">
                    <div v-if="form.errors.reference_name" class="text-sm text-danger">{{ form.errors.reference_name }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Telefono</label>
                    <input type="text" name="telephone" id="" class="form-control" placeholder="" aria-describedby="helpId"
                        v-model="form.telephone">
                    <div v-if="form.errors.telephone" class="text-sm text-danger">{{ form.errors.telephone }}</div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="text" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId"
                        v-model="form.email">
                    <div v-if="form.errors.email" class="text-sm text-danger">{{ form.errors.email }}</div>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Indirizzo</label>
                    <input type="text" name="address" id="" class="form-control" placeholder="" aria-describedby="helpId"
                        v-model="form.address">
                    <div v-if="form.errors.address" class="text-sm text-danger">{{ form.errors.address }}</div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Città</label>
                    <input type="text" name="city" id="" class="form-control" placeholder="" aria-describedby="helpId"
                        v-model="form.city">
                    <div v-if="form.errors.city" class="text-sm text-danger">{{ form.errors.city }}
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-check-label" for="">Province</label>
                    <select class="form-select" name="province_id" v-model="form.province_id">
                        <option selected>Open this select menu</option>
                        <option v-for="province in provinces" :value="province.id">{{ province.name }}</option>
                    </select>
                    <div v-if="form.errors.province_id" class="text-sm text-danger">{{ form.errors.province_id }}
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-check-label" for="">Regione</label>
                    <select class="form-select" name="region_id" v-model="form.region_id">
                        <option selected>Open this select menu</option>
                        <option v-for="region in regions" :value="region.id">{{ region.name }}</option>
                    </select>
                    <div v-if="form.errors.region_id" class="text-sm text-danger">{{ form.errors.region_id }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Note</label>
                    <input type="text" name="note" id="" class="form-control" placeholder="" aria-describedby="helpId"
                        v-model="form.note">
                    <div v-if="form.errors.note" class="text-sm text-danger">{{ form.errors.note }}</div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary me-2">Add</button>
                    <button type="reset" @click="form.reset()" class="btn btn-warning mr-3">Reset</button>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
