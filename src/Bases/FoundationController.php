<?php namespace Arcanesoft\Foundation\Bases;

class FoundationController extends Controller
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The view namespace.
     *
     * @var string
     */
    protected $viewNamespace = 'foundation';

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Instantiate the controller.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTemplate(config(
            'arcanesoft.foundation.template',
            'foundation::_templates.default.layout'
        ));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Views Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Display the view.
     *
     * @param  string  $name
     * @param  array   $data
     *
     * @return \Illuminate\View\View
     */
    protected function view($name, array $data = [])
    {
        if ( ! is_null($this->viewNamespace)) {
            $name = "{$this->viewNamespace}::$name";
        }

        return parent::view($name, $data);
    }
}
