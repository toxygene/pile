<?php
/**
 *
 */

namespace Pile;

/**
 *
 */
class Autoloader
{

    /**
     * Path
     * @var string
     */
    private $_path;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_path = dirname(__DIR__) . "/";
    }

    /**
     * Autoloader
     *
     * @param string $className
     */
    public function autoload($className)
    {
        if (preg_match("#^Pile\\#", $className)) {
            require_once $this->getPath() . str_replace("\\", DIRECTORY_SEPARATOR, $className) . ".php";
        }
    }

    /**
     * Get the path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * Register the autoloader
     */
    public function register()
    {
        spl_autoload_register(array($this, "autoload"));
    }

}
