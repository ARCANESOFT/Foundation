import VueComponent from './vue-components/VueComponent'

import Datatable from './vue-components/Views/Datatable'
import { ValueMetric, TrendMetric, RangedValueMetric, PartitionMetric } from './vue-components/Metrics'
import {TuiEditor, TuiViewer} from './vue-components/Forms/TuiEditor'
import ToastsManagerComponent from './vue-components/Toasts/ToastsManagerComponent'
import SkinModeTogglerComponent from './vue-components/Navbar/SkinModeTogglerComponent'
import SidebarTogglerComponent from './vue-components/Navbar/SidebarTogglerComponent'
import RatingInputComponent from './vue-components/Forms/Rating/RatingInputComponent'
import NotificationsNavbarComponent from './vue-components/Navbar/Notifications/NotificationsNavbarComponent'
import LogoutNavBtnComponent from './vue-components/Navbar/LogoutNavBtnComponent'
import FullscreenTogglerComponent from './vue-components/Navbar/FullscreenTogglerComponent'

export default VueComponent.prepare([
    Datatable,
    NotificationsNavbarComponent,
    FullscreenTogglerComponent,
    LogoutNavBtnComponent,
    RatingInputComponent,
    SidebarTogglerComponent,
    SkinModeTogglerComponent,
    ToastsManagerComponent,
    TuiEditor,
    TuiViewer,
    RangedValueMetric,
    TrendMetric,
    PartitionMetric,
    ValueMetric,
])
