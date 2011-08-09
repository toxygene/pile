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
 * The above copyright notice and this permission notice shall be included in
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

namespace Pile;

use FilesystemIterator,
    Pile\FileSet\Patterns,
    Pile\FileSet\PatternFilterIterator,
    IteratorAggregate;

/**
 *
 */
class FileSet implements IteratorAggregate
{

    /**
     * Directory
     * @var string
     */
    protected $_directory;

    /**
     * Id
     * @var string
     */
    protected $_id;

    /**
     * Exclude patterns
     * @var Patterns
     */
    protected $_excludePatterns;

    /**
     * Include patterns
     * @var Patterns
     */
    protected $_includePatterns;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_excludePatterns = new Patterns();
        $this->_includePatterns = new Patterns();
    }

    /**
     * Get the directory
     *
     * @return string
     */
    public function getDirectory()
    {
        return $this->_directory;
    }

    /**
     * Get the exclude patterns
     *
     * @return Patterns
     */
    public function getExcludePatterns()
    {
        return $this->_excludePatterns;
    }

    /**
     * Get the id
     *
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Get the include patterns
     *
     * @return Patterns
     */
    public function getIncludePatterns()
    {
        return $this->_includePatterns;
    }

    /**
     * Get the iterator
     *
     * @return PatternFilterIterator
     */
    public function getIterator()
    {
        return new PatternFilterIterator(
            new FilesystemIterator($this->getDirectory()),
            $this->getExcludePatterns(),
            $this->getIncludePatterns()
        );
    }

    /**
     * Set the directory
     *
     * @param string $directory
     * @return FileSet
     */
    public function setDirectory($directory)
    {
        $this->_directory = $directory;
        return $this;
    }

    /**
     * Set the id
     *
     * @param string $id
     * @return FileSet
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

}
