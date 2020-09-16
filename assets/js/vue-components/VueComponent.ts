import Vue from 'vue'
import { ComponentOptions} from 'vue/types/options'
import { ExtendedVue } from 'vue/types/vue'

type VueComponentExtended = ExtendedVue<any, any, any, any, any>

type VueComponent = {
    name: string,
    component: VueComponentExtended
}

type VueComponentOptions = ComponentOptions<any>

const create = (name: string, options?: VueComponentOptions): VueComponent => ({
    name: name,
    component: extend(options),
})

const extend = (options?: VueComponentOptions): VueComponentExtended => {
    return Vue.extend(options)
}

const prepare = (components: VueComponent[]) => components.reduce((items, item: VueComponent) => {
    items[item.name] = item.component
    return items
}, {})

export default {
    create,
    extend,
    prepare,
}
