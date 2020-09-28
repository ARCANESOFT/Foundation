import { defineComponent } from 'vue'
import {MetricCard, MetricRanges, MetricTitle} from './Elements'
import TrendChartComponent from './Charts/TrendChartComponent'
import mixins from './mixins'

export default defineComponent({
    name: 'trend-metric',

    mixins: [
        mixins,
    ],

    components: {
        MetricCard,
        MetricTitle,
        MetricRanges,
        TrendChartComponent,
    },

    data: (): Object => ({
        result: {
            value: 0,
            prefix: '',
            suffix: '',
            format: '(0[.]00a)',
            trend: {},
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
            this.selectedRange = selected;

            this.getResults()
        }
    },

    computed: {
        hasRanges(): boolean {
            return this.metric.ranges.length > 0
        },

        trend() {
            return Object.values(this.result.trend)
        },

        values() {
            return this.trend.map(item => item.value)
        },

        labels() {
            return this.trend.map(item => item.label)
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
                <h3 class="mb-0" v-if="result.value !== null">{{ result.value.value }}</h3>
            </div>

            <TrendChartComponent :legend="metric.title" :data="values" :labels="labels" v-if=" ! loading"/>

            <div class="card-footer p-2" v-if="hasRanges">
                <MetricRanges
                    :ranges="metric.ranges"
                    :selected="selectedRange"
                    @selected-range-changed="handleSelectedRangeChange"/>
            </div>
        </MetricCard>
    `,
})
