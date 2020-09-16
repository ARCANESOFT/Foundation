import VueComponent from '../VueComponent'
import ToastComponent from './ToastComponent'
import Toast from './Toast'
import events from './events'
import { arcanesoft } from '../../mixins'

export default VueComponent.create('toasts-manager-component', {
    mixins: [
        arcanesoft,
    ],

    components: {
        ToastComponent,
    },

    data: (): Object => ({
        toasts: [],
    }),

    mounted() {
        this.arcanesoft().$on(events.UI_TOASTS_NOTIFY, ({type, title, body, options}) => {
            this.pushToast(type, title, body, options || {})
        })

        this.arcanesoft().$on(events.UI_TOASTS_HIDDEN, (toast) => {
            this.removeToast(toast)
        })
    },

    destroyed() {
        this.arcanesoft().$off(events.UI_TOASTS_NOTIFY)
        this.arcanesoft().$off(events.UI_TOASTS_HIDDEN)
    },

    methods: {
        pushToast(type, title, body, options) {
            this.toasts.push(
                Toast.make(
                    type,
                    title,
                    body,
                    options.time || Date.now(),
                    options.delay || 5000
                )
            )
        },

        removeToast(toast: Toast) {
            this.toasts = this.toasts.filter((t) => t.id !== toast.id)
        },
    },

    template: `
        <div class="toasts-container">
            <ToastComponent v-for="toast in toasts" :key="toast.id" :toast="toast" />
        </div>
    `,
})
