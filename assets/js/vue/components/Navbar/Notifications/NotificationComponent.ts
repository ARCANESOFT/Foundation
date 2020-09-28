import { defineComponent } from 'vue'

export default defineComponent({
    props: {
        notification: {}
    },

    template: `
        <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
                <div class="preview-icon" :class="'bg-' + notification.type">
                    <i :class="notification.icon"></i>
                </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="preview-subject font-weight-normal mb-1">{{ notification.title }}</h6>
                <p class="text-gray ellipsis mb-0">{{ notification.message }}</p>
            </div>
        </a>
    `,
})
