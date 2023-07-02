<template>
    <FormValidator>
        <FormInput :hide-label="true"
                   :is-in-form="false"
                   class="flex-grow-1"
                   label="Search"
                   placeholder="Search by podcast, episode, or publisher..."
                   type="search"
        >
            <button class="btn btn-secondary" type="button">Search</button>
        </FormInput>
    </FormValidator>
</template>

<script lang="ts" setup>

    import FormValidator from '@/components/form/FormValidator.vue';
    import FormInput from '@/components/form/FormInput.vue';
</script>
