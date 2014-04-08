<?php namespace Dashboard\Repositories;

use Auth, Input, DB;
use Bllim\Datatables\Datatables;

/**
 * This class interacts with Eloquent to serve the Base Controller (via the injected interface)
 */

class EloquentRepository {

    /** 
     * Holds the model object ready for the query
     * @var obj
     */
    protected $q;

    /**
     * Can be overidden in the models- define what cols to retreive
     * @var array or '*'
     */
    protected $selectCols = '*';

    public function __construct($model)
    {
        $this->model = $model;
        $this->q = $this->model->select($this->selectCols);
    }


    /*
    |--------------------------------------------------------------------------
    | Retrieve methods
    |--------------------------------------------------------------------------
    |
    | Rewrite all Elowuent retrive methods to ensure we only get the 
    |
    */
    public function all()
    {
        return $this->q->onlyOwners()->get();
    }

    public function find($id, $with = FALSE)
    {
        return $this->findOrFail($id, $with);
    }

    public function findOrFail($id, $with = FALSE)
    {
        if ( $with ) return $this->q->with($with)->onlyOwners()->findOrFail( $id );
        else return $this->q->onlyOwners()->findOrFail($id);
    }

    public function firstOrFail()
    {
        return $this->q->onlyOwners()->firstOrFail();
    }

    public function get()
    {
        return $this->q->onlyOwners()->get();
        // return $this->q->get();
    }

    public function first()
    {
        return $this->q->onlyOwners()->first();
    }

    public function pluck($colName)
    {
        return $this->q->onlyOwners()->pluck($colName);
    }

    public function lists($colValue, $colKey = 'id')
    {
        return $this->q->onlyOwners()->lists($colValue, $colKey);
    }

   

   
   /****************** RESTful CRUD methods *******************/
 
    public function findRecord($id, $with = false)
    {
        if (is_subclass_of($this->model, 'BaseModel'))
            $this->model->whereOwnerId(Auth::user()->owner_id);

        // If we've passed $with array then eager load
        if ( $with ) return $this->model->with($with)->findOrFail( $id );
        else return $this->model->findOrFail( $id );
    }

    public function createRecord()
    {
        // 1. Create new object and fill it with $_POST ($fillable is set)
        $this->q = new $this->model( Input::all() );

        // 2. Set the owner_id
        //$this->q->owner_id = Auth::user()->owner_id;       

        // 2. Now save it and set a success flag
        // if ( $this->q->save() ) $this->q->result = TRUE;
        $this->q->result = $this->q->save();

        return $this->q;
    }


    public function updateRecord($id = FALSE)
    {
        // 1. Find the model & fill with $_POST (protected with $fillable)
        $this->q = $this->model->findOrFail( $id );
        $this->q->fill( Input::all() );
        //$this->q->owner_id = Auth::user()->owner_id;   

        // 2. Save the new model and set a success flag
        // if ( $this->q->save() ) $this->q->result = TRUE;
        $this->q->result = $this->q->save();

        return $this->q;
    }


    public function destroyRecord($id = FALSE)
    {
        die('The destroy method has not been created yet - see Dashbpard\Repo\Eloquent\Eloquentrepo');
    }












    /*********************** general Mehtods for data handling *******************/


    public function findAll()
    {
        if (is_subclass_of($this->model, 'BaseModel'))
            return $this->model->whereOwnerId(Auth::user()->owner_id)->get();
        return $this->model->all();
    }

    
    public function dropdown($label)
    {
        return $this->model->onlyOwners()->lists($label,'id');
    }








    /**
     * Get all records, using URL params to constrain
     * @param  boolean $dataTable Pass to datatables?
     * @return array The artay of results that match the query
     */
    public function getAll($dataTable = TRUE)
    {
        $this->setCols();
        return $this->getResult($dataTable);
    }

    public function getFor($dataTable = TRUE)
    {
        $this->setCols();
        if ( $contact_id = Input::get('contact_id') ) $this->q->where('contact_id', $contact_id);
        if ( $sortASC = Input::get('sortASC') ) $this->q->orderBy($sortASC, 'asc');
        if ( $sortDESC = Input::get('sortDESC') ) $this->q->orderBy($sortDESC, 'desc');
        return $this->getResult($dataTable);
    }

    public function getPivot($dataTable = TRUE)
    {
        $this->setCols();
        $otherTable = Input::get('otherTable');

        // Return the results
        $this->q->$otherTable;
        dump($this->model->get());
        return;

        if ( $contact_id = Input::get('contact_id') ) $this->q->where('contact_id', $contact_id);
        if ( $sortASC = Input::get('sortASC') ) $this->q->orderBy($sortASC, 'asc');
        if ( $sortDESC = Input::get('sortDESC') ) $this->q->orderBy($sortDESC, 'desc');
        return $this->getResult($dataTable);
    }


   
    /**
     * Sets up the 'select' portioncof the query (from $_GET['cols'] params)
     */
    public function setCols($cols = FALSE)
    {
        // we can pass the cols as array, or get from Input
        if ( ! $cols )
        {
            if ( $input = Input::get('cols') ) $cols = explode(',', $input);
            else $cols = array('id'); 
        }

        // Format dates
        foreach ($cols as $k => $col)
        {
            switch ($col) {
                case 'created_at':
                case 'updated_at':
                    $cols[$k] = DB::raw('DATE_FORMAT(' . $col . ', \'%d/%m/%Y, %H\:%i\') AS ' . $col);
                    break;
                
                case 'date_of_birth':
                case 'order_date':
                    $cols[$k] = DB::raw('DATE_FORMAT(' . $col . ', \'%d/%m/%Y\') AS ' . $col);
                    break;
            }

        } 

        // Add in the id if its not already
        if ( ! in_array('id', $cols) ) array_unshift($cols, 'id');

        //Set up  the query object
        $this->q = $this->model->select($cols);
    }

    
    /**
     * handles the query and returns results 
     * @param  [type] $dataTable [description]
     * @return [type]            [description]
     */
    public function getResult($dataTable)
    {
        $this->q->where('owner_id', Auth::user()->owner_id);

        // if its datatable then run it through Datatables class
        if ( $dataTable ) $result = Datatables::of($this->q)->make();
        else $result = $this->q->get();

        return $result;
    }

   
}