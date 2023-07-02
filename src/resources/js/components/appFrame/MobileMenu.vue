<template>
    <nav class="navbar fixed-bottom bg-body-tertiary">
        <div class="container-fluid">
            <ul class="navbar-nav flex-row justify-content-between flex-grow-1">
                <li class="nav-item">
                    <RouterLink :to="{ name: 'home' }"
                                class="nav-link rounded d-flex flex-column align-items-center"
                    >
                        <font-awesome-icon :icon="faHome"
                                           class="fa-fw" />
                        Home
                    </RouterLink>
                </li>

                <li class="nav-item">
                    <RouterLink :to="{ name: 'favourites' }"
                                class="nav-link rounded d-flex flex-column align-items-center"
                    >
                        <font-awesome-icon :icon="faStar"
                                           class="fa-fw" />
                        Favourites
                    </RouterLink>
                </li>

                <li class="nav-item">
                    <RouterLink :to="{ name: 'library' }"
                                class="nav-link rounded d-flex flex-column align-items-center"
                    >
                        <font-awesome-icon :icon="faPodcast"
                                           class="fa-fw" />
                        Library
                    </RouterLink>
                </li>

                <li class="nav-item">
                    <RouterLink :to="{ name: 'categories' }"
                                class="nav-link rounded d-flex flex-column align-items-center"
                    >
                        <font-awesome-icon :icon="faLayerGroup"
                                           class="fa-fw" />
                        Categories
                    </RouterLink>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script lang="ts" setup>
    import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
    import {faHome, faLayerGroup, faPodcast, faStar} from '@fortawesome/free-solid-svg-icons';
</script>

<style lang="scss" scoped>
    @import "~/bootstrap/scss/bootstrap-utilities";

    .router-link-active {
        @extend .text-white;
    }
</style>
