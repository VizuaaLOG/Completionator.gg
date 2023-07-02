<template>
    <div class="mb-3">
        <h2 class="fw-normal">Recently Added</h2>

        <div class="row flex-nowrap overflow-x-auto pb-3">
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastCard />
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import PodcastCard from '@/components/podcasts/PodcastCard.vue';
</script>
