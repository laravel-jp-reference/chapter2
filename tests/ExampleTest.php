<?php


class ExampleTest extends TestCase
{
    /**
     * 基本的な機能テストの例
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }
}
