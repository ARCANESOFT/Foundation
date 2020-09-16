import VueComponent from '../../VueComponent'

export default VueComponent.create('rating-input-component', {
    props: {
        name: {
            type: String,
            required: false,
            default: 'rating',
        },

        value: {
            default: null,
        },

        max: {
            type: Number,
            required: false,
            default: 5,
        },

        icon: {
            type: String,
            required: false,
            default: 'fa fa-fw fa-star',
        },

        readonly: {
            type: Boolean,
            required: false,
            default: false,
        },

        disabled: {
            type: Boolean,
            required: false,
            default: false,
        },
    },

    /*
     * Initial state of the component's data.
     */
    data: (): Object => ({
        selectedValue: null,
        oldValue: null,
    }),

    mounted(): void {
        this.selectedValue = this.value
    },

    methods: {
        starOver(value): void {
            if (this.isDisabled)
                return

            this.oldValue = this.selectedValue
            this.selectedValue = value
        },

        starOut(): void {
            if (this.isDisabled)
                return

            this.selectedValue = this.oldValue
        },

        setSelected(value): void {
            if (this.isDisabled)
                return

            this.oldValue = value
            this.selectedValue = value
        }
    },

    computed: {
        ratingRange(): Array<number> {
            return window['_'].range(1, this.max + 1)
        },

        isDisabled(): boolean {
            return this.disabled
        },

        ratingClasses(): Function {
            return (rating) => {
                return {
                    'is-selected': (this.selectedValue >= rating) && this.selectedValue != null,
                    'is-disabled': this.disabled,
                }
            }
        },
    },

    template: `
        <div class="vue-rating">
            <label v-for="rating in ratingRange"
                   @click="setSelected(rating)" @mouseover="starOver(rating)" @mouseout="starOut"
                   class="vue-rating-label" :class="ratingClasses(rating)">
                <input type="radio" class="vue-rating-input"
                       v-model="selectedValue"
                       :value="rating" :id="name+'-'+rating" :name="name"
                       :disabled="disabled" :readonly="readonly">
                <i :class="icon"></i>
            </label>
        </div>
    `,
})
