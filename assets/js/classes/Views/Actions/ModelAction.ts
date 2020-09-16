import Action from './Action'
import ActionType from '../Enums/ActionType'
import Directive from '../../DOM/Directive'

export default class ModelAction extends Action {
    /**
     * Make a new model action.
     */
    public static make(elt: HTMLInputElement, directive: Directive): ModelAction {
        return new Action(elt, ActionType.MODEL, {
            name:  directive.value,
            value: elt.value,
        })
    }
}
