<template>
    <div>

        <p class="text-3xl text-red-500">Hello Teams !!!</p>

    </div>
</template>


<script setup>

Echo.channel("member")
    .listen(".member.notify", (e) => {
       console.log("Members Have been noified");

    })



</script>
