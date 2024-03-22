<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function barChart()
    {
        // Replace this with your actual data retrieval logic
        $now = Carbon::now()    ;
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d');

        $posts= Post::select(DB::raw('COUNT(id) as pcc, Date_FORMAT(created_at, "%Y-%m-%d") as created_at'), )
        ->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), ["$weekStartDate", "$weekEndDate"])
        ->groupBy(DB::raw('CAST(created_at AS DATE)'))->orderBy('created_at')
        ->get(['pcc', 'created_at']);

        $updates= Post::select(DB::raw('COUNT(id) as puc, Date_FORMAT(updated_at, "%Y-%m-%d") as updated_at'), )
        ->whereBetween(DB::raw('DATE_FORMAT(updated_at, "%Y-%m-%d")'), ["$weekStartDate", "$weekEndDate"])
        ->groupBy(DB::raw('CAST(updated_at AS DATE)'))->orderBy('updated_at')
        ->get(['puc', 'updated_at']);
        
    // Listing labels X-axis
        $creates = $posts->pluck('created_at')->toArray();
        $updatedDates = $updates->pluck('updated_at')->toArray();
        $result = $this->merge($creates, $updatedDates);

        $mergeDates = array_unique($result);
        $dateList = array();
        foreach ($mergeDates as $key => $value) {
            $formated_date = Carbon::parse($value)->format('Y-m-d');
           array_push($dateList, $formated_date);
        }

    // listing Data y-axis 
        // $postUpdates = $updates->pluck('puc');
        // $postCount = $posts->pluck('pcc');

        $datas = array_merge($posts->toArray(), $updates->toArray());
        
        $postCount = array();
        $postUpdates = array();
        foreach ($dateList as $date) {
            foreach ($datas as $key => $value) {
                if(isset($value['created_at'])){
                    $created_at = Carbon::parse($value['created_at'])->format('Y-m-d');
                    if($date == $created_at){
                        array_push($postCount, $value['pcc']??0);
                        if(!isset($value['updated_at'])){
                            array_push($postUpdates, 0);
                        }
                    }
                }

                if(isset($value['updated_at'])){
                    $updated_at = Carbon::parse($value['updated_at'])->format('Y-m-d');
                    if($date == $updated_at){
                        array_push($postUpdates, $value['puc']??0);
                        if(!isset($value['created_at'])){
                            array_push($postCount, 0);
                        }
                    }
                }
            }                
        }
    
        $data = [
            'labelsCreated' => $dateList,
            'labelsUpdated' => $dateList,
            'data' => $postCount,
            'updates' => $postUpdates,
        ];

        return response()->json(['data'=>$data]);
    }

    public function mergeSort($array) {
        $length = count($array);
    
        if ($length <= 1) {
            return $array; // Base case: Already sorted or empty array
        }
    
        // Divide the array into two halves
        $mid = (int)($length / 2);
        $left = array_slice($array, 0, $mid);
        $right = array_slice($array, $mid);
    
        // Recursively sort the two halves
        $left = $this->mergeSort($left);
        $right = $this->mergeSort($right);
    
        // Merge the sorted halves
        return $this->merge($left, $right);
    }
    
    public function merge($left, $right) {
        $result = [];
        $leftLength = count($left);
        $rightLength = count($right);
        $i = 0; // Index for the left array
        $j = 0; // Index for the right array
    
        while ($i < $leftLength && $j < $rightLength) {
            if ($left[$i] <= $right[$j]) {
                $result[] = $left[$i];
                $i++;
            } else {
                $result[] = $right[$j];
                $j++;
            }
        }
    
        // Append the remaining elements, if any
        while ($i < $leftLength) {
            $result[] = $left[$i];
            $i++;
        }
    
        while ($j < $rightLength) {
            $result[] = $right[$j];
            $j++;
        }
    
        return $result;
    }

    public function arraySort($arr){
        $data = [];

        dd($arr);
    }
    
}
