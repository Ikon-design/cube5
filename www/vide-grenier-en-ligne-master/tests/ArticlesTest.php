<?php

use App\Controllers\User;
use App\Models\Articles;
use PHPUnit\Framework\TestCase;

class ArticlesTest extends TestCase
{
    public function testArticleGetAll()
    {
        $articles = Articles::getAll("");
        $this->assertNotEmpty($articles);
        return $articles;
    }

    public function testArticleGetByUser()
    {
        $articles = Articles::getByUser(1);
        $this->assertNotEmpty($articles);
    }

    public function testGetSuggest(){
        $articles = Articles::getSuggest();
        $this->assertNotEmpty($articles);
    }

    public function testArticleGetCount()
    {
        $articles = Articles::getAllCount();
        $this->assertNotEmpty(count($articles));
    }

    /**
     * @depends testArticleGetAll
     */
    public function testArticleGetOne(array $articles)
    {
        $article = Articles::getOne($articles[0]['id']);
        $this->assertEquals($article[0]['id'], $articles[0]['id']);
    }

    public function testAddArticle()
    {
        $data["name"] = "test";
        $data["description"] = "test";
        $data['user_id'] = "1";
        $id = Articles::save($data);
        $this->assertNotEmpty($id);
        return $id;
    }

    /**
     * @depends testAddArticle
     */
    public function testAddArticlePicture($id)
    {
        $id = Articles::attachPicture($id, "test.jpg");
        $this->assertTrue($id);
    }

    /**
     * @depends testAddArticle
     */
    public function testDeleteArticle($id)
    {
        $test = Articles::deleteOne($id);
        $this->assertTrue($test);
    }
}
