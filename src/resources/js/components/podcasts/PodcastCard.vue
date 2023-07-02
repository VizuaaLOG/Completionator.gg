<template>
    <RouterLink :to="{ name: 'home' }"
                class="podcast-card text-decoration-none rounded"
    >
        <div class="rounded overflow-hidden mb-2 position-relative">
            <picture>
                <source media="(max-width: 576px)" srcset="https://placehold.it/90/90" />
                <img alt="Podcast Name" class="w-100 h-100" src="https://placehold.it/220/220">
            </picture>

            <div class="position-absolute z-1 top-0 end-0 bg-warning text-dark p-1 small">
                12
            </div>
        </div>

        <div class="px-2">
            <h3 class="fs-6 fw-normal mb-1 text-body">Podcast Name</h3>
            <p class="mb-0 text-muted">Publisher</p>
        </div>
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
