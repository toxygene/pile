<?php
/**
 * Pile
 *
 * Copyright (c) 2011, Justin Hendrickson
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * The names of its contributors may not be used to endorse or promote
 *       products derived from this software without specific prior written
 *       permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
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
     * Get the contents of a file
     *
     * @param string $path
     * @param boolean $useIncludePath
     * @param resource $context
     * @param integer $offset
     * @param integer maxlen
     * @return string
     * @throws Exception
     */
    public function getContents($path, $useIncludePath = false, $context = null, $offset = -1, $maxlen = null)
    {
        return $this->_run(function() use ($path, $useIncludePath, $context, $offset, $maxlen) {
            return file_get_contents($path, $useIncludePath, $context, $offset, $maxlen);
        });
    }

    /**
     * Get the current working directory
     *
     * @return string
     * @throws Exception
     */
    public function getcwd()
    {
        return $this->_run(function() {
            return getcwd();
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
     * Write a string to a file
     *
     * @param string $path
     * @param string $contents
     * @param integer $flags
     * @param resource context
     * @return FileSystem
     * @throws Exception
     */
    public function putContents($path, $contents, $flags = 0, $context = null)
    {
        $this->_run(function() use ($path, $contents, $flags, $context) {
            return file_put_contents($path, $contents, $flags, $context);
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
