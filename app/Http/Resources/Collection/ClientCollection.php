<?php
 
namespace App\Http\Resources\Collection;
 
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use App\Http\Resources\ResourceLinks;
 
class ClientCollection extends ResourceCollection
{
    use ResourceLinks;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $this->routes = [];

        // $this->additional(['__links' => $this->getLinks()]);

        if($this->collection->isEmpty()) {
            return [];
        }

        return [
            'status' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $this->collection
        ];
    }
}