import VueComponent from '../VueComponent'
import Component from '../../classes/Views/Component'
import {arcanesoft, request} from '../../mixins'
import morphdom from 'morphdom'
import debounce from '../../helpers/debounce'

type ComponentData = {
    loading: boolean,
    component: Component,
    actions: any[],
}

export default VueComponent.create('v-datatable', {
    props: {
        name: {
            type: String,
            required: true,
        },
    },

    mixins: [
        arcanesoft,
        request,
    ],

    data: (): ComponentData => ({
        loading: false,
        component: null,
        actions: [],
    }),

    mounted(): void {
        this.component = new Component(this.name, this.$attrs)

        this.fetch()

        this.arcanesoft().$on('arcanesoft::components.action', ({component, action}) => {
            if (component.name === this.name)
                this.actions.push(action)
        })
    },

    methods: {
        fetch(params: Object = {}): void {
            this.loading = true

            params = {
                ...params,
                component: this.component.toArray()
            }

            this.request()
                .post('/admin/api/components', params)
                .then((response) => {
                    if (response.status === 200) {
                        this.component.setData(response.data.data)
                        morphdom(this.$refs.dom, response.data.html)

                        this.$nextTick().then(() => {
                            this.component.scan(this.$refs.dom)
                            this.arcanesoft().initComponents(this.$refs.dom)
                        })

                        this.resetActions()
                    }
                })

            this.loading = false
        },

        resetActions(): void {
            this.actions = []
        },
    },

    watch: {
        actions: debounce(function(actions: Array<any>) {
            if (actions.length > 0)
                this.fetch({actions})
        }, 200),
    },

    template: `
        <div ref="dom">
            <div class="card card-borderless shadow-sm">
                <div class="card-header">Loading&hellip;</div>
                <div class="card-body d-flex justify-content-center">
                    <div class="spinner-border" role="status"></div>
                </div>
            </div>
        </div>
    `,
})
