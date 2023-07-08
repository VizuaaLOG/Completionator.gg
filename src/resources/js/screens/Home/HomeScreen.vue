<template>
    <div class="mb-3 mt-3">
        <h2 class="fw-normal">Currently Playing</h2>

        <div class="row flex-nowrap overflow-x-auto pb-3">
            <div class="col-3 col-lg-3 col-xxl-1">
                <GameCard />
            </div>
        </div>
    </div>

    <Categories />
</template>

<script lang="ts" setup>
    import Categories from '@/screens/Home/components/Categories.vue';
    import GameCard from '@/components/games/GameCard.vue';
</script>
