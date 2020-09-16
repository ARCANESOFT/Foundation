import VueComponent from '../../VueComponent'

export default VueComponent.extend({
    props: {
        selected: {
            default: null,
        },

        ranges: {
            type: Array,
            default: () => [],
        },
    },

    methods: {
        changeSelectedRange(event): void {
            let selected = parseInt(event.target.value, 10)

            this.$emit('selected-range-changed', selected)
        },

        isSelected(value): boolean {
            return this.selected === value
        },
    },

    computed: {
        hasRanges(): boolean {
            return this.ranges.length > 0
        },
    },

    template: `
        <select class="form-select form-control-xs" @change="changeSelectedRange" v-if="hasRanges">
            <option v-for="range in ranges"
                    :key="range.value"
                    :value="range.value"
                    :selected="isSelected(range.value)">
                {{ range.label }}
            </option>
        </select>
    `,
})

