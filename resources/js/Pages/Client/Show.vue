<script setup>
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import { watch, ref } from 'vue';
const props = defineProps({
    'client': Object,
})

function remove(client) {
    if (confirm('Are you sure? This proccess is irreversible.')) {
        if (confirm('Are you really sure?')) {
            router.delete(route('dashboard.clients.destroy', client))
        }
    }
}
</script>

<template>
    <Head title="Clients" />

    <AuthenticatedLayout>
        <template #header>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Ragione sociale</small>
                    <h1>{{ client.ragione_sociale }}</h1>
                </div>
                <Link :href="route('dashboard.clients.index')" class="btn btn-dark ml-auto" as="button">Close</Link>
                <!-- <button onclick="history.back()" class="btn btn-dark ml-auto">
                            Close
                        </button> -->
            </div>
        </template>
        <!-- index -->
        <div class="card shadow-sm mb-4">
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
            </ul>
            <div class="card-footer">
                <!-- buttons -->
                <div class="d-grid gap-2 ">
                    <Link class="btn btn-primary" :href="route('dashboard.clients.edit', client)" as="button">
                    Edit
                    </Link>
                    <button type="button" class="btn btn-danger" @click="remove(client)">
                        Delete
                    </button>
                </div>
            </div>
        </div>
        <!-- DELIVERY DATA SECTIONS -->
        <div class="my-5">
            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                <h2>Delivery data</h2>
                <Link class="btn btn-primary btn-lg mb-3" :href="route('dashboard.clients.delivery_data.create', client)"
                    role="button">
                Add delivery data
                </Link>
            </div>
            <div class="row row-cols-1 row-cols-md-3 row-cols-xl-4 g-4">
                <div class="col" v-for="deliveryData in client.delivery_data">
                    <!-- card -->
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <small class="text-muted">Insegna</small>
                            <h3 class="card-title">
                                {{ deliveryData.sign }}
                            </h3>
                        </div>
                        <ul class="list-group list-group-flush text-bg-light">
                            <li class="list-group-item">
                                <small class="text-muted">Nome referente</small>
                                <div>
                                    {{ deliveryData.reference_name }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <small class="text-muted">Telefono</small>
                                <div>
                                    {{ deliveryData.telephone }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <small class="text-muted">Email</small>
                                <div>
                                    {{ deliveryData.email }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <small class="text-muted">Indirizzo consegna</small>
                                <div>
                                    {{ deliveryData.address }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <small class="text-muted">Provincia</small>
                                <div>
                                    {{ deliveryData.province.name }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <small class="text-muted">Regione</small>
                                <div>
                                    {{ deliveryData.region.name }}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <small class="text-muted">Note</small>
                                <div>
                                    {{ deliveryData.note }}
                                </div>
                            </li>
                        </ul>
                        <div class="card-footer">
                            <Link class="btn btn-primary"
                                :href="route('dashboard.clients.delivery_data.edit', [client, deliveryData])">edit</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
