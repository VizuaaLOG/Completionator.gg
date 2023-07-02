<template>
    <UpNext />
    <Favourites />
    <LatestEpisodes />
    <RecentlyAdded />
    <Categories />
</template>

<script lang="ts" setup>
    import UpNext from '@/screens/Home/components/UpNext.vue';
    import Favourites from '@/screens/Home/components/Favourites.vue';
    import LatestEpisodes from '@/screens/Home/components/LatestEpisodes.vue';
    import RecentlyAdded from '@/screens/Home/components/RecentlyAdded.vue';
    import Categories from '@/screens/Home/components/Categories.vue';
</script>
