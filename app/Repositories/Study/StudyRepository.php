<?php

namespace CompassHB\Www\Repositories\Study;

use CompassHB\Www\Contracts\Study as Contract;

class StudyRepository implements Contract
{
    /**
     * @var array
     */
    private $books = [
        'Genesis', 'Exodus', 'Leveticus', 'Numbers', 'Deuteronomy',
        'Joshua', 'Judges', 'Ruth', '1 Samuel', '2 Samuel', '1 Kings',
        '2 Kings', '1 Chronicles', '2 Chronicles', 'Ezra',
        'Nehemiah', 'Esther', 'Job', 'Psalms', 'Proverbs',
        'Ecclesiastes', 'Song of Solomon', 'Isaiah', 'Jeremiah',
        'Lamentations', 'Ezekiel', 'Daniel', 'Hosea', 'Joel',
        'Amos', 'Obadiah', 'Jonah', 'Micah', 'Nahum', 'Habakkuk',
        'Zephaniah', 'Haggai', 'Zechariah', 'Malachi',
        'Matthew', 'Mark', 'Luke', 'John', 'Acts', 'Romans',
        '1 Corinthians', '2 Corinthians', 'Galatians', 'Ephesians',
        'Philippians', 'Colossians', '1 Thessalonians', '2 Thessalonians',
        '1 Timothy', '2 Timothy', 'Titus', 'Philemon', 'Hebrews', 'James',
        '1 Peter', '2 Peter', '1 John', '2 John', '3 John', 'Jude', 'Revelation'
    ];

    /**
     * @var array
     */
    private $chapters = [
        50, 40, 27, 36, 34, 24, 21, 4, 31, 24, 22, 25, 29, 36, 10,
        13, 16, 42, 150, 31, 12, 8, 66, 52,
        5, 48, 14, 14, 4, 9, 1, 4, 7, 3, 3, 3, 2, 14, 3,
        28, 16, 24, 21, 28, 16, 16, 13, 6, 6, 4, 4, 5, 3, 6,
        4, 3, 1, 13, 5, 5, 3, 5, 1, 1, 1, 22
    ];

    /**
     * @var array
     */
    private $study = [];

    /**
     * StudyRepository constructor.
     */
    public function __construct()
    {
        $bible = array_combine($this->books, $this->chapters);

        foreach ($bible as $book => $chapters) {
            $i = 1;

            while ($i <= $chapters) {

                // Book, Chapter, Sermon, References
                array_push($this->study, [$book, $i, rand(0, 1), rand(0, 10)]);
                $i++;
            }
        }
    }

    /**
     * @param $chapter
     * @param $verse
     * @return mixed
     */
    public function get($chapter, $verse)
    {
        return $this->study;
    }
}
