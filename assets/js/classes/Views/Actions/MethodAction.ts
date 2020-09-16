import Action from './Action'
import ActionType from '../Enums/ActionType'
import Directive from '../../DOM/Directive'

export default class MethodAction extends Action {
    /**
     * Make a new method action.
     */
    public static make(elt: Element|any, directive: Directive): MethodAction {
        return new MethodAction(elt, ActionType.METHOD, {
            method: directive.method,
            params: directive.params,
        });
    }
}
