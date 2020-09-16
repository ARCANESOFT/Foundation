import VueComponent from '../../VueComponent'

export default VueComponent.extend({
    props: {
        current: {
            type: Number,
            required: true,
        },
        previous: {
            type: Object,
            required: true,
        },
        change: {
            type: Object,
            required: true,
        },
    },

    computed: {
        previousValue() {
            return this.previous.value
        },

        hasIncreased(): boolean {
            return this.growthStatus === 'Increased'
        },

        hasDecreased(): boolean {
            return this.growthStatus === 'Decreased'
        },

        isConstant(): boolean {
            return this.growthStatus === 'Constant'
        },

        growth(): number {
            let growth;

            if (this.current !== 0)
                growth = this.previousValue === 0
                    ? this.current
                    : (this.current - this.previousValue) / this.previousValue
            else
                growth = - this.previousValue

            return Math.floor(growth * 100)
        },

        growthStatus(): string {
            switch (Math.sign(this.growth)) {
                case 1:
                    return 'Increased'
                case 0:
                    return 'Constant'
                case -1:
                    return 'Decreased'
            }
        },

        constantGrowthMessage(): string {
            if (this.previousValue !== 0 && this.current !== 0)
                return 'No Increase'

            return 'No data'
        },
    },

    template: `
        <div>
            <svg class="metric-value-icon metric-value-increased" viewBox="0 0 24 24"  v-if="hasIncreased">
                <path d="M20 15a1 1 0 0 0 2 0V7a1 1 0 0 0-1-1h-8a1 1 0 0 0 0 2h5.59L13 13.59l-3.3-3.3a1 1 0 0 0-1.4 0l-6 6a1 1 0 0 0 1.4 1.42L9 12.4l3.3 3.3a1 1 0 0 0 1.4 0L20 9.4V15z"></path>
            </svg>
            <svg class="metric-value-icon metric-value-decreased" viewBox="0 0 24 24" v-if="hasDecreased">
                <path d="M20 9a1 1 0 0 1 2 0v8a1 1 0 0 1-1 1h-8a1 1 0 0 1 0-2h5.59L13 10.41l-3.3 3.3a1 1 0 0 1-1.4 0l-6-6a1 1 0 0 1 1.4-1.42L9 11.6l3.3-3.3a1 1 0 0 1 1.4 0l6.3 6.3V9z"></path>
            </svg>

            <span v-if="isConstant" class="font-weight-semibold text-muted small">{{ constantGrowthMessage }}</span>
            <span v-else class="font-weight-semibold text-muted">{{ growth }}%</span>
        </div>
    `,
})
