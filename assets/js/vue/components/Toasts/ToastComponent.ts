import { defineComponent } from 'vue'
import * as moment from 'moment'
import Toast from './Toast'
import events from './events'
import Types from './types'
import { arcanesoft } from '../../../mixins'

export default defineComponent({
    props: {
        toast: {
            type: Object as () => Toast,
            required: true,
        }
    },

    mixins: [
        arcanesoft,
    ],

    mounted(): void {
        window['$'](this.$el).toast('show').on('hidden.bs.toast', () => {
            this.arcanesoft()
                .$emit(events.UI_TOASTS_HIDDEN, this.toast)
        })
    },

    computed: {
        toastClasses(): string {
            let classes: string[] = [];

            if (Object.values(Types).includes(this.toast.type))
                classes.push(`toast-${this.toast.type}`)

            return classes.join(' ')
        },

        formattedTime(): string {
            return moment(this.toast.time).fromNow()
        },
    },

    template: `
        <div class="toast fade" :class="toastClasses" role="alert" aria-live="assertive" aria-atomic="true" :data-delay="toast.delay">
            <div class="toast-header">
                <strong class="mr-auto">{{ toast.title }}</strong>
                <button type="button" class="ml-2 mb-1 close" aria-label="Close" data-dismiss="toast">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body" v-if="toast.body" v-html="toast.body"></div>
            <div class="toast-footer">
                <small class="text-muted">{{ formattedTime }}</small>
            </div>
        </div>
    `,
})
