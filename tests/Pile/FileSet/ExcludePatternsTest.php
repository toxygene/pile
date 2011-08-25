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
    Pile\FileSet\ExcludePatterns,
    PHPUnit_Framework_TestCase as TestCase;

/**
 *
 */
class ExcludePatternsTest extends TestCase
{

    /**
     * Exclude patterns
     * @var ExcludePatterns
     */
    private $_excludePatterns;

    /**
     * Setup the test case
     */
    public function setUp()
    {
        $this->_excludePatterns = new ExcludePatterns(
            new ArrayIterator(
                array(
                    "one",
                    "two",
                    "three"
                )
            )
        );
    }

    public function testPatternsCanBeAddedAndRetrieved()
    {
        $this->_excludePatterns
             ->addPattern("#one#")
             ->addPattern("#two#");

        $this->assertEquals(array("#one#", "#two#"), $this->_excludePatterns->getPatterns());
    }

    public function testIterationIsLimitedToMatchedPatterns()
    {
        $this->_excludePatterns
             ->addPattern("#^one$#")
             ->addPattern("#re#");

        $this->assertEquals(array("two"), iterator_to_array($this->_excludePatterns, false));
    }

}
