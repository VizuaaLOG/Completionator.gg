<template>
    <nav v-if="authStore.isAuthenticated()"
         class="navbar navbar-expand fixed-top bg-body-tertiary"
    >
        <div class="container-fluid">
            <RouterLink :to="{ name: 'home' }"
                        class="navbar-brand"
            >
                Completionist
            </RouterLink>

            <div class="d-flex flex-grow-1 align-items-center gap-3 justify-content-end">
                <div class="d-none d-md-flex flex-grow-1">
                    <TopBarSearchForm />
                </div>

                <ul class="navbar-nav">
                    <li class="nav-item d-md-none">
                        <a :class="{
                               'active': mobileSearchVisible,
                           }"
                           class="nav-link"
                           role="button"
                           @click="mobileSearchVisible = !mobileSearchVisible"
                        >
                            <font-awesome-icon :icon="faSearch" aria-label="Search" />
                            <span class="visually-hidden">Search</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a aria-expanded="false"
                           class="nav-link dropdown-toggle"
                           data-bs-toggle="dropdown"
                           role="button"
                        >
                            {{ authStore.user.name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Account Settings</a></li>
                            <li><a class="dropdown-item" href="#">Admin Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <LogoutButton class="dropdown-item" />
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div v-show="mobileSearchVisible"
         class="bg-body-tertiary py-2 d-md-none fixed-top"
         style="top: 56px;"
    >
        <div class="container-fluid">
            <TopBarSearchForm />
        </div>
    </div>
</template>

<script lang="ts" setup>
    import LogoutButton from '@/components/LogoutButton.vue';
    import {useAuthStore} from '@/stores/auth';
    import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
    import {faSearch} from '@fortawesome/free-solid-svg-icons';
    import {ref} from 'vue';
    import TopBarSearchForm from '@/components/appFrame/TopBarSearchForm.vue';

    const authStore = useAuthStore();
    const mobileSearchVisible = ref(false);
</script>
