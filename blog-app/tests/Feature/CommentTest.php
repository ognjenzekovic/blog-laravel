<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->post(route('comments.store', $post), [
            'comment' => 'This is my comment.',
        ]);

        $response->assertRedirect(route('posts.show', $post));
        $this->assertDatabaseHas('comments', [
            'comment' => 'This is my comment.',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
    }

    public function test_guest_can_comment(): void
    {
        $post = Post::factory()->create();

        $response = $this->post(route('comments.store', $post), [
            'comment' => 'Guest comment here.',
        ]);

        $response->assertRedirect(route('posts.show', $post));
        $this->assertDatabaseHas('comments', [
            'comment' => 'Guest comment here.',
            'user_id' => null,
            'post_id' => $post->id,
        ]);
    }

    public function test_comment_owner_can_delete_their_comment(): void
    {
        $user    = User::factory()->create();
        $post    = Post::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response = $this->actingAs($user)->delete(route('comments.destroy', $comment));

        $response->assertRedirect();
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    public function test_post_owner_can_delete_others_comment_on_owned_post(): void
    {
        $postOwner    = User::factory()->create();
        $commenter    = User::factory()->create();
        $post         = Post::factory()->create(['user_id' => $postOwner->id]);
        $comment      = Comment::factory()->create([
            'user_id' => $commenter->id,
            'post_id' => $post->id,
        ]);

        $response = $this->actingAs($postOwner)->delete(route('comments.destroy', $comment));

        $response->assertRedirect();
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    public function test_user_cannot_delete_others_comment(): void
    {
        $commenter = User::factory()->create();
        $other     = User::factory()->create();
        $post      = Post::factory()->create();
        $comment   = Comment::factory()->create([
            'user_id' => $commenter->id,
            'post_id' => $post->id,
        ]);

        $response = $this->actingAs($other)->delete(route('comments.destroy', $comment));

        $response->assertForbidden();
        $this->assertDatabaseHas('comments', ['id' => $comment->id]);
    }

    public function test_admin_can_delete_any_comment(): void
    {
        $admin   = User::factory()->create(['role' => 'admin']);
        $post    = Post::factory()->create();
        $comment = Comment::factory()->create(['post_id' => $post->id]);

        $response = $this->actingAs($admin)->delete(route('comments.destroy', $comment));

        $response->assertRedirect();
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }
}
