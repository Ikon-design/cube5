<?php 

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCreateUser()
    {
        $data = [
            'username' => 'testeuh2',
            'email' => 'test@gmail.com',
            'password' => 'test',
            'salt' => 'test'
        ];
        $id = User::createUser($data);
        $this->assertNotEmpty($id);

        return $id;
    }

    public function testgetByLogin()
    {
        $data = [
            'email' => 'test@gmail.com',
        ];
        $id = User::getByLogin($data['email']);
        $this->assertNotEmpty($id);

        return $id;
    }

    public function testgetById()
    {
        $data = [
            'id' => '1',
        ];
        $id = User::getById($data['id']);
        $this->assertNotEmpty($id);

        return $id;
    }

    public function testcountUser()
    {
        $data = [
            'is_admin' => '1',
        ];
        $id = User::countUser($data['is_admin']);
        $this->assertNotEmpty($id);
    }

    /**
     * @depends testCreateUser
     */
    public function testClearUser($id)
    {
        User::deleteUser($id);
        $this->assertNotEmpty($id);

        return;
    }
}