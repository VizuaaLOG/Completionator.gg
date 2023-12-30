<script setup lang="ts">
    import {reactive, ref} from 'vue';
    import DatePickerField from '@/components/DatePickerField.vue';
    import {isObject} from 'lodash';
    import PlatformStorefrontTable from '@/components/PlatformStorefrontTable.vue';

    const addMode = ref(0);

    const MODE_IGDB = 0;
    const MODE_MANUAL = 1;

    const releasedDate = ref();

    const test = ref();
    const platforms = ref([]);

    // TODO: Hook up the form properly, save to backend, test
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
                <v-combobox
                    v-model="test"
                    label="Name"
                    placeholder="Search for an existing game or enter the name of a new one"
                    :clearable="true"
                    :items="[
                    {
                        title: 'Deathloop',
                        value: 1,
                    },
                    {
                        title: 'Cod',
                        value: 2,
                    }
                ]" />

                <v-select
                    label="Status"
                    :items="[
                        {
                            title: 'Not Started',
                            value: 1,
                        },
                        {
                            title: 'Playing',
                            value: 2,
                        },
                        {
                            title: 'Retired',
                            value: 3,
                        },
                        {
                            title: 'Completed',
                            value: 4,
                        },
                    ]" />

                <date-picker-field
                    :clearable="true"
                    v-model="completedDate"
                    label="Completed Date"
                    placeholder="YYYY-MM-DD" />

                <platform-storefront-table v-model="platforms" />

                <v-expansion-panels v-if="!isObject(test)">
                    <v-expansion-panel title="Game Metadata">
                        <v-expansion-panel-text>
                            <v-alert
                                type="info"
                                variant="flat"
                                class="mb-3"
                            >
                                This data is optional and can be populated using the IGDB later if that integration is configured.
                            </v-alert>

                            <v-text-field
                                label="IGDB ID" />

                            <v-textarea
                                label="Description"
                                placeholder="Description about the game, optional but shows when viewing the details"
                                counter
                                :auto-grow="true" />

                            <date-picker-field
                                v-model="releasedDate"
                                label="Released Date"
                                placeholder="YYYY-MM-DD" />


                            <v-combobox
                                label="Platforms"
                                :items="[
                                {
                                    title: 'Xbox',
                                    value: 1,
                                },
                                {
                                    title: 'PC',
                                    value: 2,
                                }
                            ]" />

                            <v-combobox
                                label="Genres"
                                :items="[
                                    {
                                        title: 'Action',
                                        value: 1,
                                    },
                                    {
                                        title: 'Shooter',
                                        value: 2,
                                    }
                                ]" />

                            <h3 class="mb-3">Companies</h3>
                            <v-table class="mb-3">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Company</th>
                                        <th>Type</th>
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
                        </v-expansion-panel-text>
                    </v-expansion-panel>
                </v-expansion-panels>
            </v-form>
        </div>
    </main>
</template>
