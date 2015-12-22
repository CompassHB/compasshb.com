<?php

namespace CompassHB\Www\Repositories\Study;

use CompassHB\Www\Sermon;
use CompassHB\Www\Contracts\Study as Contract;

/**
 * Class StudyRepository
 * @package CompassHB\Www\Repositories\Study
 */
class StudyRepository implements Contract
{
    /**
     * @var array
     */
    private $books = [
        'Genesis', 'Exodus', 'Leveticus', 'Numbers', 'Deuteronomy',
        'Joshua', 'Judges', 'Ruth', '1 Samuel', '2 Samuel', '1 Kings',
        '2 Kings', '1 Chronicles', '2 Chronicles', 'Ezra',
        'Nehemiah', 'Esther', 'Job', 'Psalm', 'Proverbs',
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
     * looks for Bible verses
     * @var string
     */
    private $regex_pattern = '/\b(Genesis|Exodus|Leviticus|Numbers|Deuteronomy|Joshua|Judges|Ruth|1 Samuel|2 Samuel|1 Kings|2 Kings|1 Chronicles|2 Chronicles|Ezra|Nehemiah|Esther|Job|Psalm|Proverbs|Ecclesiastes|Song of Solomon|Isaiah|Jeremiah|Lamentations|Ezekiel|Daniel|Hosea|Joel|Amos|Obadiah|Jonah|Micah|Nahum|Habakkuk|Zephaniah|Haggai|Zechariah|Malachi|Matthew|Mark|Luke|John|Acts|Romans|1 Corinthians|2 Corinthians|Galatians|Ephesians|Philippians|Colossians|1 Thessalonians|2 Thessalonians|1 Timothy|2 Timothy|Titus|Philemon|Hebrews|James|1 Peter|2 Peter|1 John|2 John|3 John|Jude|Revelation)\s(\d{1,3})(:\d{1,3}(\-\d{1,3}(:\d{1,3})?)?)?/';


    /**
     * StudyRepository constructor.
     */
    public function __construct()
    {
        $bible = [];

        $i = 0;
        foreach ($this->books as $book) {

            $bible[$book] = array_fill(0, $this->chapters[$i], [0, 0]);
            $i++;
        }

        $sermons = Sermon::where('ministry', '=', null)
                        ->latest('published_at')
                        ->published()
                        ->get();

        foreach ($sermons as $sermon) {

            // text
            $text = $this->search($sermon->text);
            $i = 0;
            while ($i < count($text[0])) {

                $text_book = $text[1][$i];
                $text_chapter = $text[2][$i];

                // Add sermon
                $bible[$text_book][$text_chapter - 1][0] = 1;
                $i++;

            }

            // ref
            $ref = $this->search($sermon->body);
            $i = 0;
            while ($i < count($ref[0])) {

                $text_book = $ref[1][$i];
                $text_chapter = $ref[2][$i];

                // Add reference
                $bible[$text_book][$text_chapter - 1][1]++;
                $i++;

            }
        }

        $this->study = $bible;
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

    /**
     * @param $input_string
     * @param $regex_pattern
     * @return array
     */
    private function search($input)
    {
        // finds all matches
        preg_match_all($this->regex_pattern, $input, $output);

        return $output;
    }
}
