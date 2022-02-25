<template>
    <div>
        <h4 class="font-display text-4xl font-bold mb-4">
            Member Registration
        </h4>

        <form @submit.prevent="registerUser">

            <div v-if="errors" class="bg-red-400 text-white">
                <ul>
                    <li v-for="error in errors" :key="error">{{ error }}</li>
                </ul>
            </div>
            <div class="flex space-x-2 mb-2">
                <label for="name">Name:</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Enter your name..."
                    class="p-1 border-indigo-300 rounded"
                    v-model="form.name"
                />
            </div>

            <div class="flex space-x-2 mb-2">
                <label for="lastname">LastName:</label>
                <input
                    type="text"
                    name="lastname"
                    id="lastname"
                    v-model="form.lastname"
                    placeholder="Enter your lastname..."
                    class="p-1 border-indigo-300 rounded"
                />
            </div>

            <div class="flex space-x-2">
                <label for="name">Email:</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    v-model="form.email"
                    placeholder="Enter your email..."
                    class="p-1 border-indigo-300 rounded"
                />
            </div>

            <div class="flex space-x-2">
                <label for="name">Password:</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    v-model="form.password"
                    placeholder="Tap your password..."
                    class="p-1 border-indigo-300 rounded"
                />
            </div>

            <div class="flex space-x-2">
                <label for="name">Confirm Password:</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    placeholder="Confirm your password..."
                    class="p-1 border-indigo-300 rounded"
                />
            </div>

            <div class="flex space-x-2">
                <label for="name">Team:</label>
                <select name="team_id" id="team_id" v-model="form.team_id">
                    <option v-for="team in teams" :key="team.id" :value="team.id">{{ team.name }}</option>
                </select>
            </div>

            <div class="flex ml-2 items-start p-4">
                <button
                    type="submit"
                    class="rounded px-2 py-2.5 bg-indigo-500 text-white"
                >
                    Register Me
                </button>


            </div>
              <a class="underline" href=""
                    >Do not have an account ? click here to create one</a
                >
        </form>
    </div>
</template>

<script setup>

import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";

const props = defineProps({
    teams : Array,
    errors: Array,
});


const teams = ref(props.teams)
const errors = ref(props.errors)

const form = {
    name: null,
    lastname: null,
    email: null,
    password: null,
    password_confirmation: null,
    team_id: null

};

const registerUser = () => {
    Inertia.post('/register', form, {

        onStart: () => console.log('Attempting request'),
        onFinish: () => console.log('Request done')
    })
}

</script>
