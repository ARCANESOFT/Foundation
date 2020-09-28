import { defineComponent } from 'vue'
import {MetricCard, MetricTitle} from './Elements'
import PartitionChartComponent from './Charts/PartitionChartComponent'
import mixins from './mixins'

export default defineComponent({
    name: 'partition-metric',

    mixins: [
        mixins,
    ],

    components: {
        MetricCard,
        MetricTitle,
        PartitionChartComponent,
    },

    mounted(): void {
        this.fetch(this.metric.class)
    },

    methods: {
        mapItems(callback): Object {
            return this.result.value.map(callback)
        },

        getColor(item, index): String {
            return typeof item.color === 'string'
                ? item.color
                : this.getColorByIndex(index)
        },

        getColorByIndex(index): String {
            const colors = [
                '#007BFF',
                '#6610F2',
                '#6F42C1',
                '#E83E8C',
                '#DC3545',
                '#FD7E14',
                '#FFC107',
                '#28A745',
                '#20C997',
                '#17A2B8',
            ]

            let total = (colors.length - 1)

            return colors[index > total ? (index % total) : index]
        },
    },

    computed: {
        values(): Object {
            return this.mapItems(item => item.value)
        },

        labels(): Object {
            return this.mapItems(item => item.label)
        },

        colors(): Object {
            return this.mapItems((item, index) => this.getColor(item, index))
        },

        formattedItems(): Object {
            return this.mapItems((item, index) => {
                return {
                    label: item.label,
                    value: item.value,
                    color: this.getColor(item, index),
                }
            })
        },

        total(): Number {
            if (this.isEmpty)
                return 0

            return this.values.reduce((accumulator, value) => accumulator + value)
        },

        isEmpty(): Boolean {
            return this.values.length === 0
        },
    },

    template: `
        <MetricCard :loading="isLoading" :allowed="isAllowed">
            <div class="card-body p-3" v-if="isReady">
                <MetricTitle :title="metric.title" :total="total"/>

                <div v-if="isEmpty">No data</div>

                <div v-else class="d-flex justify-content-between flex-nowrap">
                    <ul class="list-unstyled mb-0">
                        <li v-for="item in this.formattedItems">
                            <span class="status" :style="['background-color:'+item.color]"></span>
                            <small>{{ item.label }} ({{ item.value }})</small>
                        </li>
                    </ul>

                    <div style="position: relative; max-height: 100px; width: 100px;">
                        <PartitionChartComponent :data="values" :labels="labels" :colors="colors"/>
                    </div>
                </div>
            </div>
        </MetricCard>
    `,
})
