<template>
    <div class="position-relative">
        <picture>
            <source media="(max-width: 576px)" srcset="https://placehold.it/800x400" />
            <img alt="Podcast Name" class="w-100" src="https://placehold.it/1200x400">
        </picture>

        <div class="bg-overlay position-absolute top-0 start-0 w-100 h-100"></div>
    </div>

    <div class="ms-5">
        <div class="row position-relative z-1">
            <div class="col-4 col-lg-3 col-xxl-2">
                <div class="cover-artwork rounded overflow-hidden">
                    <picture>
                        <source media="(max-width: 576px)" srcset="https://placehold.it/90x180" />
                        <img alt="Podcast Name" class="w-100" src="https://placehold.it/160x240">
                    </picture>
                </div>

                <div class="text-center mt-3">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Mark Completed</button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Backlog</a></li>
                            <li><a class="dropdown-item" href="#">Retire</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Edit</a></li>
                            <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="list-group mt-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Release Date</strong>
                        12/12/2022
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Genre</strong>
                        Adventure, Shooter
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Developer</strong>
                        Arkane Studios
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Publisher</strong>
                        Bethesda Softworks
                    </li>
                </ul>
            </div>

            <div class="text-break col-8 col-lg-9 col-xxl-10">
                <h1 class="display-2 mb-0">Deathloop</h1>
                <div class="d-flex gap-2 mb-2">
                    <span class="badge bg-info">Playing</span>
                    <span class="badge bg-light text-dark">Bought 12/12/2022</span>
                    <span class="badge bg-light text-dark">Steam</span>
                </div>
                <p class="lead">Deathloop transports players to the lawless island of Blackreef in an eternal struggle between two extraordinary assassins. Explore stunning environments and meticulously designed levels in an immersive gameplay experience that lets you approach every situation any way you like. Hunt down targets all over the island in an effort to put an end to the cycle once and for all, and remember, if at first you don’t succeed… die, die again.</p>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
    defineProps({
        id: {
            required: true,
        }
    })
</script>

<style lang="scss" scoped>
    .cover-artwork {
        margin-top: -200px;
    }
</style>
