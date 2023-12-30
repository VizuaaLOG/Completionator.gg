<script setup lang="ts">
    import {ref} from 'vue';
    import DatePickerField from '@/components/DatePickerField.vue';
    import {useDate} from 'vuetify';

    const dateAdaptor = useDate();

    const addMode = ref(0);

    const MODE_IGDB = 0;
    const MODE_MANUAL = 1;

    const purchasedDate = ref();
    const releasedDate = ref();
</script>

<template>
    <main>
        <h1 class="mb-2">Add Game</h1>

        <v-btn-toggle
            v-model="addMode"
            divided
            mandatory
            class="mb-8"
        >
            <v-btn
                prepend-icon="mdi-earth"
            >
                Add via IGDB
            </v-btn>

            <v-btn
                prepend-icon="mdi-pencil"
            >
                Add manually
            </v-btn>
        </v-btn-toggle>

        <div v-show="addMode === MODE_IGDB">
            <h2 class="mb-2">Search IGDB</h2>

            <v-text-field
                label="Search IGDB"
                placeholder="Search by name or IGDB id" />
        </div>

        <div v-show="addMode === MODE_MANUAL">
            <h2 class="mb-2">Add Manually</h2>

            <v-form>
                <v-row>
                    <v-col>
                        <v-text-field
                            label="Name"
                            placeholder="Deathloop" />

                        <v-textarea
                            label="Description"
                            placeholder="Description about the game, optional but shows when viewing the details"
                            counter
                            :auto-grow="true" />

                        <date-picker-field
                            v-model="completedDate"
                            label="Completed Date"
                            placeholder="YYYY-MM-DD" />

                        <date-picker-field
                            v-model="releasedDate"
                            label="Released Date"
                            placeholder="YYYY-MM-DD" />
                    </v-col>

                    <v-col>
                        <h3 class="mb-3">Platforms/Storefronts</h3>
                        <v-alert
                            variant="flat"
                            class="mb-3"
                        >
                            You may own a game on multiple platforms and storefronts. You can list all of them here.
                        </v-alert>

                        <v-table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Platform</th>
                                    <th>Storefront</th>
                                    <th>Purchase Date</th>
                                    <th>Price</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td colspan="100%">
                                        <div class="d-flex">
                                            <v-spacer />

                                            <v-btn
                                                prepend-icon="mdi-plus"
                                                variant="flat"
                                                color="blue-darken-1"
                                            >
                                                Add
                                            </v-btn>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </v-table>
                    </v-col>
                </v-row>
            </v-form>
        </div>
    </main>
</template>
