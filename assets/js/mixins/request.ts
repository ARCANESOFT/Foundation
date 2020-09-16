export default {
    methods: {
        request(options?: Object): Promise<any> {
            return window['request'](options)
        }
    }
}
