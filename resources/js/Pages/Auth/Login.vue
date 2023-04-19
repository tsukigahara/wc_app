<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <section class="vh-100 bg-light">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white rounded shadow-lg">
                            <div class="card-body p-3 p-md-5">
                                <div class="mb-5 mt-4">
                                    <form @submit.prevent="submit">

                                        <h2 class="fw-bold mb-2 text-uppercase">Wagyu Manager</h2>
                                        <p class=" mb-5">Enter your login and password</p>

                                        <div class="form-floating mb-3 text-black">
                                            <input type="email" class="form-control"
                                                :class="form.errors.email ? 'is-invalid' : ''" id="floatingInput"
                                                placeholder="name@example.com" v-model="form.email" autofocus
                                                autocomplete="username">
                                            <label for="floatingInput">Email address</label>
                                            <small v-if="form.errors.email" class="text-sm text-white">{{ form.errors.email
                                            }}</small>
                                        </div>
                                        <div class="form-floating mb-3 text-black">
                                            <input type="password" class="form-control"
                                                :class="form.errors.password ? 'is-invalid' : ''" id="floatingPassword"
                                                placeholder="Password" v-model="form.password">
                                            <label for="floatingPassword">Password</label>
                                            <small v-if="form.errors.password" class="text-sm text-white">{{
                                                form.errors.password
                                            }}</small>
                                        </div>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                :checked="form.remember" id="remember">
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>

                                        <p class="small mb-5 pb-lg-2">
                                            <Link v-if="canResetPassword" :href="route('password.request')"
                                                class="text-white">
                                            Forgot your password?
                                            </Link>
                                        </p>

                                        <button class="btn btn-light btn-lg px-5" type="submit"
                                            :disabled="form.processing">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>
