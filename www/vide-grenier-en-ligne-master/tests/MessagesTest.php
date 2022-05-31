<?php

use App\Models\Messages;
use PHPUnit\Framework\TestCase;

class MessagesTest extends TestCase
{
  public function testMessageGetAll()
  {
    $messages = Messages::getAll();
    $this->assertNotEmpty($messages);
    return $messages;
  }

  /**
   * @depends testMessageGetAll
   */
  public function testMessageGetByUser($message)
  {
    $data['id'] = $message[0]['id_receiver'];
    $message = Messages::getByUser($data);
    $this->assertNotEmpty($message);
  }

  /**
   * @depends testMessageGetAll
   */
  public function testMessageGetOne(array $messages)
  {
    $message = Messages::getOne($messages[0]['id']);
    $this->assertEquals($message[0]['id'], $messages[0]['id']);
  }

  public function testAddMessage()
  {
    $data["mail"] = "test";
    $data['message'] = "test";
    $data["id_article"] = "1";
    $data['id_receiver'] = "1";
    $id = Messages::createMessage($data);
    $this->assertNotEmpty($id);
    return $id;
  }

  /**
   * @depends testAddMessage
   */
  public function testMessageDeleteOne($id)
  {
    $id = Messages::deleteOne($id);
    $this->assertTrue($id);
  }
}
