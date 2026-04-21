<?php

namespace Tests\Unit\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_user_is_not_admin(): void
    {
        $user = new User();
        $this -> assertFalse($user -> isAdmin());
    }
    public function test_user_is_admin(): void
    {
        $user = new User(['role' => 'admin']);
        $this -> assertTrue($user -> isAdmin());
    }
}
