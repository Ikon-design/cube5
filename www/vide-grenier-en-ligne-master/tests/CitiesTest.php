<?php

use App\Models\Cities;
use PHPUnit\Framework\TestCase;

class CitiesTest extends TestCase
{
  public function testSearchCity()
  {
    $articles = Cities::search("Ozan");
    $this->assertNotEmpty($articles);
  }
}
