<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Card;

class CardTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
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
    public function transform(Card $card)
    {
        return [
            'id' => $card->id,
            'task' => $card->task,
            'date' => $card->date,
        ];
    }
}
