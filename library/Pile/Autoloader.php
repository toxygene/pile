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
     * Class mapping
     * @var array
     */
    private $_classes = array(
        "Pile\Exception",
        "Pile\FileSystem",
        "Pile\FileSet\AbstractPatterns",
        "Pile\FileSet\ExcludePatterns",
        "Pile\FileSet\IncludePatterns"
    );

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
        if (in_array($className, $this->getClasses())) {
            require_once $this->getPath() . str_replace("\\", DIRECTORY_SEPARATOR, $className) . ".php";
        }
    }

    /**
     * Get the classes
     *
     * @return array
     */
    public function getClasses()
    {
        return $this->_classes;
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
