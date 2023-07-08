<template>
    <div class="side-menu-wrapper ps-3 py-3 overflow-y-auto">
        <!-- Example split danger button -->
        <div class="btn-group w-100">
            <button type="button" class="btn btn-primary">Add Game</button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
                    aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Add Collection</a></li>
                <li><a class="dropdown-item" href="#">Add Platform</a></li>
            </ul>
        </div>

        <ul class="list-unstyled d-flex flex-column gap-4 mt-4">
            <li class="d-flex flex-column gap-2">
                <RouterLink :to="{ name: 'home' }"
                            class="menu-link ms-0 text-body text-decoration-none d-flex justify-content-between align-items-center"
                >
                    <font-awesome-icon :icon="faHome"
                                       class="fa-fw me-1" />
                    <strong>Your Dashboard</strong>
                </RouterLink>
            </li>

            <li class="d-flex flex-column gap-1">
                <RouterLink :to="{ name: 'home' }"
                            class="menu-link ms-0 text-body text-decoration-none d-flex justify-content-between align-items-center"
                >
                    <font-awesome-icon :icon="faHome"
                                       class="fa-fw me-1" />

                    <strong class="flex-grow-1">Backlog</strong>

                    <div class="badge text-bg-secondary">23</div>
                </RouterLink>

                <ul class="list-unstyled d-flex flex-column gap-1">
                    <li>
                        <RouterLink :to="{ name: 'favourites' }"
                                    class="menu-link text-body text-decoration-none d-flex justify-content-between align-items-center"
                        >
                            Playing

                            <div class="badge text-bg-secondary">23</div>
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink :to="{ name: 'favourites' }"
                                    class="menu-link text-body text-decoration-none d-flex justify-content-between align-items-center"
                        >
                            Completed

                            <div class="badge text-bg-secondary">23</div>
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink :to="{ name: 'favourites' }"
                                    class="menu-link text-body text-decoration-none d-flex justify-content-between align-items-center"
                        >
                            Retired

                            <div class="badge text-bg-secondary">23</div>
                        </RouterLink>
                    </li>
                </ul>
            </li>

            <li class="d-flex flex-column gap-2">
                <strong>
                    <RouterLink :to="{ name: 'favourites' }"
                                class="menu-link ms-0 text-body text-decoration-none"
                    >
                        <font-awesome-icon :icon="faStar"
                                           class="fa-fw me-1" />
                        Platforms
                    </RouterLink>
                </strong>

                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li>
                        <RouterLink :to="{ name: 'favourites' }"
                                    class="menu-link text-body text-decoration-none"
                        >
                            Gaming Rig
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink :to="{ name: 'favourites' }"
                                    class="menu-link text-body text-decoration-none"
                        >
                            Xbox
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink :to="{ name: 'favourites' }"
                                    class="menu-link text-body text-decoration-none"
                        >
                            Android
                        </RouterLink>
                    </li>
                </ul>
            </li>

            <li class="d-flex flex-column gap-2">
                <strong>
                    <RouterLink :to="{ name: 'categories' }"
                                class="menu-link ms-0 text-body text-decoration-none"
                    >
                        <font-awesome-icon :icon="faLayerGroup"
                                           class="fa-fw me-1" />
                        Collections
                    </RouterLink>
                </strong>

                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li>
                        <RouterLink :to="{ name: 'categories' }"
                                    class="menu-link text-body text-decoration-none"
                        >
                            Perfection
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink :to="{ name: 'categories' }"
                                    class="menu-link text-body text-decoration-none"
                        >
                            Halo
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
