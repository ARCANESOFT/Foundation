import './_components'
import './_vendors'
import './_helpers'
import './_modules'

/**
 * Init the APP
 */

import Arcanesoft from './classes/Arcanesoft'
import store from './_store'
import components from './_vue-components'

window['Foundation'] = new Arcanesoft({
    el: '#arcanesoft',
    store,
    components,
})
