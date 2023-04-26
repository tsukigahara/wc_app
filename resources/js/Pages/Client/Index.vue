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
            <h1>Clients</h1>
        </template>
        <!-- buttons -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <Link class="btn btn-primary btn-lg mb-3" :href="route('dashboard.clients.create')" role="button">Add client
            </Link>
        </div>
        <!-- filter -->
        <div class="input-group mb-3">
            <span class="input-group-text">Filter by</span>
            <select class="form-select flex-shrink-1" id="inputGroupSelect01" v-model="filter">
                <option value="ragione_sociale">Ragione sociale</option>
                <option value="partita_iva">Partita iva</option>
                <option value="codice_fiscale">Codice fiscale</option>
                <option value="sdi">SDI</option>
                <option value="pec">PEC</option>
                <option value="sede_legale">Sede legale</option>
                <option value="city">Città</option>
            </select>
        </div>
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
                <div class="card shadow-sm">
                    <div class="card-header">
                        <small class="text-muted">Ragione sociale</small>
                        <h3 class="card-title">
                            {{ client.ragione_sociale }}
                        </h3>

                    </div>

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
                            <small class="text-muted">Codice fiscale</small>
                            <div>
                                {{ client.codice_fiscale }}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">SDI</small>
                            <div>
                                {{ client.sdi }}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">PEC</small>
                            <div>
                                {{ client.pec }}
                            </div>
                        </li>
                        <div class="collapse" :id="'collapse-' + client.id">
                            <li class="list-group-item">
                                <small class="text-muted">Sede legale</small>
                                <div>
                                    {{ client.sede_legale }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <small class="text-muted">Città</small>
                                <div>
                                    {{ client.city }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <small class="text-muted">Provincia</small>
                                <div>
                                    {{ client.province.name }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <small class="text-muted">Regione</small>
                                <div>
                                    {{ client.region.name }}
                                </div>
                            </li>
                        </div>
                    </ul>
                    <div class="card-footer">
                        <div class="d-grid gap-2 ">
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                :data-bs-target="'#collapse-' + client.id" aria-expanded="false"
                                :aria-controls="'collapse-' + client.id">
                                More
                            </button>
                            <Link class="btn btn-outline-primary" :href="route('dashboard.clients.edit', client)"
                                role="button">
                            Edit
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
