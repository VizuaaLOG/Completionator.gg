<template>
    <div class="side-menu-wrapper p-3 overflow-y-auto">
        <ul class="list-unstyled d-flex flex-column gap-4">
            <li class="d-flex flex-column gap-2">
                <strong>
                    <RouterLink :to="{ name: 'home' }"
                                class="menu-link ms-0 text-body text-decoration-none"
                    >
                        <font-awesome-icon :icon="faHome"
                                           class="fa-fw me-1" />
                        Home
                    </RouterLink>
                </strong>
            </li>

            <li class="d-flex flex-column gap-2">
                <strong>
                    <RouterLink :to="{ name: 'favourites' }"
                                class="menu-link ms-0 text-body text-decoration-none"
                    >
                        <font-awesome-icon :icon="faStar"
                                           class="fa-fw me-1" />
                        Favourites
                    </RouterLink>
                </strong>

                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li>
                        <RouterLink :to="{ name: 'favourites' }"
                                    class="menu-link text-body text-decoration-none"
                        >
                            Podcast One
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink :to="{ name: 'favourites' }"
                                    class="menu-link text-body text-decoration-none"
                        >
                            Podcast One
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink :to="{ name: 'favourites' }"
                                    class="menu-link text-body text-decoration-none"
                        >
                            Podcast One
                        </RouterLink>
                    </li>
                </ul>
            </li>

            <li class="d-flex flex-column gap-2">
                <strong>
                    <RouterLink :to="{ name: 'library' }"
                                class="menu-link ms-0 text-body text-decoration-none"
                    >
                        <font-awesome-icon :icon="faPodcast"
                                           class="fa-fw me-1" />
                        Library
                    </RouterLink>
                </strong>
            </li>

            <li class="d-flex flex-column gap-2">
                <strong>
                    <RouterLink :to="{ name: 'categories' }"
                                class="menu-link ms-0 text-body text-decoration-none"
                    >
                        <font-awesome-icon :icon="faLayerGroup"
                                           class="fa-fw me-1" />
                        Categories
                    </RouterLink>
                </strong>

                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li>
                        <RouterLink :to="{ name: 'categories' }"
                                    class="menu-link text-body text-decoration-none"
                        >
                            Podcast One
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink :to="{ name: 'categories' }"
                                    class="menu-link text-body text-decoration-none"
                        >
                            Podcast One
                        </RouterLink>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script lang="ts" setup>
    import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
    import {faHome, faLayerGroup, faPodcast, faStar} from '@fortawesome/free-solid-svg-icons';
</script>

<style lang="scss" scoped>
    @import "~/bootstrap/scss/bootstrap-utilities";

    .menu-link {
        @extend .rounded, .px-2, .py-1;

        margin-left: 1.8rem;

        &:hover, &.router-link-active {
            background-color: rgba($blue-500, 0.5) !important;
            color: $light-text-emphasis-dark !important;
        }
    }

    .side-menu-wrapper {
        max-height: calc(100vh - 56px);
    }
</style>
