import { defineComponent } from 'vue'
import {MetricCard, MetricRanges, MetricTitle, ValueIcon} from './Elements'
import mixins from './mixins'
import numeral from 'numeral'

export default defineComponent({
    name: 'ranged-value-metric',

    mixins: [
        mixins,
    ],

    components: {
        MetricCard,
        MetricTitle,
        MetricRanges,
        ValueIcon,
    },

    data: (): Object => ({
        result: {
            value: 0,
            previous: {
                label: '',
                value: 0,
            },
            change: {
                label: '',
                value: null,
            },
            prefix: '',
            suffix: '',
            format: '(0[.]00a)',
        },

        selectedRange: null,
    }),

    created(): void {
        if (this.hasRanges)
            this.selectedRange = this.metric.ranges[0].value
    },

    mounted(): void {
        this.getResults()
    },

    methods: {
        getResults(): void {
            this.fetch(this.metric.class, this.metricOptions)
        },

        handleSelectedRangeChange(selected): void {
            this.selectedRange = selected

            this.getResults()
        },
    },

    computed: {
        formattedValue(): string {
            if (this.result.value === null)
                return ''

            return (this.result.prefix || '') + numeral(this.result.value).format(this.result.format)
        },

        hasRanges(): boolean {
            return this.metric.ranges.length > 0
        },

        metricOptions(): Object {
            const options = {
                params: {},
            }

            if (this.hasRanges)
                options.params['range'] = this.selectedRange

            return options
        },
    },

    template: `
        <MetricCard :loading="isLoading" :allowed="isAllowed">
            <div class="card-body p-3" v-if="isReady">
                <MetricTitle :title="metric.title"/>

                <h3 class="mb-0">{{ formattedValue }}</h3>

                <ValueIcon
                    :current="this.result.value"
                    :previous="this.result.previous"
                    :change="this.result.change"></ValueIcon>
            </div>

            <div class="card-footer p-2" v-if="hasRanges">
                <MetricRanges
                    :ranges="metric.ranges"
                    :selected="selectedRange"
                    @selected-range-changed="handleSelectedRangeChange"/>
            </div>
        </MetricCard>
    `,
})
