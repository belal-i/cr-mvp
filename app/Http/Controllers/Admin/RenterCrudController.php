<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RenterRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RenterCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RenterCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Renter::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/renter');
        CRUD::setEntityNameStrings('renter', 'renters');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // set columns from db columns.
        CRUD::column('number_of_persons')->type('number');
        CRUD::column('start_date')->type('date');
        CRUD::column('end_date')->type('date');
        CRUD::column('min_months')->type('number');
        CRUD::column('max_rent')->type('number');
        CRUD::column('min_number_of_rooms')->type('number');
        CRUD::column('must_be_furnished');
        CRUD::column('min_size_sq_m')->type('number');
        CRUD::column('notes');
        CRUD::column('is_smoker');
        CRUD::column('reference');
        CRUD::column('account_manager');
        CRUD::column('last_changed_by');
        CRUD::column('date_created');
        CRUD::column('date_last_changed');
        CRUD::column('time_last_changed');

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RenterRequest::class);
        // CRUD::setFromDb(); // set fields from db columns.
        CRUD::field('number_of_persons')->type('number');
        CRUD::field('start_date')->type('date');
        CRUD::field('end_date')->type('date');
        CRUD::field('min_months')->type('number');
        CRUD::field('max_rent')->type('number');
        CRUD::field('min_number_of_rooms')->type('number');
        CRUD::field('must_be_furnished');
        CRUD::field('min_size_sq_m')->type('number');
        CRUD::field('notes');
        CRUD::field('is_smoker');
        CRUD::field('reference');
        CRUD::field('account_manager');
        CRUD::field('last_changed_by');
        CRUD::field('date_created');
        CRUD::field('date_last_changed');
        CRUD::field('time_last_changed');

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
