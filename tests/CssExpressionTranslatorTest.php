<?php

  namespace Xparse\CssExpressionTranslator\Test;

  /**
   * @author Ivan Shcherbak <dev@funivan.com> 02.12.15
   */
  class CssExpressionTranslatorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return array
     */
    public function getConvertWithAttributesDataProvider() {
      return [
        ['a', 'descendant-or-self::a'],
        ['a @a', 'descendant-or-self::a/@a'],
        ['a text()', 'descendant-or-self::a/text()'],
        ['a.foo @href', "descendant-or-self::a[@class and contains(concat(' ', normalize-space(@class), ' '), ' foo ')]/@href"],
      ];
    }


    /**
     * @param string $input
     * @param string $expect
     * @dataProvider getConvertWithAttributesDataProvider
     */
    public function testConvertWithAttributes($input, $expect) {
      $translator = new \Xparse\CssExpressionTranslator\CssExpressionTranslator();
      $result = $translator->convertToXpath($input);

      $this->assertEquals($expect, $result);
    }


  }