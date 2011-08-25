<?php
/**
 * Pile
 *
 * Copyright (c) 2011 Justin Hendrickson
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be excluded in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace PileTest\FileSet;

use ArrayIterator,
    Pile\FileSet\AbstractPatterns,
    PHPUnit_Framework_TestCase as TestCase;

/**
 *
 */
class AbstractPatternsTest extends TestCase
{

    /**
     * Abstract patterns
     * @var AbstractPatterns
     */
    private $_abstractPatterns;

    /**
     * Setup the test case
     */
    public function setUp()
    {
        $this->_abstractPatterns = $this->getMock(
            "\Pile\FileSet\AbstractPatterns",
            array("accept"),
            array(new ArrayIterator(array("one", "two", "three")))
        );
    }

    public function testPatternsCanBeAddedAndRetrieved()
    {
        $this->_abstractPatterns
             ->addPattern("#one#")
             ->addPattern("#two#");

        $this->assertEquals(array("#one#", "#two#"), $this->_abstractPatterns->getPatterns());
    }

}
