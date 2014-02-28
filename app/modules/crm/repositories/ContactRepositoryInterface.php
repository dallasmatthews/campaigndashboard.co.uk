<?php namespace Dashboard\Repositories;

interface ContactRepositoryInterface {
    
    public function findRecord($id);
        
    public function createRecord();
        
    public function updateRecord($id);

    public function destroyRecord($id);
}
