import {arcanesoft, request} from '../../mixins'
import VueComponent from '../VueComponent'

const EVENT_CLASS = 'Arcanesoft\\Foundation\\Core\\Events\\UI\\SidebarToggled'

export default VueComponent.create('v-sidebar-toggler', {
    mixins: [
        arcanesoft,
        request,
    ],

    methods: {
        toggle(): void {
            let visible = document.body.dataset.sidebarVisible || 'true'

            this.save(visible === 'true' ? 'false' : "true")
        },

        save(visible: string): void {
            document.body.dataset.sidebarVisible = visible

            this.request()
                .post('/admin/api/events', {
                    class: EVENT_CLASS,
                    options: {visible},
                })

            this.arcanesoft()
                .$emit('foundation.ui.sidebar', {visible})
        },
    },

    template: `
        <a @click.prevent="toggle" class="navbar-link-item navbar-link-icon">
            <i class="fas fa-fw fa-bars"></i>
        </a>
    `,
})
