window['$'] = window['jQuery'] = require('jquery')
require('select2')

export default (selector: string, options?: Object) => {
    window['$'](() => {
        options = {
            ...{
                language: window['Foundation'].getLocale(),
                theme: 'arcanesoft',
            },
            ...options,
        }

        window['$'](selector).select2(options)
    })
}
