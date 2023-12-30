<script setup lang="ts">
    import {ref} from 'vue';
    import {useField, useForm} from 'vee-validate';
    import {cloneDeep} from 'lodash';
    import DatePickerField from '@/components/DatePickerField.vue';

    const props = defineProps({
        modelValue: {
            type: Array<{
                platform: {
                    title: string,
                    value: number,
                },
                storefront: {
                    title: string,
                    value: number,
                },
                purchase_date: string,
                price: number,
            }>,
            default: [],
        },
    });

    const emit = defineEmits([
        'update:modelValue',
    ]);

    const showAddModal = ref(false);

    const { handleSubmit, resetForm } = useForm();

    const platform = useField('platform');
    const storefront = useField('storefront');
    const purchase_date = useField('purchase_date');
    const price = useField('price');

    const submit = handleSubmit(async (values) => {
        const itemsCopy = cloneDeep(props.modelValue);
        itemsCopy.push({
            platform: platform.value.value,
            storefront: storefront.value.value,
            purchase_date: purchase_date.value.value,
            price: price.value.value,
        });

        emit('update:modelValue', itemsCopy);

        resetForm();

        showAddModal.value = false;
    });
</script>

<template>
    <h3 class="mb-3">Platforms/Storefronts</h3>
        <v-alert
            variant="flat"
            class="mb-3"
        >
            You may own a game on multiple platforms and storefronts. You can list all of them here.
        </v-alert>

        <v-table class="mb-3">
            <thead>
                <tr>
                    <th>Platform</th>
                    <th>Storefront</th>
                    <th>Purchase Date</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="item in modelValue">
                    <td>{{ item.platform.title }}</td>
                    <td>{{ item.storefront.title }}</td>
                    <td>{{ item.purchase_date }}</td>
                    <td>{{ item.price }}</td>
                </tr>

                <tr>
                    <td colspan="100%">
                        <div class="d-flex">
                            <v-spacer />

                            <v-btn
                                prepend-icon="mdi-plus"
                                variant="flat"
                                color="blue-darken-1"
                                @click="showAddModal = true"
                            >
                                Add
                            </v-btn>
                        </div>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <v-dialog width="auto" v-model="showAddModal">
            <v-form @submit.prevent>
                <v-card title="Add Platform/Storefront">
                    <v-card-text>
                        <v-select
                            v-model="platform.value.value"
                            label="Platform"
                            :return-object="true"
                            :items="[
                                {
                                    title: 'Xbox',
                                    value: 1,
                                }
                            ]" />

                        <v-combobox
                            v-model="storefront.value.value"
                            label="Storefront"
                            :items="[
                                {
                                    title: 'Epic Games Store',
                                    value: 1,
                                },
                                {
                                    title: 'Steam',
                                    value: 2,
                                }
                            ]" />

                        <date-picker-field
                            v-model="purchase_date.value.value"
                            label="Purchase Date"
                            placeholder="YYYY-MM-DD" />

                        <v-text-field
                            v-model="price.value.value"
                            type="number"
                            label="Purchase Price" />
                    </v-card-text>

                    <v-card-actions>
                        <v-btn
                            color="blue-darken-1"
                            variant="flat"
                            block
                            @click="submit"
                        >
                            Add
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-dialog>
</template>
