<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class StrPutCsvTest extends TestCase
{
    public function testEmpty()
    {
        $csv = str_putcsv([]);
        $this->assertSame('', $csv);
    }

    public function testNumbers()
    {
        $csv = str_putcsv([1,2,3]);
        $this->assertSame('1,2,3', $csv);
    }

    public function testMixedTypes()
    {
        $csv = str_putcsv([1,'John Doe','phpunit']);
        $this->assertSame('1,"John Doe",phpunit', $csv);
    }

    public function testMultiline()
    {
        $csv = str_putcsv([1,"PHP\nUnit"]);
        $this->assertSame("1,\"PHP\nUnit\"", $csv);
    }

    public function testMixedQuotes()
    {
        $csv = str_putcsv([1,'php"unit']);
        $this->assertSame("1,\"php\"\"unit\"", $csv);
    }

    public function testDifferentDelimiter()
    {
        $csv = str_putcsv([1,'phpunit',2], ']');
        $this->assertSame("1]phpunit]2", $csv);
    }

    public function testDifferentEnclosure()
    {
        $csv = str_putcsv([1,"php unit",2], null, '\'');
        $this->assertSame("1,'php unit',2", $csv);
    }

    public function testDifferentEscape()
    {
        // The inner quotation mark is considered escaped by the @-sign.
        $csv = str_putcsv([1,'php@"unit',2], null, null, '@');
        $this->assertSame('1,"php@"unit",2', $csv);
    }

    public function testTrailingNewline()
    {
        $csv = str_putcsv([1,"phpunit\r\n","\n"]);
        $this->assertSame("1,\"phpunit\r\n\",\"\n\"", $csv);
    }

    public function testDecoding()
    {
        // str_getcsv does not convert numeric fields to integers.
        $input = ['1','"php,unit"','test'];
        $csv = str_putcsv($input);
        $this->assertSame($input, str_getcsv($csv));
    }
}
