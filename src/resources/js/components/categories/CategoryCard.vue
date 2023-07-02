<template>
    <RouterLink :to="{ name: 'home' }"
                class="category-card text-decoration-none p-2 rounded d-flex gap-3 align-items-center"
    >
        <font-awesome-icon :icon="faPodcast" class="text-primary" />

        <div>
            <h3 class="fs-6 fw-normal mb-1 text-body">Category Name</h3>
            <p class="mb-0 text-muted">X Podcasts</p>
        </div>
    </RouterLink>
</template>

<script lang="ts" setup>
    import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
    import {faPodcast} from '@fortawesome/free-solid-svg-icons';
</script>

<style lang="scss" scoped>
    @import "~/bootstrap/scss/bootstrap-utilities";

    .category-card {
        &:hover {
            background-color: $body-tertiary-bg-dark;
        }
    }
</style>
