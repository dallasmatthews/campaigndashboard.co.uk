<?php namespace Dashboard\Broadcasts;

use BaseModel;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Template extends BaseModel  implements PresenterInterface {
    
    // Wrap in a presenter (ShawnMcCool)
    public $presenter = 'Dashboard\Broadcasts\TemplatePresenter';

     // Validation rules
    public static $rules = array(
        'save' => array(
            // 'first_name'                  => 'between:2,32',
            // 'last_name'                  => 'required|between:2,32',
            // 'email'                 => 'email',
        ),
        'create' => array(),
        'update' => array()
    );

}