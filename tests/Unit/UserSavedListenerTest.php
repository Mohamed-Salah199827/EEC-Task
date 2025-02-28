<?php 
namespace Tests\Unit;

use App\Events\UserSaved;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UserSavedListenerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_user_details_when_user_is_saved()
    {
        Event::fake();
    
        $user = User::create([
            'first_name' => 'Ahmed',
            'middle_name' => 'Ali',
            'last_name' => 'Mahmoud',
            'email' => 'Mahmotud@gmail.com',
            'password' => bcrypt('password123'),
            'prefixname' => 'mr',
            'avatar' => 'test-avatar.png'
        ]);
    
        event(new UserSaved($user));
    
        Event::assertDispatched(UserSaved::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
    }
    


}
