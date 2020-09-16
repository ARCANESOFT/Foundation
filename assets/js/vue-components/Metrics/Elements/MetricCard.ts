import VueComponent from '../../VueComponent'

export default VueComponent.extend({
    props: {
        loading: {
            type: Boolean,
            default: true,
        },
        allowed: {
            type: Boolean,
            default: true,
        },
    },

    template: `
        <div class="card card-borderless shadow-sm" :class="{'card-loading': loading}">
            <div class="dot-flashing"></div>
            <slot v-if=" ! loading && allowed"></slot>
            <div class="card-locked" v-else-if=" ! allowed">
                <i class="fas fa-3x fa-lock"></i>
            </div>
        </div>
    `,
})
