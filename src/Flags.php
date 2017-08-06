<?php
/**
 * Utility class to handle bitwise flags.
 *
 * @package WPZAPP\Flags
 * @license GPL-3.0
 * @link    https://wpzapp.org
 */

namespace WPZAPP\Flags;

/**
 * Class for handling a set of bitwise flags.
 *
 * @since 1.0.0
 */
class Flags
{

    /** @var int Container for bitwise flags. */
    private $flags = 0;

    /**
     * Constructor.
     *
     * Set the initial flags.
     *
     * @since 1.0.0
     *
     * @param int $flags Optional. Initial flags. Default 0.
     */
    public function __construct(int $flags = 0)
    {
        $this->setFlag($flags, true);
    }

    /**
     * Set or unset a flag.
     *
     * @since 1.0.0
     *
     * @param int  $flag  The flag to set or unset.
     * @param bool $value True if the flag should be set, false if it should be unset.
     */
    public function setFlag(int $flag, bool $value)
    {
        if ($value) {
            $this->flags |= $flag;
        } else {
            $this->flags &= ~$flag;
        }
    }

    /**
     * Check whether a flag is set.
     *
     * @since 1.0.0
     *
     * @param int $flag The flag to check for.
     *
     * @return bool Whether the flag is set.
     */
    public function isFlagSet(int $flag): bool
    {
        return ($this->flags & $flag) === $flag;
    }

    /**
     * Get the raw flags container value.
     *
     * @since 1.0.0
     *
     * @return int Flags value.
     */
    public function getFlags(): int
    {
        return $this->flags;
    }
}
