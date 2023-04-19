<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    'clients': Array,
})

</script>

<template>
    <Head title="Clients" />

    <AuthenticatedLayout>
        <template #header>
            <h2>Clients</h2>
        </template>
        <div class="table-responsive">
            <table class="table table-sm table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Ragione sociale</th>
                        <th scope="col">Client type</th>
                        <th scope="col">Pricing type</th>
                        <th scope="col">Partita iva</th>
                        <th scope="col">Codice Fiscale</th>
                        <th scope="col">SDI</th>
                        <th scope="col">PEC</th>
                        <th scope="col">Sede legale</th>
                        <th scope="col">City</th>
                        <th scope="col">Province</th>
                        <th scope="col">Region</th>
                    </tr>
                </thead>
                <tbody class="table-striped ">
                    <template v-for="client in clients">
                        <tr class="">
                            <td class="">{{ client.ragione_sociale }}</td>
                            <td class="">{{ client.client_type.name }}</td>
                            <td class="">{{ client.pricing_type.name }}</td>
                            <td class="">{{ client.partita_iva }}
                            </td>
                            <td class="">{{ client.codice_fiscale }}
                            </td>
                            <td class="">{{ client.sdi }}</td>
                            <td class="">{{ client.pec }}</td>
                            <td class="">{{ client.sede_legale }}
                            </td>
                            <td class="">{{ client.city }}</td>
                            <td class="">{{ client.province.name }}
                            </td>
                            <td class="">{{ client.region.name }}
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
