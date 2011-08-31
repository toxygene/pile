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

use Pile\Exception;

/**
 *
 */
class FileSystem
{

    /**
     * Change the current directory
     *
     * @param string $path
     * @return FileSystem
     * @throws Exception
     */
    public function chdir($path)
    {
        $this->_run(function() use ($path) {
            return chdir($path);
        });

        return $this;
    }

    /**
     * Change the group of a path
     *
     * @param string $path
     * @param string $group
     * @return FileSystem
     * @throws Exception
     */
    public function chgrp($path, $group)
    {
        $this->_run(function() use ($path, $group) {
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
     * @throws Exception
     */
    public function chmod($path, $permission)
    {
        $this->_run(function() use ($path, $permission) {
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
     * @throws Exception
     */
    public function chown($path, $owner)
    {
        $this->_run(function() use ($path, $owner) {
            return chown($path, $owner);
        });

        return $this;
    }

    /**
     * Copy a file or directory from one location to another
     *
     * @param string $from
     * @param string $to
     * @param resource $context
     * @return FileSystem
     * @throws Exception
     */
    public function copy($from, $to, $context = NULL)
    {
        $this->_run(function() use ($from, $to, $context) {
            if ($context) {
                return copy($from, $to, $context);
            } else {
                return copy($from, $to);
            }
        });

        return $this;
    }

    /**
     * Execute a command
     *
     * @param string $command
     * @param array $output
     * @param string $returnVar
     */
    public function execute($command, &$output = null, &$returnVar = null)
    {
        return $this->_run(function() use ($command, &$output, &$returnVar) {
            return exec($command, $output, $returnVar);
        });
    }

    /**
     * Check if a file or directory exists
     *
     * @param string $path
     * @return boolean
     * @throws Exception
     */
    public function exists($path)
    {
        return $this->_run(function() use ($path) {
            return file_exists($path);
        });
    }

    /**
     * Get the size of a path
     *
     * @param string $path
     * @return integer
     * @throws Exception
     */
    public function filesize($path)
    {
        return $this->_run(function() use ($path) {
            return filesize($path);
        });
    }

    /**
     * Get the type of a path
     *
     * @param string $path
     * @return string
     * @throws Exception
     */
    public function filetype($path)
    {
        return $this->_run(function() use ($path) {
            return filetype($path);
        });
    }

    /**
     * Search the filesystem accorind to libc glob()
     *
     * @param string $pattern
     * @param integer $flags
     * @return array
     * @throws Exception
     */
    public function glob($pattern, $flags = 0)
    {
        return $this->_run(function() use ($pattern, $flags) {
            return glob($pattern, $flags);
        });
    }

    /**
     * Check if a path is a directory
     *
     * @param string $path
     * @return boolean
     * @throws Exception
     */
    public function isDirectory($path)
    {
        return $this->_run(function() use ($path) {
            return is_dir($path);
        });
    }

    /**
     * Check if a path is executable
     *
     * @param string $path
     * @return boolean
     * @throws Exception
     */
    public function isExecutable($path)
    {
        return $this->_run(function() use ($path) {
            return is_executable($path);
        });
    }

    /**
     * Check if a path is a file
     *
     * @param string $path
     * @return boolean
     * @throws Exception
     */
    public function isFile($path)
    {
        return $this->_run(function() use ($path) {
            return is_file($path);
        });
    }

    /**
     * Check if a path is a link
     *
     * @param string $path
     * @return boolean
     * @throws Exception
     */
    public function isLink($path)
    {
        return $this->_run(function() use ($path) {
            return is_link($path);
        });
    }

    /**
     * Check if a path is readable
     *
     * @param string $path
     * @return boolean
     * @throws Exception
     */
    public function isReadable($path)
    {
        return $this->_run(function() use ($path) {
            return is_readable($path);
        });
    }

    /**
     * Check if a path is writable
     *
     * @param string $path
     * @return boolean
     * @throws Exception
     */
    public function isWritable($path)
    {
        return $this->_run(function() use ($path) {
            return is_writable($path);
        });
    }

    /**
     * Hard link a path
     *
     * @param string $target
     * @param string $link
     * @return FileSystem
     * @throws Exception
     */
    public function link($target, $link)
    {
        $this->_run(function() use ($target, $link) {
            return link($target, $link);
        });

        return $this;
    }

    /**
     * Make a directory
     *
     * @param string $path
     * @param integer $mode
     * @param boolean $recursive
     * @param resource $context
     * @return FileSystem
     * @throws Exception
     */
    public function makeDirectory($path, $mode = 0777, $recursive = false, $context = null)
    {
        $this->_run(function() use ($path, $mode, $recursive, $context) {
            if ($context) {
                return mkdir($path, $mode, $recursive, $context);
            } else {
                return mkdir($path, $mode, $recursive);
            }
        });

        return $this;
    }

    /**
     * Move a file or directory
     *
     * @param string $from
     * @param string $to
     * @param resource $context
     * @return FileSystem
     * @throws Exception
     */
    public function move($from, $to, $context = null)
    {
        $this->_run(function() use ($from, $to, $context) {
            if ($context) {
                return rename($from, $to, $context);
            } else {
                return rename($from, $to);
            }
        });

        return $this;
    }

    /**
     * Get the realpath of a path
     *
     * @param string $path
     * @return string
     * @throws Exception
     */
    public function realPath($path)
    {
        return $this->_run(function() use ($path) {
            return realPath($path);
        });
    }

    /**
     * Remove a directory
     *
     * @param string $path
     * @param resource $context
     * @return FileSystem
     * @throws Exception
     */
    public function removeDirectory($path, $context = null)
    {
        $this->_run(function() use ($path, $context) {
            if ($context) {
                return rmdir($path, $context);
            } else {
                return rmdir($path);
            }
        });

        return $this;
    }

    /**
     * Symlink a path
     *
     * @param string $target
     * @param string $link
     * @return FileSystem
     * @throws Exception
     */
    public function symlink($target, $link)
    {
        $this->_run(function() use ($target, $link) {
            return symlink($target, $link);
        });

        return $this;
    }

    /**
     * Touch a file or directory
     *
     * @param string $path
     * @return FileSystem
     * @throws Exception
     */
    public function touch($path)
    {
        $this->_run(function() use ($path) {
            return touch($path);
        });

        return $this;
    }

    /**
     * Set the umask
     *
     * The previous umask value is returned.
     *
     * @param integer $mask
     * @return integer
     * @throws Exception
     */
    public function umask($mask)
    {
        return $this->_run(function() use ($mask) {
            return umask($mask);
        });
    }

    /**
     * Unlink a path
     *
     * @param string $path
     * @return FileSystem
     * @throws Exception
     */
    public function unlink($path)
    {
        $this->_run(function() use ($path) {
            return unlink($path);
        });

        return $this;
    }

    /**
     * Run a function in an error trapped environment
     *
     * @param function $function
     * @return mixed
     * @throws Exception
     */
    private function _run($function)
    {
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            throw new Exception($errstr, 0, $errno, $errfile, $errline);
        });

        try {
            $result = $function();
        } catch (Exception $e) {
            restore_error_handler();
            throw $e;
        }

        restore_error_handler();

        return $result;
    }

}
