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
        $entries = $study->get(1, 1);

        foreach ($entries as $entry) {
            switch ($entry[3]) {
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

            if ($entry[2]) {
                $table .= '<li title="'. $entry[0] . ' ' . $entry[1] . '" class="'.$background.'"><a href="/study/' . urlencode(strtolower($entry[0])) . '/' . $entry[1] . '/">&bull;</a></li>';

            } else {
                $table .= '<li title="'. $entry[0] . ' ' . $entry[1] . '" class="'.$background.'"></li>';
            }
        }

        return view('dashboard.study.index', compact('table'));
    }
}
