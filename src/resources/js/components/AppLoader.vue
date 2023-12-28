<script setup lang="ts">
    import {useGlobalStore} from '@/stores/global';

    const globalStore = useGlobalStore();
</script>

<template>
    <v-dialog
        fullscreen
        persistent
        v-model="globalStore.loading"
    >
        <v-sheet class="d-flex justify-center align-center">
            <v-progress-circular indeterminate />
        </v-sheet>
    </v-dialog>
</template>
