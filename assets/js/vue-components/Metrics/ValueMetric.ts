import VueComponent from '../VueComponent'
import {MetricCard, MetricTitle, ValueIcon} from './Elements'
import mixins from './mixins'
import numeral from 'numeral'

export default VueComponent.create('value-metric', {
    mixins: [
        mixins,
    ],

    components: {
        MetricCard,
        MetricTitle,
        ValueIcon,
    },

    data: (): Object => ({
        result: {
            value: 0,
            prefix: '',
            suffix: '',
            format: '(0[.]00a)',
        },
    }),

    mounted(): void {
        this.fetch(this.metric.class)
    },

    computed: {
        formattedValue(): string {
            if (this.result.value === null)
                return ''

            return (this.result.prefix || '') + numeral(this.result.value).format(this.result.format)
        },
    },

    template: `
        <MetricCard :loading="isLoading" :allowed="isAllowed">
            <div class="card-body p-3" v-if="isReady">
                <MetricTitle :title="metric.title"/>

                <h3 class="mb-0">{{ formattedValue }}</h3>
            </div>
        </MetricCard>
    `,
})
