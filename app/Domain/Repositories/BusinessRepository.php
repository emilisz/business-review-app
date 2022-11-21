<?php


namespace App\Domain\Repositories;


use App\Domain\Interfaces\BusinessRepositoryInterface;
use App\Models\Business;
use Illuminate\Database\Eloquent\Collection;

class BusinessRepository implements BusinessRepositoryInterface
{
//    public function __construct(
//        private string $title,
//        private string $description,
//    )
//    {
//    }

//    /**
//     * @return string
//     */
//    public function getTitle(): string
//    {
//        return $this->title;
//    }
//
//    /**
//     * @param string $title
//     */
//    public function setTitle(string $title): void
//    {
//        $this->title = $title;
//    }
//
//    /**
//     * @return string
//     */
//    public function getDescription(): string
//    {
//        return $this->description;
//    }
//
//    /**
//     * @param string $description
//     */
//    public function setDescription(string $description): void
//    {
//        $this->description = $description;
//    }

    public function mainQuery()
    {
        return Business::withCount('ratings')
            ->withAvg('ratings','rating')
            ->get()
            ->map(function ($business) {
                return [
                    'id' => $business->id,
                    'title' => $business->title,
                    'description' => $business->description,
                    'updated_at' => $business->updated_at,
                    'avg_rating' => $business->ratings_avg_rating,
                    'ratings_count' => $business->ratings_count,
                    'image_url' => $business->image_url
                ];
            });
}

    public function search($name)
    {
        // TODO: Implement search() method.
    }

    public function getOne($id)
    {
       return Business::find($id);
    }

    public function getAll($order = 'asc', $results = 15)
    {
//        return Business::get()->sortBy('created_at',$order)->paginate($results);
        return Business::withCount('ratings')
            ->withAvg('ratings','rating')
            ->get()
            ->map(function ($business) {
                return [
                    'id' => $business->id,
                    'title' => $business->title,
                    'description' => $business->description,
                    'updated_at' => $business->updated_at,
                    'avg_rating' => $business->ratings_avg_rating,
                    'ratings_count' => $business->ratings_count,
                    'image_url' => $business->image_url
                ];
            })->sortByDesc('avg_rating')->paginate($results);
    }

    public function getAllByUser($user_id, $results = 15)
    {
       return Business::where('user_id', $user_id)->get()->paginate($results);
    }

    public function getAllByRating($orderBy)
    {
        // TODO: Implement getAllByRating() method.
    }


}
