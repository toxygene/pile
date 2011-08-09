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
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
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

/**
 *
 */
class Filesystem
{

    /**
     * Change the group of a path
     *
     * @param string $path
     * @param string $group
     * @return Filesystem
     */
    public function chgrp($path, $group)
    {
        if (!chgrp($this->realPath($path), $group)) {
            throw new Exception();
        }

        return $this;
    }

    /**
     * Change the permissions of a path
     *
     * @param string $path
     * @param string $permission
     * @return Filesystem
     */
    public function chmod($path, $permission)
    {
        if (!chmod($this->realPath($path), $permission)) {
            throw new Exception();
        }

        return $this;
    }

    /**
     * Change the owner of a path
     *
     * @param string $path
     * @param string $owner
     * @return Filesystem
     */
    public function chown($path, $owner)
    {
        if (!chown($this->realPath($path), $owner)) {
            throw new Exception();
        }

        return $this;
    }

    /**
     * Copy a file or directory from one location to another
     *
     * @param string $from
     * @param string $to
     * @return Filesystem
     */
    public function copy($from, $to)
    {
        if (!copy($this->realPath($from), $to, $context)) {
            throw new Exception();
        }

        return $this;
    }

    /**
     * Delete a file or directory
     *
     * @param string $path
     * @return Filesystem
     */
    public function delete($path)
    {
        if (!unlink($this->realPath($path))) {
            throw new Exception();
        }

        return $this;
    }

    /**
     * Check if a file or directory exists
     *
     * @param string $path
     * @return boolean
     */
    public function exists($path)
    {
        return file_exists($this->realPath($path));
    }

    /**
     * Check if a path is a directory
     *
     * @param string $path
     * @return boolean
     */
    public function isDirectory($path)
    {
        return is_dir($this->realPath($path));
    }

    /**
     * Check if a path is a file
     *
     * @param string $path
     * @return boolean
     */
    public function isFile($path)
    {
        return is_file($this->realPath($path));
    }

    /**
     * Make a directory
     *
     * @param string $path
     * @param integer $mode
     * @param boolean $recursive
     * @return Filesystem
     */
    public function makeDirectory($path, $mode = 0777, $recursive = false)
    {
        if (!mkdir($this->realPath($path), $mode, $recursive)) {
            throw new Exception();
        }

        return $this;
    }

    /**
     * Move a file or directory
     *
     * @param string $from
     * @param string $to
     * @return Filesystem
     */
    public function move($from, $to)
    {
        if (!rename($this->realPath($from), $to)) {
            throw new Exception();
        }

        return $this;
    }

    /**
     * Get the realpath of a path
     *
     * @param string $path
     * @return string
     */
    public function realPath($path)
    {
        $realPath = realPath($path);

        if ($realPath === FALSE) {
            throw new Exception();
        }

        return $realPath;
    }

    /**
     * Symlink a file or directory
     *
     * @param string $target
     * @param string $link
     * @return Filesystem
     */
    public function symlink($target, $link)
    {
        if (!symlink($this->realPath($target), $link)) {
            throw new Exception();
        }

        return $this;
    }

    /**
     * Touch a file or directory
     *
     * @param string $path
     * @return Filesystem
     */
    public function touch($path)
    {
        if (!touch($this->realPath($path))) {
            throw new Exception();
        }

        return $this;
    }

}
