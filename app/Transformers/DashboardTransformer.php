<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Column;

class DashboardTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'cards'
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Column $column)
    {
        return [
            'id' => $column->id,
            'column' => $column->column,
        ];
    }

    public function includeCards(Column $column)
    {

        return $this->collection($column->card, new CardTransformer());
        
    }

}
