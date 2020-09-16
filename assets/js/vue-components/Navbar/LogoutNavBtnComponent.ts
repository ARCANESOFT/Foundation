import VueComponent from '../VueComponent'
import {request} from '../../mixins'

export default VueComponent.create('logout-nav-btn-component', {
    props: [
        'url',
        'text',
    ],

    mixins: [
        request,
    ],

    methods: {
        logout(): void {
            this.request()
                .post(this.url)
                .then((resp) => {
                    location.replace(resp.data.redirect)
                })
                .catch(() => {
                    location.reload()
                })
        },
    },

    template: `
        <a class="dropdown-item" href="#" @click.prevent="logout">
            <i class="fas fa-fw fa-power-off mr-2"></i> {{ text }}
        </a>
    `,
})
