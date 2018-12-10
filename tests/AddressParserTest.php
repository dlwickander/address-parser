<?php
/**
 * User: Carp Cai
 * Date: 2018/11/30
 * Time: 6:39 PM
 */
namespace CarpCai\AddressParser\Tests;

use CarpCai\AddressParser\Parser;

class AddressParserTest extends BaseTestCase
{
    public function setUp(){}
    public function tearDown(){}
    /**
     * 测试是否能解析美国的地址
     * CarpCai <2018/12/1 12:40 PM>
     */
    public function testRightUSAddressParse()
    {
        $addressArray = [
            ['555 Test Drive, Testville, CA 98773', ['555 Test Drive', 'Testville', 'CA', '98773']],
            ['555 Test Drive, Testville, California 98773', ['555 Test Drive', 'Testville', 'CA', '98773']],
            ['555 Test Drive,Testville,CA 98773', ['555 Test Drive', 'Testville', 'CA', '98773']],
            ['555 Test Drive,Testville,CA98773', ['555 Test Drive', 'Testville', 'CA', '98773']],
        ];


        $address = Parser::newParse('555 Test Drive, Testville, CA 98773');

        $this->assertEquals( 'CA',  $address->state);
        $this->assertEquals( 'California',  $address->state_text);
        $this->assertEquals( 'Testville',  $address->city);
        $this->assertEquals( '555 Test Drive',  $address->addressLine1);

        $address = Parser::newParse('555 Test Drive, Testville, California 98773');

        $this->assertEquals( 'CA',  $address->state_text);
        $this->assertEquals( 'California',  $address->state_text_label);
    }


    public function testWrongUSAddressParse()
    {
        $address = Parser::newParse('Test Drive, Testville, CA 98773');

        $this->assertEquals( -1,  $address->error_code);


    }
}