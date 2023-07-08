<template>
    <RouterLink :to="{ name: 'games.show', params: {id: 1} }"
                class="podcast-card text-decoration-none rounded"
    >
        <div class="rounded overflow-hidden mb-2">
            <picture>
                <source media="(max-width: 576px)" srcset="https://placehold.it/90x180" />
                <img alt="Podcast Name" class="w-100" src="https://placehold.it/160x240">
            </picture>
        </div>

        <h3 class="fs-6 fw-normal mb-1 text-body">Game Name</h3>
        <p class="mb-0 text-muted">Platform</p>
    </RouterLink>
</template>

<style lang="scss" scoped>
    @import "~/bootstrap/scss/bootstrap-utilities";

    .podcast-card {
        &:hover {
            background-color: $body-tertiary-bg-dark;
        }
    }
</style>
