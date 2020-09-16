import VueComponent from '../../VueComponent'
import {mapState} from 'vuex'

export default VueComponent.create('v-notifications-navbar', {
    created(): void {
        this.$store.dispatch('notifications/getAllNotifications')
    },

    computed: {
        ...mapState({
            notifications: state => state["notifications"].all
        }),

        unreadNotifications() {
            return this.notifications.filter((notifications) => {
                return notifications.read === false;
            });
        },

        hasUnread(): boolean {
            return this.unreadNotifications.length > 0;
        },
    },

    template: `
        <div>
            <a id="notifications-dropdown" href="#" data-toggle="dropdown"
               class="dropdown-toggle no-caret navbar-link-item navbar-link-icon">
                <span class="status-indicator">
                    <i class="far fa-fw fa-bell"></i>
                    <span class="status status-top bg-danger" v-show="hasUnread"></span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right mt-0" aria-labelledby="notifications-dropdown">
                <h6 class="px-3 py-2 mb-0 font-weight-bold text-center">Notifications</h6>
                <div class="dropdown-divider"></div>

                <div v-for="notification in unreadNotifications" :key="notification.id">
                    <a class="dropdown-item">
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="font-weight-normal mb-1">{{ notification.title }}</h6>
                            <p class="text-gray small ellipsis mb-0">{{ notification.message }}</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                </div>

                <a href="#" class="dropdown-item">
                    <small class="font-weight-bold">See all notifications</small>
                </a>
            </div>
        </div>
    `,
})
