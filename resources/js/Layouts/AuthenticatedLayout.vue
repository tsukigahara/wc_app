<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="">
        <nav class="navbar navbar-dark navbar-expand-lg sticky-top bg-dark shadow py-4">
            <div class="container">
                <Link class="navbar-brand" href="#">Wagyu Manager</Link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="nav nav-pills flex-column flex-sm-row me-auto">
                        <li class="nav-item flex-sm-fill text-sm-center">
                            <NavLink class="nav-link" :href="route('dashboard')" :active="
                                route().current('dashboard')">Dashboard</NavLink>
                        </li>
                        <li class="nav-item flex-sm-fill text-sm-center">
                            <NavLink class="nav-link " :href="route('dashboard.clients.index')" :active="
                                route().current('dashboard.clients.index')">Clients</NavLink>
                        </li>
                    </ul>
                    <div class="dropdown ">
                        <Link class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        {{ $page.props.auth.user.name }}
                        </Link>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <Link class="dropdown-item" :href="route('profile.edit')"> Profile </Link>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <Link class="dropdown-item" :href="route('logout')" method="post" as="button"> Logout
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <!-- Page Heading -->
            <header class="" v-if="$slots.header">
                <div class="container my-4">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="container bg-white rounded shadow p-3">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
