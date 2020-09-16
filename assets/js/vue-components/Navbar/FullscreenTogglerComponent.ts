import VueComponent from '../VueComponent'
import {arcanesoft} from '../../mixins'
import * as sf from 'screenfull'

export default VueComponent.create('v-fullscreen-toggler', {
    data: (): Object => ({
        isFullscreen: false,
    }),

    mixins: [
        arcanesoft,
    ],

    methods: {
        toggle(): void {
            if (sf.isEnabled) {
                sf.toggle().then(() => {
                    this.isFullscreen = (sf as sf.Screenfull).isFullscreen

                    this.arcanesoft().$emit('foundation.ui.fullscreen', {
                        isFullscreen: this.isFullscreen
                    })
                })
            }
        },
    },

    computed: {
        iconClass(): string {
            return this.isFullscreen
                ? 'fa fa-fw fa-compress'
                : 'fa fa-fw fa-expand'
        }
    },

    template: `
        <a class="navbar-link-item navbar-link-icon" @click.prevent="toggle">
            <i :class="iconClass"></i>
        </a>
    `,
})
