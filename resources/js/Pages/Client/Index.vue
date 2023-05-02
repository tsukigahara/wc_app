<script setup>
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import { watch, ref } from 'vue';
const props = defineProps({
    'clients': Object,
    'filters': Object,
})

const search = ref(props.filters.search);
const filter = ref(props.filters.filter);

watch([search, filter], ([value, value2]) => {
    router.get('/dashboard/clients', { search: value, filter: value2 }, {
        preserveState: true,
        replace: true,
    })
})

</script>

<template>
    <Head title="Clients" />

    <AuthenticatedLayout>
        <template #header>
            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                <h1>Clients</h1>
                <Link class="btn btn-primary btn-lg mb-3" :href="route('dashboard.clients.create')" role="button">Add client
                </Link>
            </div>
        </template>
        <!-- buttons -->
        <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <Link class="btn btn-primary btn-lg mb-3" :href="route('dashboard.clients.create')" role="button">Add client
                </Link>
            </div> -->
        <!-- search -->
        <div class="input-group mb-3">
            <input v-model="search" type="text" class="form-control" placeholder="Search">
        </div>
        <!-- index -->
        <div v-if="clients.data.length === 0">
            <h3 class="text-center">Nothing here...</h3>
        </div>
        <div v-else class="row row-cols-1 row-cols-md-3 row-cols-xl-4 g-4">
            <div class="col" v-for="client in clients.data">
                <div class="card h-100 shadow-sm">
                    <div class="card-header">
                        <small class="text-muted">Ragione sociale</small>
                        <h3 class="card-title">
                            {{ client.ragione_sociale }}
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush text-bg-light">
                            <li class="list-group-item">
                                <small class="text-muted">Tipologia</small>
                                <div>
                                    {{ client.client_type.name }}
                                </div>
                                <span class="badge rounded-pill text-bg-primary">prezzo: {{ client.pricing_type.name
                                }}</span>
                            </li>
                            <li class="list-group-item">
                                <small class="text-muted">Partita iva</small>
                                <div>
                                    {{ client.partita_iva }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <small class="text-muted">Insegne</small>
                                <h5 v-for="delivery_data in client.delivery_data">
                                    <span class="badge badge-lg text-bg-secondary">
                                        {{ delivery_data.sign }}
                                    </span>
                                </h5>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2 ">
                            <Link class="btn btn-outline-primary" :href="route('dashboard.clients.show', client)"
                                role="button">
                            More
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
