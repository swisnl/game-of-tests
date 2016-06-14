<?php
namespace Swis\GoT;

class Result
{
    protected $filename;

    protected $line;

    protected $author;

    protected $email;

    protected $date;

    protected $commitHash;

    protected $parser;

    /**
     * Result constructor.
     * @param $filename
     * @param $line
     * @param $commitHash
     * @param $author
     * @param $email
     * @param $date
     * @param $parser
     */
    public function __construct($filename, $line, $commitHash, $author, $email, $date, $parser)
    {
        $this->filename = $filename;
        $this->line = $line;
        $this->author = $author;
        $this->email = $email;
        $this->date = $date;
        $this->commitHash = $commitHash;
        $this->parser = $parser;
    }

    /**
     * @return mixed
     */
    public function getCommitHash()
    {
        return $this->commitHash;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }

    public function toArray()
    {
        return [
            'filename' => $this->filename,
            'line' => $this->line,
            'author' => $this->author,
            'email' => $this->email,
            'date' => $this->date,
            'commitHash' => $this->commitHash,
            'parser' => $this->parser,
        ];
    }

    /**
     * @return mixed
     */
    public function getParser()
    {
        return $this->parser;
    }

}