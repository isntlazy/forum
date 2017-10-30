<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    function unauthenticatedUserMayNotAddReplies() {

        $this->post('/threads/some-channel/1/replies', [])
            ->assertRedirect('/login');
    }


    /** @test */

    function authenticatedUserMayParticipateInForumThreads() {
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply');

        $this->post($thread->path() . '/replies', $reply->toArray());
        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */

    function replyRequiresBody()
    {
        $this->signIn();
        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');

    }

}