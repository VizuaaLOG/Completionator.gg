<template>
    <div class="mb-3">
        <h2 class="fw-normal">Latest Episodes</h2>

        <div class="row flex-nowrap overflow-x-auto pb-3">
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastEpisodeCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastEpisodeCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastEpisodeCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastEpisodeCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastEpisodeCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastEpisodeCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastEpisodeCard />
            </div>
            <div class="col-3 col-lg-2 col-xxl-1">
                <PodcastEpisodeCard />
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import PodcastEpisodeCard from '@/components/podcasts/PodcastEpisodeCard.vue';
</script>
