import VueComponent from '../../VueComponent'
import Editor from '@toast-ui/editor'

export default VueComponent.create('tui-viewer', {
    props: {
        value: {
            type: String,
            default: null,
        },

        height: {
            type: String,
            default: '300px',
        },
    },

    mounted(): void {
        const options = {
            ...{
                el: this.$refs.tuiViewer,
                height: this.height,
                initialValue: this.value,
                viewer: true,
            },
        }

        this.editor = Editor.factory(options)
    },

    template: `<div ref="tuiViewer"></div>`
})

