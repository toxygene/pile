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

use ErrorException,
    Exception,
    Pale;

/**
 *
 */
class FileSystem
{

    /**
     * Change the group of a path
     *
     * @param string $path
     * @param string $group
     * @return FileSystem
     * @throws ErrorException
     */
    public function chgrp($path, $group)
    {
        $path = $this->realPath($path);

        Pale\run(function() use ($path, $group) {
            return chgrp($path, $group);
        });

        return $this;
    }

    /**
     * Change the permissions of a path
     *
     * @param string $path
     * @param string $permission
     * @return FileSystem
     * @throws ErrorException
     */
    public function chmod($path, $permission)
    {
        $path = $this->realPath($path);

        Pale\run(function() use ($path, $permission) {
            return chmod($path, $permission);
        });

        return $this;
    }

    /**
     * Change the owner of a path
     *
     * @param string $path
     * @param string $owner
     * @return FileSystem
     * @throws ErrorException
     */
    public function chown($path, $owner)
    {
        $path = $this->realPath($path);

        Pale\run(function() use ($path, $owner) {
            return chown($path, $owner);
        });

        return $this;
    }

    /**
     * Copy a file or directory from one location to another
     *
     * @param string $from
     * @param string $to
     * @return FileSystem
     * @throws ErrorException
     */
    public function copy($from, $to)
    {
        $from = $this->realPath($from);

        Pale\run(function() use ($from, $to) {
            return copy($from, $to);
        });

        return $this;
    }

    /**
     * Delete a file or directory
     *
     * @param string $path
     * @return FileSystem
     * @throws ErrorException
     */
    public function delete($path)
    {
        $path = $this->realPath($path);

        Pale\run(function() use ($path) {
            return unlink($path);
        });

        return $this;
    }

    /**
     * Check if a file or directory exists
     *
     * @param string $path
     * @return boolean
     * @throws ErrorException
     */
    public function exists($path)
    {
        $path = $this->realPath();

        return Pale\run(function() use ($path) {
            return file_exists($path);
        });
    }

    /**
     * Check if a path is a directory
     *
     * @param string $path
     * @return boolean
     * @throws ErrorException
     */
    public function isDirectory($path)
    {
        $path = $this->realPath();

        return Pale\run(function() use ($path) {
            return is_dir($path);
        });
    }

    /**
     * Check if a path is a file
     *
     * @param string $path
     * @return boolean
     * @throws ErrorException
     */
    public function isFile($path)
    {
        $path = $this->realPath($path);

        return Pale\run(function() use ($path) {
            return is_file($path);
        });
    }

    /**
     * Make a directory
     *
     * @param string $path
     * @param integer $mode
     * @param boolean $recursive
     * @return FileSystem
     * @throws ErrorException
     */
    public function makeDirectory($path, $mode = 0777, $recursive = false)
    {
        $path = $this->realPath($path);

        Pale\run(function() use ($path, $mode, $recursive) {
            return mkdir($path, $mode, $recursive);
        });

        return $this;
    }

    /**
     * Move a file or directory
     *
     * @param string $from
     * @param string $to
     * @return FileSystem
     * @throws ErrorException
     */
    public function move($from, $to)
    {
        $from = $this->realPath($from);

        Pale\run(function() use ($from, $to) {
            return rename($from, $to);
        });

        return $this;
    }

    /**
     * Get the realpath of a path
     *
     * @param string $path
     * @return string
     * @throws ErrorException
     */
    public function realPath($path)
    {
        return Pale\run(function() use ($path) {
            return realPath($path);
        });
    }

    /**
     * Symlink a file or directory
     *
     * @param string $target
     * @param string $link
     * @return FileSystem
     * @throws ErrorException
     */
    public function symlink($target, $link)
    {
        $target = $this->realPath($target);

        Pale\run(function() use ($target, $link) {
            return symlink($target, $link);
        });

        return $this;
    }

    /**
     * Touch a file or directory
     *
     * @param string $path
     * @return FileSystem
     * @throws ErrorException
     */
    public function touch($path)
    {
        $path = $this->realPath($path);

        Pale\run(function() use ($path) {
            return touch($path);
        });

        return $this;
    }

}
