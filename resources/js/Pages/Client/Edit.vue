<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
const props = defineProps({
    'client_types': Array,
    'pricing_types': Array,
    'provinces': Array,
    'regions': Array,
    'client': Object,
})

const form = useForm({
    ragione_sociale: props.client.ragione_sociale,
    partita_iva: props.client.partita_iva,
    client_type_id: props.client.client_type_id,
    pricing_type_id: props.client.pricing_type_id,
    codice_fiscale: props.client.codice_fiscale,
    sdi: props.client.sdi,
    pec: props.client.pec,
    sede_legale: props.client.sede_legale,
    city: props.client.city,
    province_id: props.client.province_id,
    region_id: props.client.region_id,
});

const submit = () => {
    form.post(route('dashboard.clients.update', props.client));
    console.log(form)
};
</script>

<template>
    <Head title="Clients" />

    <AuthenticatedLayout>
        <template #header>
            <h1>Edit client</h1>
        </template>
        <form class="d-flex px-md-2" @submit.prevent="submit">
            <div class="col">
                <div class="mb-3">
                    <label for="" class="form-label">Ragione sociale</label>
                    <input type="text" name="ragione_sociale" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="form.ragione_sociale">
                    <div v-if="form.errors.ragione_sociale" class="text-sm text-danger">{{ form.errors.ragione_sociale }}
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-check-label" for="">Pricing type</label>
                    <select class="form-select" name="pricing_type_id" v-model="form.pricing_type_id">
                        <option selected>Open this select menu</option>
                        <option v-for="pricing_type in pricing_types" :value="pricing_type.id">{{ pricing_type.name }}
                        </option>
                    </select>
                    <div v-if="form.errors.pricing_type_id" class="text-sm text-danger">{{ form.errors.pricing_type_id }}
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-check-label" for="">Client type</label>
                    <select class="form-select" name="client_type_id" v-model="form.client_type_id">
                        <option selected>Open this select menu</option>
                        <option v-for="client_type in client_types" :value="client_type.id">{{ client_type.name }}</option>
                    </select>
                    <div v-if="form.errors.client_type_id" class="text-sm text-danger">{{ form.errors.client_type_id }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Partita iva</label>
                    <input type="text" name="partita_iva" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="form.partita_iva" maxlength="11">
                    <div v-if="form.errors.partita_iva" class="text-sm text-danger">{{ form.errors.partita_iva }}</div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Codice fiscale</label>
                    <input type="text" name="codice_fiscale" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="form.codice_fiscale" maxlength="16">
                    <div v-if="form.errors.codice_fiscale" class="text-sm text-danger">{{ form.errors.codice_fiscale }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">SDI</label>
                    <input type="text" name="sdi" id="" class="form-control" placeholder="" aria-describedby="helpId"
                        v-model="form.sdi" maxlength="7">
                    <div v-if="form.errors.sdi" class="text-sm text-danger">{{ form.errors.sdi }}</div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">PEC</label>
                    <input type="text" name="pec" id="" class="form-control" placeholder="" aria-describedby="helpId"
                        v-model="form.pec">
                    <div v-if="form.errors.pec" class="text-sm text-danger">{{ form.errors.pec }}</div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Sede legale</label>
                    <input type="text" name="sede_legale" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="form.sede_legale">
                    <div v-if="form.errors.sede_legale" class="text-sm text-danger">{{ form.errors.sede_legale }}</div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Città</label>
                    <input type="text" name="city" id="" class="form-control" placeholder="" aria-describedby="helpId"
                        v-model="form.city">
                    <div v-if="form.errors.city" class="text-sm text-danger">{{ form.errors.city }}</div>
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
                    <label class="form-check-label" for="">Region</label>
                    <select class="form-select" name="region_id" v-model="form.region_id">
                        <option selected>Open this select menu</option>
                        <option v-for="region in regions" :value="region.id">{{ region.name }}</option>
                    </select>
                    <div v-if="form.errors.region_id" class="text-sm text-danger">{{ form.errors.region_id }}
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary mr-3">Update</button>
                    <button type="reset" @click="form.reset()" class="btn btn-warning mr-3">Reset</button>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
