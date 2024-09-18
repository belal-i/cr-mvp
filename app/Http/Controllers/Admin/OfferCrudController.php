<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OfferRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OfferCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OfferCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Offer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/offer');
        CRUD::setEntityNameStrings('offer', 'offers');
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
        CRUD::setColumns([
            'source_id',
            'start_date',
            'min_months',
            'number_of_persons',
            'rent',
            'status',
        ]);

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
        CRUD::setValidation(OfferRequest::class);
        // TODO: IDK why this doesn't work...
        // Instead, I have to list the columns individually :-(
        // CRUD::setFromDb(); // set fields from db columns.

        CRUD::field('apartment_id');
        CRUD::field('source_id');
        CRUD::field('start_date');
        CRUD::field('end_date');
        CRUD::field('min_months');
        CRUD::field('max_months');
        CRUD::field('number_of_persons')->type('number');
        CRUD::field('rent');
        // TODO: See Redmine #972.
        CRUD::field('security_deposit_type');
        CRUD::field('security_deposit');
        CRUD::field('reference');
        CRUD::field('notes');
        CRUD::field('status');
        CRUD::field('publish_on_immoscout');
        CRUD::field('va_was_sent');
        CRUD::field('is_premium');
        CRUD::field('utility_cost_included');
        CRUD::field('electricity_cost_included');
        CRUD::field('heating_cost_included');
        CRUD::field('gas_cost_included');
        CRUD::field('water_cost_included');
        CRUD::field('internet_cost_included');
        CRUD::field('cleaning_cost_included');
        CRUD::field('utility_cost_amount');
        CRUD::field('electricity_cost_amount');
        CRUD::field('heating_cost_amount');
        CRUD::field('gas_cost_amount');
        CRUD::field('water_cost_amount');
        CRUD::field('internet_cost_amount');
        CRUD::field('cleaning_cost_amount');
        CRUD::field('user_id');

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
