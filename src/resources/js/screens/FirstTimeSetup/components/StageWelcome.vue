<template>
    <div class="card w-25">
        <div class="card-header">
            <font-awesome-icon :icon="faHand" size="5x" />

            <h1 class="display-5">Welcome!</h1>
            <p class="lead">Hey there! Welcome to Completionist! Let's get you setup.</p>
        </div>

        <div class="card-body">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi, corporis eum fugiat harum labore necessitatibus quasi! Adipisci blanditiis consequatur corporis culpa debitis doloribus eligendi est facilis harum incidunt ipsum itaque iusto labore laboriosam libero maxime minus molestiae necessitatibus, non perspiciatis quae reprehenderit rerum sint temporibus, vel veniam veritatis, voluptate voluptatum!
        </div>

        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-primary"
                    @click="handle"
            >
                Get Started
            </button>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
    import {faHand} from '@fortawesome/free-solid-svg-icons';

    const emit = defineEmits(['continue']);

    function handle() {
        emit('continue');
    }
</script>
