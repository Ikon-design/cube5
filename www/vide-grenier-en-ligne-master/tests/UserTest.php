<?php 

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCreateUser()
    {
        $data = [
            'username' => 'testeuh',
            'email' => 'test@gmail.com',
            'password' => 'test',
            'salt' => 'test'
        ];
        $id = User::createUser($data);
        $this->assertNotEmpty($id);

        return $id;
    }

    /**
     * @depends testCreateUser
     */
    public function testClearUser($id)
    {
        $id = User::deleteUser($id);
        $this->assertNotEmpty($id['id']);

        return;
    }

    // public function testgetByLogin()
    // {

    // }
}