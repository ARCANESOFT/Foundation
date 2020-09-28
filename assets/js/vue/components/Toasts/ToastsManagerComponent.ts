import { defineComponent, ref, onMounted, onUnmounted } from 'vue'
import ToastComponent from './ToastComponent'
import Toast from './Toast'
import events from './events'
import { arcanesoft } from '../../../mixins'

export default defineComponent({
    name: 'v-toasts-manager',

    mixins: [
        arcanesoft,
    ],

    components: {
        ToastComponent,
    },

    setup() {
        let toasts = ref([])

        function pushToast(type, title, body, options): void {
            toasts.value.push(
                Toast.make(
                    type, title, body, options.time || Date.now(), options.delay || 5000
                )
            )
        }

        function removeToast(toast: Toast): void {
            toasts.value = toasts.value.filter((t) => t.id !== toast.id)
        }

        onMounted(() => {
            window['Foundation'].$on(events.UI_TOASTS_NOTIFY, ({type, title, body, options}) => {
                pushToast(type, title, body, options || {})
            })

            window['Foundation'].$on(events.UI_TOASTS_HIDDEN, (toast) => {
                removeToast(toast)
            })
        })
        onUnmounted(() => {
            window['Foundation'].$off(events.UI_TOASTS_NOTIFY)
            window['Foundation'].$off(events.UI_TOASTS_HIDDEN)
        })

        return {
            toasts,
        }
    },

    template: `
        <div class="toasts-container">
            <ToastComponent v-for="toast in toasts" :key="toast.id" :toast="toast" />
        </div>
    `,
})
