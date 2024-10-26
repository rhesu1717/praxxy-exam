<template>
    <div
        class="modal fade"
        :id="id"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{title}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">{{body}}</div>
                <div class="modal-footer p-1">
                    <button
                        type="button"
                        class="btn btn-sm btn-secondary"
                        data-bs-dismiss="modal"
                        @click.prevent="deleteItem(false)"
                    >
                        Cancel
                    </button>
                    <button type="button" @click.prevent="deleteItem(true)" class="btn btn-sm btn-danger">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    const { id, title, body } = defineProps(["id", "title", "body", "product-id"]);
    const emit = defineEmits(['confirmDelete'])

    const deleteItem = (val) => {
        emit('confirmDelete', val)
    }
</script>
