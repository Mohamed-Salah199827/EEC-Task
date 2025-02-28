<?php 
namespace Tests\Feature;

use App\Events\UserSaved;
use App\Listeners\SaveUserBackgroundInformation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UserSavedFeatureTest extends TestCase
{
    use RefreshDatabase;
/** @test */
public function it_triggers_user_saved_event_and_creates_user_details()
{
    Event::fake(); 

    $user = User::create([
        'first_name'  => 'Ahmed',
        'middle_name' => 'Ali',
        'last_name'   => 'Mahmoud',
        'email'       => 'Mahmotud@gmail.com',
        'password'    => bcrypt('password123'),
        'prefixname'  => 'mr',
        'avatar'      => 'test-avatar.png'
    ]);

    event(new UserSaved($user));

    Event::assertDispatched(UserSaved::class);

    $listener = app(SaveUserBackgroundInformation::class);
    $listener->handle(new UserSaved($user));

    // Check if the details exist in the database
    $this->assertDatabaseHas('details', [
        'user_id' => $user->id,
        'key'     => 'full_name',
        'value'   => 'Ahmed A. Mahmoud'
    ]);
}


}
