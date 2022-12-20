<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\Rating;
use App\Models\User;
use Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RatingTest extends TestCase
{
    use withFaker, RefreshDatabase ,DatabaseMigrations;

    public function testAuthUserCanPostRatings(): void
    {
        $rating = Rating::factory()->create();

        $this->logIn()->post(route('rating.store',$rating->business, $rating));
        $this->get(route('business.show', $rating->business))->assertSee($rating->comment);
    }

    public function testRatingBelongsToBusiness(): void
    {
        $rating = Rating::factory()->create();

        $this->assertInstanceOf(Business::class, $rating->business);
    }

    public function testRatingBelongsToUser(): void
    {
        $rating = Rating::factory()->create();

        $this->assertInstanceOf(User::class, $rating->user);
    }

    public function testRatingRequiresRating(): void
    {
        $this->logIn();

        $business = Business::factory()->create(['user_id' => auth()->id()]);

        $rating = Rating::factory()->raw(['rating' => null]);
        $this->post(route('rating.store',$business), $rating)->assertSessionHasErrors('rating');
    }

    public function testRatingDoNotRequireComment(): void
    {
        $this->logIn();

        $business = Business::factory()->create(['user_id' => auth()->id()]);

        $rating = Rating::factory()->raw(['comment' => null]);
        $this->post(route('rating.store',$business), $rating);
        $this->get(route('business.show', $business))->assertSee($rating['rating']);
    }

    public function testRatingOwnerCanDeleteRating(): void
    {
        $rating = Rating::factory()->create();
        $this->logIn($rating->user);

        $this->delete(route('rating.delete',[$rating->business, $rating]));
        $this->assertModelMissing($rating);
    }

    public function testGuestCannotDeleteRating(): void
    {
        $rating = Rating::factory()->create();
        $this->delete(route('rating.delete',[$rating->business, $rating]));
        $this->assertModelExists($rating);
    }


    /**
     * @dataProvider numbersProvider
     */
    public function testRatingBetweenNumbersRequired($number): void
    {
        $this->logIn();

        $business = Business::factory()->create(['user_id' => auth()->id()]);

        $ratingHigher = Rating::factory()->raw(['rating' => $number]);
        $this->post(route('rating.store',$business), $ratingHigher)->assertSessionHasErrors('rating');
    }

    public function numbersProvider(): Generator
    {
        yield "higher number" => [
            'number' => 6
        ];
        yield "decimal number" => [
            'number' => 2.5
        ];
        yield "null number" => [
            'number' => 0
        ];
        yield "string" => [
            'number' => 'hello'
        ];
    }


}
