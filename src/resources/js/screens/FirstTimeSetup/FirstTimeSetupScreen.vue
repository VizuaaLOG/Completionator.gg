<template>
    <div class="d-flex justify-content-center align-items-center h-100">
        <template v-if="!systemStore.setup_complete">
            <StageWelcome v-if="stage === 1" @continue="next" />
            <StageName v-if="stage === 2" @back="stage--" @continue="next" />
            <StageAdminUser v-if="stage === 3" @back="stage--" @continue="next" />
            <StageProcessing v-if="stage === 4" />
            <StageComplete v-if="stage === 5" />
        </template>

        <template v-if="systemStore.setup_complete">
            <StageComplete @continue="router.replace('/')" />
        </template>
    </div>
</template>

<script lang="ts" setup>
    import {ref} from 'vue';
    import StageWelcome from '@/screens/FirstTimeSetup/components/StageWelcome.vue';
    import StageName from '@/screens/FirstTimeSetup/components/StageName.vue';
    import StageAdminUser from '@/screens/FirstTimeSetup/components/StageAdminUser.vue';
    import StageProcessing from '@/screens/FirstTimeSetup/components/StageProcessing.vue';
    import StageComplete from '@/screens/FirstTimeSetup/components/StageComplete.vue';
    import {useSystemStore} from '@/stores/system';
    import {useInitialSetupStore} from '@/stores/initialSetup';
    import router from '@/router';

    const stage = ref(1);
    const systemStore = useSystemStore();
    const setupStore = useInitialSetupStore();

    async function next() {
        if (stage.value === 5) {
            await router.replace('/');
            return;
        }

        stage.value++;

        if (stage.value === 4) {
            try {
                await systemStore.runMigrations();
            } catch (e) {
                console.error(e);
                alert('Error while trying to run migrations on the server. Check the browser console for details.');
                return;
            }

            try {
                await setupStore.completeSetup();
            } catch (e) {
                console.error(e);
                alert('Error while trying to complete the initial setup. Check the browser console for details.');
                return;
            }

            await systemStore.fetchSystemState();

            if (!systemStore.setup_complete) {
                alert('Even though the setup was successful refetching the system state appears to indicate the setup has not completed. Check the browser console for details.');
                return;
            }

            stage.value++;
        }
    }
</script>
