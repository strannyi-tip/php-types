<?php

namespace StrannyiTip\PhpTypes\Http;

/**
 * File.
 */
class File
{
    /**
     * Default hash algorithm.
     */
    public const string DEFAULT_ALGO = 'sha256';

    /**
     * Full file path name.
     *
     * @var string
     */
    private(set) string $fullname {
        get {
            return $this->fullname;
        }
        set {
            $this->fullname = $value;
        }
    }

    /**
     * File.
     *
     * @param string $filename Full file path name
     */
    public function __construct(string $filename)
    {
        $this->fullname = $filename;
    }

    /**
     * Mime type.
     *
     * @return string
     */
    public function mimeType(): string
    {
        return mime_content_type($this->fullname);
    }

    /**
     * Size.
     *
     * @return int
     */
    public function size(): int
    {
        return filesize($this->fullname);
    }

    /**
     * Is exists.
     *
     * @return bool
     */
    public function exists(): bool
    {
        return file_exists($this->fullname);
    }

    /**
     * Calculate hash.
     *
     * @param string|null $algorithm Hash algorithm
     *
     * @return string
     */
    public function hash(?string $algorithm = null): string
    {
        return hash_file(null === $algorithm ? self::DEFAULT_ALGO : $algorithm, $this->fullname);
    }

    /**
     * Extension.
     *
     * @return string
     */
    public function ext(): string
    {
        return pathinfo($this->fullname, PATHINFO_EXTENSION);
    }

    /**
     * Remove.
     *
     * @return bool
     */
    public function remove(): bool
    {
        $result = true;
        if (!$this->exists()) {
            $result = false;
        }
        unlink($this->fullname);

        return $result;
    }

    /**
     * Move.
     *
     * @param string $dst Destination path
     * @param string|null $new_filename New filename
     *
     * @return string|false
     */
    public function move(string $dst, ?string $new_filename = null): string|false
    {
        $filename = null === $new_filename ? sha1($this->fullname) . '.' . $this->ext() : $new_filename;
        $fullname = $dst . '/' . $filename;
        if (!@copy($this->fullname, $fullname)) {
            return false;
        }

        return $fullname;
    }
}