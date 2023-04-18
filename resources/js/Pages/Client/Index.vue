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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clients</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm font-light">
                                <thead class="border-b font-medium">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">Client type</th>
                                        <th scope="col" class="px-6 py-4">Pricing type</th>
                                        <th scope="col" class="px-6 py-4">Ragione sociale</th>
                                        <th scope="col" class="px-6 py-4">Partita iva</th>
                                        <th scope="col" class="px-6 py-4">Codice Fiscale</th>
                                        <th scope="col" class="px-6 py-4">SDI</th>
                                        <th scope="col" class="px-6 py-4">PEC</th>
                                        <th scope="col" class="px-6 py-4">Sede legale</th>
                                        <th scope="col" class="px-6 py-4">City</th>
                                        <th scope="col" class="px-6 py-4">Province</th>
                                        <th scope="col" class="px-6 py-4">Region</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="client in clients">
                                        <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-100">
                                            <td class="whitespace-nowrap px-6 py-4">{{ client.client_type.name }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ client.pricing_type.name }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">test</td>
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ client.partita_iva }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ client.codice_fiscale }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ client.sdi }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ client.pec }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ client.sede_legale }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ client.city }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ client.province.name }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ client.region.name }}
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
