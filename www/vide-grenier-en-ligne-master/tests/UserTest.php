<?php 

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testcreateUser()
    {
        $data = [
            'username' => 'testeuh',
            'email' => 'test@gmail.com',
            'password' => 'test',
            'salt' => 'test'
        ];
        $id = User::createUser($data);
        $this->assertNotEmpty($data['username'], $data['email'], $data['password'], $data['salt']);

        return $id;
    }

    /**
     * @depends testcreateUser
     */
    public function clearUser($id)
    {
        var_dump($id);
        $id = User::deleteUser($id);
        $this->assertNotEmpty($id['id']);

        return;
    }

    // public function testgetByLogin()
    // {

    // }
}