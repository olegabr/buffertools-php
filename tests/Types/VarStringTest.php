<?php

declare(strict_types=1);

namespace BitWasp\Buffertools\Tests\Types;

use BitWasp\Buffertools\Tests\BinaryTest;
use BitWasp\Buffertools\Types\VarInt;
use BitWasp\Buffertools\Types\VarString;
use BitWasp\Buffertools\Buffer;
use BitWasp\Buffertools\Parser;

class VarStringTest extends BinaryTest
{
    /**
     * @return array
     */
    public function getSampleVarStrings(): array
    {
        return array_map(function (string $value) {
            return [$value];
        }, [
            '',
            '00',
            '00010203040506070809',
            '00010203040506070809000102030405060708090001020304050607080900010203040506070809000102030405060708090001020304050607080900010203040506070809000102030405060708090001020304050607080900010203040506070809000102030405060708090001020304050607080900010203040506070809000102030405060708090001020304050607080900010203040506070809000102030405060708090001020304050607080900010203040506070809000102030405060708090001020304050607080900010203040506070809000102030405060708090001020304050607080900010203040506070809000102',
        ]);
    }

    /**
     * @param string $input
     * @throws \BitWasp\Buffertools\Exceptions\ParserOutOfRange
     * @throws \Exception
     * @dataProvider getSampleVarStrings
     */
    public function testGetVarString(string $input)
    {
        $varstring = new VarString(new VarInt());
        $binary = $varstring->write(Buffer::hex($input));

        $parser = new Parser(new Buffer($binary));
        $original = $varstring->read($parser);

        $this->assertSame($input, $original->getHex());
    }

    /**
     */
    public function testAbortsWithInvalidVarIntLength()
    {
        $this->expectException(\BitWasp\Buffertools\Exceptions\ParserOutOfRange::class);
        $this->expectExceptionMessage('Insufficient data remaining for VarString');

        $buffer = new Buffer("\x05\x00");

        $varstring = new VarString(new VarInt());
        $varstring->read(new Parser($buffer));
    }
    /**
     */
    public function testFailsWithoutBuffer()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Must provide a buffer');

        $varstring = new VarString(new VarInt());
        $varstring->write('');
    }
}
