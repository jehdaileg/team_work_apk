<template>
    <div>
        <h5 class="text-blue-500">Login</h5>

        <form @submit.prevent="form.post('/login')">

           <div v-if="form.hasErrors" class="bg-red-400 text-white underline-offset-1">
               <p>{{ form.errors.email }}</p>

           </div>


            <div class="flex">

                <label for="email">Email:</label>
                <input type="email" class="p-1 rounded text-black" v-model="form.email" />

            </div>

            <div>
                <label for="">Password:</label>
                <input type="password" class="p-1 rounded text-black" v-model="form.password" />
            </div>


            <div class="flex ml-2 items-start p-4">
                <button
                    type="submit"
                    class="rounded px-2 py-2.5 bg-indigo-500 text-white"
                >
                    Connecte-Me
                </button>


            </div>
              <Link class="underline" href="/register"
                    >Do not have an account ? click here to create one</Link
                >
        </form>
    </div>
</template>

<script setup>

import { Link, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    email: '',
    password: ''
});

</script>
