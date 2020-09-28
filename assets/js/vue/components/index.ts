import Datatable from './Views/Datatable'
import { ValueMetric, TrendMetric, RangedValueMetric, PartitionMetric } from './Metrics'
import {TuiEditor, TuiViewer} from './Forms/TuiEditor'
import ToastsManagerComponent from './Toasts/ToastsManagerComponent'
import SkinModeTogglerComponent from './Navbar/SkinModeTogglerComponent'
import SidebarTogglerComponent from './Navbar/SidebarTogglerComponent'
import RatingInputComponent from './Forms/Rating/RatingInputComponent'
import NotificationsNavbarComponent from './Navbar/Notifications/NotificationsNavbarComponent'
import FullscreenTogglerComponent from './Navbar/FullscreenTogglerComponent'

export default {
    'v-datatable':              Datatable,
    'v-notifications-navbar':   NotificationsNavbarComponent,
    'v-fullscreen-toggler':     FullscreenTogglerComponent,
    'v-rating-input':           RatingInputComponent,
    'v-sidebar-toggler':        SidebarTogglerComponent,
    'v-skin-mode-toggler':      SkinModeTogglerComponent,
    'v-toasts-manager':         ToastsManagerComponent,
    'v-markdown-editor':        TuiEditor,
    'v-markdown-viewer':        TuiViewer,

    'ranged-value-metric':      RangedValueMetric,
    'trend-metric':             TrendMetric,
    'partition-metric':         PartitionMetric,
    'value-metric':             ValueMetric,
}
