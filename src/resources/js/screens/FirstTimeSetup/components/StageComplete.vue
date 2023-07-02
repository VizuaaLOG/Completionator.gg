<template>
    <div class="card w-25">
        <div class="card-header">
            <h1 class="display-6">All Done!</h1>
            <p class="lead">Your Completionist instance is ready. Login using the button below.</p>
        </div>

        <div class="card-body">
            <div class="text-center">
                <button class="btn btn-primary" @click="$emit('continue')">Let's Go!</button>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
    defineEmits(['continue']);
</script>
