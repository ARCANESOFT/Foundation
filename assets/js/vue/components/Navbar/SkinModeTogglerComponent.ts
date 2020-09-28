import { defineComponent } from 'vue'
import {arcanesoft, request} from '../../../mixins'

const EVENT_CLASS = 'Arcanesoft\\Foundation\\Core\\Events\\UI\\SkinModeToggled'

enum SKIN_MODE {
    DARK = 'dark',
    LIGHT = 'light',
}

export default defineComponent({
    name: 'v-skin-mode-toggler',

    data: (): Object => ({
        selected: null,
    }),

    mixins: [
        arcanesoft,
        request,
    ],

    mounted(): void {
        this.selected = document.body.dataset.skinMode || SKIN_MODE.LIGHT
    },

    methods: {
        toggle(): void {
            this.selected = (this.selected === SKIN_MODE.LIGHT)
                ? SKIN_MODE.DARK
                : SKIN_MODE.LIGHT

            this.save(this.selected)
        },

        save(mode: string): void {
            document.body.dataset.skinMode = this.selected

            this.request()
                .post('/admin/api/events', {
                    class: EVENT_CLASS,
                    options: {mode},
                })

            this.arcanesoft()
                .$emit('foundation.ui.skin', {mode})
        }
    },

    computed: {
        iconClass(): string {
            return this.selected === SKIN_MODE.DARK
                ? 'far fa-fw fa-sun'
                : 'far fa-fw fa-moon'
        },
    },

    template: `
        <a class="navbar-link-item navbar-link-icon" @click.prevent="toggle">
            <i :class="iconClass"></i>
        </a>
    `,
})
