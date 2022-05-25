<?php
 
namespace App\Http\Resources;
 
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ResourceLinks;
 
class UserResource extends JsonResource
{
    use ResourceLinks;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->routes = [
            'index' => ['GET', 'users.list'],
            'create' => ['POST', 'users.store'],
            'show' => ['GET', 'users.show']
        ];

        $this->additional(['__links' => $this->getLinks()]);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}