import Arcanesoft from '../classes/Arcanesoft'

export default {
    methods: {
        arcanesoft(options?: Object): Arcanesoft {
            return window['Foundation']
        }
    }
}
