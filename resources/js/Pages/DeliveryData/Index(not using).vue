<script setup>
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import { watch, ref } from 'vue';
const props = defineProps({
    'delivery_datas': Object,
    'filters': Object,
})

const search = ref(props.filters.search);
const filter = ref(props.filters.filter);

watch([search, filter], ([value, value2]) => {
    router.get('/dashboard/clients/deliverydata', { search: value, filter: value2 }, {
        preserveState: true,
        replace: true,
    })
})

// function remove(client) {
//     if (confirm('Are you sure? This proccess is irreversible.')) {
//         if (confirm('Are you really sure?')) {
//             router.delete(route('dashboard.clients.destroy', client))
//         }
//     }
// }

</script>

<template>
    <Head title="Delivery Data" />

    <AuthenticatedLayout>
        <template #header>
            <h1>Delivery Data</h1>
        </template>
        <!-- buttons -->

        <!-- search -->
        <div class="input-group mb-3">
            <input v-model="search" type="text" class="form-control" placeholder="Search">
        </div>
        <!-- index -->
        <div v-if="delivery_datas.data.length === 0">
            <h3 class="text-center">Nothing here...</h3>
        </div>
        <div v-else class="row row-cols-1 row-cols-md-3 row-cols-xl-4 g-4">
            <div class="col" v-for="delivery_data in delivery_datas.data">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <small class="text-muted">Insegna</small>
                        <h3 class="card-title">
                            {{ delivery_data.sign }}
                        </h3>
                    </div>
                    <ul class="list-group list-group-flush text-bg-light">
                        <li class="list-group-item">
                            <small class="text-muted">Nome referente</small>
                            <div>
                                {{ delivery_data.reference_name }}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Telefono</small>
                            <div>
                                {{ delivery_data.telephone }}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Email</small>
                            <div>
                                {{ delivery_data.email }}
                            </div>
                        </li>
                    <li class="list-group-item">
                            <small class="text-muted">Indirizzo consegna</small>
                            <div>
                                {{ delivery_data.address }}
                            </div>
                    </li>
                    <li class="list-group-item">
                        <small class="text-muted">Provincia</small>
                        <div>
                                {{ delivery_data.province.name }}
                        </div>
                    </li>
                    <li class="list-group-item">
                        <small class="text-muted">Regione</small>
                        <div>
                            {{ delivery_data.region.name }}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Note</small>
                            <div>
                                {{ delivery_data.note }}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Ragione sociale</small>
                            <div>
                                {{ delivery_data.client.ragione_sociale }}
                            </div>
                        </li>
                        <!-- <div class="collapse" :id="'collapse-' + delivery_data.id">
                            </div> -->
                    </ul>
                    <div class="card-footer">
                        <div class="d-grid gap-2 ">
                            <!-- <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                    :data-bs-target="'#collapse-' + delivery_data.id" aria-expanded="false"
                                    :aria-controls="'collapse-' + delivery_data.id">
                                    More
                                </button> -->
                            <!-- <Link class="btn btn-outline-primary" :href="route('dashboard.clients.edit', client)"
                                                                                                        role="button">
                                                                                                    Edit
                                                                                                    </Link>
                                                                                                    <button type="button" class="btn btn-outline-danger" @click="remove(client)">
                                                                                                        Delete
                                                                                                    </button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
