<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    'data': Object,
});
</script>

<template>
    <nav>
        <ul class="pagination">
            <!-- <li class="page-item">
                <Link class="page-link" :class="(data.prev_page_url ? '' : 'disabled')" :href="data.prev_page_url">Previous
                    </Link>
                    </li> -->
            <li class="page-item" v-for="link in data.links">
                <Link class="page-link" :class="(link.active ? 'active' : '') || (link.url ? '' : 'disabled')"
                    :href="(link.url ? link.url : '#')">
                {{ link.label.replace('&laquo;', '').replace('&raquo;', '') }}</Link>
            </li>
            <!-- <li class="page-item">
                                        <Link class="page-link" :class="(data.next_page_url ? '' : 'disabled')" :href="data.next_page_url">Next
                                        </Link>
                                    </li> -->
        </ul>
    </nav>
</template>