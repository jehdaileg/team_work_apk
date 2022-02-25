<template>
    <div>

        <div class="flex justify-between items-center">
                    <p class="text-3xl text-red-500">Hello Teams !!!</p>

    <div class="text-xs space-y-px pt-1">
        <p>{{ user.name }}</p>
        <p>{{ user.lastname }}</p>

        <Link href="/logout" as="button" method="post" class="p-1 bg-black text-white">Logout</Link>


    </div>

        </div>


        <div class=" rounded-lg">

            <form @submit.prevent="form.post('/todo')">
                <label for="title">Title:</label>
                <input type="text" class="text-black bg-indigo-300 px-4 py-2 shadow-sm" v-model="form.title" />
                <button type="submit" class="rounded p-2 bg-blue-500 text-white">Save</button>
            </form>

        </div>

        <div v-if="todos.length">
            <ul>
                <li v-for="todo in todos" :key="todo.id">{{ todo.title }}</li>
            </ul>
        </div>

    </div>
</template>


<script setup>

import {ref} from "vue";

import { Link, useForm, usePage } from "@inertiajs/inertia-vue3";

const {
    auth: { user },

} = usePage().props.value;



const props = defineProps({
    todos: Array,

});

const todos = ref(props.todos)
const form = useForm({
    title: '',
});


Echo.channel("member")
    .listen(".member.notify", (e) => {
      // console.log("Members Have been noified");
        console.log(e.todo);
    })



</script>
