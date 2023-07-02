<template>
    <div class="mb-3">
        <h2 class="fw-normal">Categories</h2>

        <div class="row pb-3">
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 mb-3">
                <CategoryCard />
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 mb-3">
                <CategoryCard />
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 mb-3">
                <CategoryCard />
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 mb-3">
                <CategoryCard />
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 mb-3">
                <CategoryCard />
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 mb-3">
                <CategoryCard />
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 mb-3">
                <CategoryCard />
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import CategoryCard from '@/components/categories/CategoryCard.vue';
</script>
