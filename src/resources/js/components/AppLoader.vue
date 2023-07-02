<template>
    <div ref="modalElement"
         class="modal"
         tabindex="-1"
    >
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <div class="spinner-border" role="status" style="width: 3rem; height: 3rem;">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                        <p>Please wait</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import {onMounted, ref, watch} from 'vue';
    import {Modal} from 'bootstrap';

    const props = defineProps({
        active: {
            type: Boolean,
            default: false,
        }
    });

    const modalElement = ref<string | Element>('');
    const bsModal = ref<null | Modal>(null);

    onMounted(() => {
        bsModal.value = new Modal(modalElement.value);

        if (props.active && bsModal.value) {
            bsModal.value.show();
        }
    });

    watch(() => props.active, (newActive) => {
        if (!bsModal.value) return;

        if (newActive) {
            bsModal.value.show();
        } else {
            bsModal.value.hide();
        }
    });
</script>
