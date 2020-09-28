import { defineComponent } from 'vue'

export default defineComponent({
    props: {
        title: {
            type: String,
            required: true,
        },
        total: {
            default: null,
        },
    },

    computed: {
        hasTotal(): boolean {
            return this.total !== null
        },
    },

    template: `
        <h6 class="d-flex font-weight-semibold text-muted mb-1">
            {{ title }}
            <small class="ml-auto" v-if="hasTotal">({{ total }} Total)</small>
        </h6>
    `,
})
