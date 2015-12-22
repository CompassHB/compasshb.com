<?php

namespace CompassHB\Www\Http\Controllers;

use Illuminate\Http\Request;

use CompassHB\Www\Http\Requests;
use CompassHB\Www\Http\Controllers\Controller;
use CompassHB\Www\Repositories\Study\StudyRepository as Study;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Study $study)
    {
        $table = "";
        $bible = $study->get(1, 1);

        foreach ($bible as $book => $chapters) {

            $i = 1;
            foreach ($chapters as $chapter) {

                switch ($chapter[1]) {
                    case 0:
                        $background = "ref-1";
                        break;
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                        $background = "ref-2";
                        break;
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                        $background = "ref-3";
                        break;
                    case 9:
                    case 10:
                    case 11:
                    case 12:
                        $background = "ref-4";
                        break;
                    default:
                        $background = "ref-5";
                        break;
                }

                if ($chapter[0] > 0) {
                    $table .= '<li title="'. $book . ' ' . $i . '" class="'.$background.'"><a href="/study/' . urlencode(strtolower($book)) . '/' . $i . '/">&bull;</a></li>';
                } else {
                    $table .= '<li title="'. $book . ' ' . $i . '" class="'.$background.'"></li>';
                }
                $i++;

            }
        }

        return view('dashboard.study.index', compact('table'));
    }
}
